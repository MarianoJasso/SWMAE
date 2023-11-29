<?php
    include_once '../conexion/bd.php';
    include_once '../modelo/usuario.php';
    session_start();

    $correo = htmlentities($_POST['correo']);
    $password = htmlentities($_POST['password']);

    $nuevo_usuario = new Usuario(0, $correo, $password, "", 0);

    if($nuevo_usuario->existe()){
        $db = new DB();

        $sql = "SELECT idUsuario FROM usuario WHERE correoUsuario = '".$correo."'";
        if($db->conectar()){
            $resultado = $db->conn->query($sql);
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()){
                    $bandera = $row['idUsuario'];
                }
            }else{
                $db->cerrar();
                header("Location: ../vista/registro.php");
                die();
            }

            // Consultar en la tabla propietario
            $query = "SELECT * FROM propietario WHERE idUsuario = '$bandera'";
            $result = $db->conn->query($query);

            if ($result->num_rows > 0) {
                // El usuario es un propietario, redirige como propietario
                $nuevo_usuario->guardarSesion();
                $nuevo_usuario->guardarSesionPropi();
                $db->cerrar();
                header("Location: ../vista/propietario/perfil.php");
                die();
            }

            // Consultar en la tabla experto
            $query = "SELECT * FROM experto WHERE idUsuario = '$bandera'";
            $result = $db->conn->query($query);

            if ($result->num_rows > 0) {
                // El usuario es un experto, redirige como experto
                $nuevo_usuario->guardarSesion();
                $nuevo_usuario->guardarSesionExpe();
                $db->cerrar();
                header("Location: ../vista/experto/perfil.php");
                die();
            }

            // Consultar en la tabla profesional
            $query = "SELECT * FROM profesional WHERE idUsuario = '$bandera'";
            $result = $db->conn->query($query);

            if ($result->num_rows > 0) {
                // El usuario es un profesional, redirige como profesional
                $nuevo_usuario->guardarSesion();
                $nuevo_usuario->guardarSesionProfe();
                $db->cerrar();
                header("Location: ../vista/profesional/perfil.php");
                die();
            }

            // Si el usuario no se encuentra en ninguna tabla, redirige como administrador
            $nuevo_usuario->guardarSesion();
            $db->cerrar();
            header("Location: ../vista/administrador/gestiones.php");
            die();
        }
    }else{
        header("Location: ../vista/registro.php");
        die();
    }
?>