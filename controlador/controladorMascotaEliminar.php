<?php
    include_once '../modelo/mascota.php';
    session_start();

    if(isset($_SESSION['propietario'])){
        $salida = "propietario/adopcion";
    }else{
        $salida = "administrador/gestiones";
    }

    if(isset($_POST['id'])){
        $id = htmlentities($_POST['id']);

        if(Mascota::eliminar($id)){
            header("Location: ../vista/".$salida.".php");
            die();
        }else{
            header("Location: ../vista/".$salida.".php");
            die();
        }
    }
?>