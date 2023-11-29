<?php
    include_once '../conexion/bd.php';
    include_once '../modelo/direccion.php';
    include_once '../modelo/usuario.php';
    session_start();

    if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['tipo']) && isset($_POST['correo']) && isset($_POST['password'])) {
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES, 'UTF-8');
        $apellido = htmlspecialchars($_POST['apellido'],ENT_QUOTES, 'UTF-8');
        $tipo = htmlspecialchars($_POST['tipo'],ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars($_POST['correo'],ENT_QUOTES, 'UTF-8');
        $contrasena = htmlspecialchars($_POST['password'],ENT_QUOTES, 'UTF-8');

        $nuevo_usuario = new Usuario(0, $correo, $contrasena, "", "");
        $usuarios = Usuario::buscarCorreo($correo);
        foreach ($usuarios as $usuarioU) {
            $usuarioId = $usuarioU->id;
        }
        if(isset($usuarioId)){
            header("Location: ../vista/registro.php");
            die();
        }else{
            if ($nuevo_usuario->guardar()) {
                $usuarios = Usuario::buscarCorreo($correo);
                foreach ($usuarios as $usuarioU) {
                    $usuarioId = $usuarioU->id;
                }

                switch ($tipo) {
                    case 1:
                        include_once '../modelo/propietario.php';
                        $nuevo_propietario = new Propietario(0, $nombre, $apellido, "", $usuarioId);
                
                        if ($nuevo_propietario->guardar()) {
                            header("Location: ../vista/inicioSesion.php");
                            die();
                        }else {
                            header("Location: ../vista/inicioSesion.php");
                            die();
                        }
                        break;
                    case 2:
                        include_once '../modelo/profesional.php';
                        $nuevo_profesional = new Profesional(0, $nombre, $apellido, "", 0, $usuarioId);
                
                        if ($nuevo_profesional->guardar()) {
                            header("Location: ../vista/inicioSesion.php");
                            die();
                        }else {
                            header("Location: ../vista/inicioSesion.php");
                            die();
                        }
                        break;
                    case 3:
                        include_once '../modelo/experto.php';
                        $nuevo_experto = new Experto(0, $nombre, $apellido, "", "", $usuarioId);
                
                        if ($nuevo_experto->guardar()) {
                            header("Location: ../vista/inicioSesion.php");
                            die();
                        }else {
                            header("Location: ../vista/inicioSesion.php");
                            die();
                        }
                        break;            
                    default:
                        header("Location: ../vista/registro.php");
                        die();
                        break;
                }
            }else {
                header("Location: ../vista/registro.php");
                die();
            }
        }
    }
?>