<?php
    include_once '../modelo/usuario.php';
    include_once '../modelo/experto.php';
    include_once '../modelo/direccion.php';
    session_start();

    if (isset($_POST['idU']) && isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['area']) && isset($_POST['desc']) && isset($_POST['estado']) && isset($_POST['ciudad']) && isset($_POST['detalles'])) {
        $idU = htmlentities($_POST['idU']);
        $id = htmlentities($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES, 'UTF-8');
        $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars($_POST['correo'],ENT_QUOTES, 'UTF-8');
        $area = htmlspecialchars($_POST['area'],ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST['desc'],ENT_QUOTES, 'UTF-8');
        $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES, 'UTF-8');
        $ciudad = htmlspecialchars($_POST['ciudad'],ENT_QUOTES, 'UTF-8');
        $detalles = htmlspecialchars($_POST['detalles'],ENT_QUOTES, 'UTF-8');

        $nuevo_usuario = new Usuario($idU, $correo, "", "", "");
        $usuarios = Usuario::buscarIdDos($idU);
        foreach ($usuarios as $usuarioU) {
            $direccionId = $usuarioU->direccion;
        }

        if ($nuevo_usuario->actualizar()) {
            $nuevo_experto = new Experto($id, $nombre, $apellido, $area, $descripcion, $idU);
            
            if ($nuevo_experto->actualizar()) {
                $nuevo_direccion = new Direccion($direccionId, $ciudad, $estado, $detalles);

                if ($nuevo_direccion->actualizar()) {
                    header("Location: ../vista/administrador/gestiones.php");
                    die();
                }else {
                    header("Location: ../vista/administrador/gestiones.php");
                    die();
                }
            }else {
                header("Location: ../vista/administrador/gestiones.php");
                die();
            }
        }else {
            header("Location: ../vista/administrador/gestiones.php");
            die();
        }
    }
?>