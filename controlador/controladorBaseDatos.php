<?php
    $host = 'localhost';
    $db = 'bdprueba';
    $user = 'root';
    $pw = '';

    if (isset($_POST['repaldo'])) {
        $conexion = new mysqli($host, $user, $pw, $db);

        if ($conexion->connect_error) {
            die('Error de conexión: ' . $conexion->connect_error);
            header("Location: javascript:history.back();");
        }

        // Consulta para obtener todas las tablas de la base de datos
        $tablas = array();
        $resultado = $conexion->query("SHOW TABLES");
        while ($fila = $resultado->fetch_row()) {
            $tablas[] = $fila[0];
        }

        // Generar el archivo de respaldo
        $archivoRespaldo = 'respaldo_'.date('d-m-Y').'.sql';
        $fp = fopen($archivoRespaldo, 'w');

        // Agregar la estructura de las tablas al archivo de respaldo
        foreach ($tablas as $tabla) {
            $resultado = $conexion->query("SHOW CREATE TABLE $tabla");
            $fila = $resultado->fetch_row();
            fwrite($fp, $fila[1] . ";\n\n");
        }

        // Agregar los datos de las tablas al archivo de respaldo
        foreach ($tablas as $tabla) {
            $resultado = $conexion->query("SELECT * FROM $tabla");
            while ($fila = $resultado->fetch_assoc()) {
                $linea = 'INSERT INTO ' . $tabla . ' VALUES(';
                foreach ($fila as $valor) {
                    $linea .= "'" . $conexion->real_escape_string($valor) . "',";
                }
                $linea = rtrim($linea, ',');
                $linea .= ");\n";
                fwrite($fp, $linea);
            }
            fwrite($fp, "\n");
        }

        fclose($fp);
        $conexion->close();

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $archivoRespaldo . '"');
        readfile($archivoRespaldo);
        unlink($archivoRespaldo);
        exit;
    }

    if (isset($_POST['recuperacion'])) {
        $archivoRestauracion = $_FILES['archivo']['tmp_name'];

        // Conexión a la base de datos MySQL
        $conn = new mysqli($host, $user, $pw);

        // Verificar si hay errores de conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta SQL para eliminar la base de datos si existe
        $sql = "DROP DATABASE IF EXISTS $db";
        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "La base de datos $db ha sido eliminada correctamente.";
        } else {
            echo "Error al eliminar la base de datos: " . $conn->error;
        }

        // Consulta SQL para crear la base de datos si no existe
        $sql = "CREATE DATABASE IF NOT EXISTS $db";
        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            echo "La base de datos $db ha sido eliminada correctamente.";
        } else {
            echo "Error al eliminar la base de datos: " . $conn->error;
        }

        // Cerrar la conexión
        $conn->close();
        
        // Conexión a la base de datos
        $conexion = new mysqli($host, $user, $pw, $db);

        // Verificar la conexión
        if ($conexion->connect_error) {
            die('Error de conexión: ' . $conexion->connect_error);
            header("Location: javascript:history.back();");
        }

        // Desactivar las comprobaciones de llaves foráneas
        $conexion->query('SET FOREIGN_KEY_CHECKS = 0');

        // Leer el archivo de restauración
        $contenidoRespaldo = file_get_contents($archivoRestauracion);

        // Dividir el contenido en sentencias SQL individuales
        $sentencias = explode(";\n", $contenidoRespaldo);

        // Restaurar las tablas en el orden adecuado
        foreach ($sentencias as $sentencia) {
            $sentencia = trim($sentencia);

            if (!empty($sentencia)) {
                $conexion->query($sentencia);
            }
        }

        // Activar las comprobaciones de llaves foráneas
        $conexion->query('SET FOREIGN_KEY_CHECKS = 1');

        $conexion->close();
        unlink($archivoRestauracion);
        header("Location: javascript:history.back();");
    }
?>