<?php
    include_once '../modelo/mascota.php';
    include_once '../modelo/adopcion.php';
    session_start();

    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['numero'])) {
        $id = htmlentities($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES, 'UTF-8');
        $correo = htmlspecialchars($_POST['correo'],ENT_QUOTES, 'UTF-8');
        $numero = htmlspecialchars($_POST['numero'],ENT_QUOTES, 'UTF-8');

        $nuevo_adopcion = new Adopcion(0, $id, $nombre, $correo, $numero);
        
        if ($nuevo_adopcion->guardar()) {
            $nuevo_mascota = new Mascota($id, "", "", "", "", "", "", "", "", "Adoptado", "", "");

            if($nuevo_mascota->actualizarEstatus()){
                header("Location: ../vista/adoptar.php");
                die();
            }else{
                header("Location: ../vista/adoptar.php");
                die();
            }
        }else {
            header("Location: ../vista/adoptar.php");
            die();
        }
    }
?>