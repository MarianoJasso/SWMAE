<?php
    include_once '../modelo/usuario.php';
    include_once '../modelo/profesional.php';
    include_once '../modelo/direccion.php';
    session_start();

    if (isset($_POST['idU']) && isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['correo']) && isset($_POST['especialidad']) && isset($_POST['experiencia']) && isset($_POST['estado']) && isset($_POST['ciudad']) && isset($_POST['detalles'])) {
        $idU = htmlentities($_POST['idU']);
        $id = htmlentities($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES, 'UTF-8');
        $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars($_POST['correo'],ENT_QUOTES, 'UTF-8');
        $especialidad = htmlspecialchars($_POST['especialidad'],ENT_QUOTES, 'UTF-8');
        $experiencia = htmlspecialchars($_POST['experiencia'],ENT_QUOTES, 'UTF-8');
        $estado = htmlspecialchars($_POST['estado'],ENT_QUOTES, 'UTF-8');
        $ciudad = htmlspecialchars($_POST['ciudad'],ENT_QUOTES, 'UTF-8');
        $detalles = htmlspecialchars($_POST['detalles'],ENT_QUOTES, 'UTF-8');

        $nuevo_usuario = new Usuario($idU, $correo, "", "", "");
        $usuarios = Usuario::buscarIdDos($idU);
        foreach ($usuarios as $usuarioU) {
            $direccionId = $usuarioU->direccion;
        }

        if ($nuevo_usuario->actualizar()) {
            $nuevo_profesional = new Profesional($id, $nombre, $apellido, $especialidad, $experiencia, $idU);
            
            if ($nuevo_profesional->actualizar()) {
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