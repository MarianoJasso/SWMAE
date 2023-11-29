<?php
    include_once '../modelo/historia.php';
    session_start();

    if(isset($_SESSION['propietario'])){
        $salida = "propietario/historia";
    }elseif (isset($_SESSION['experto'])) {
        $salida = "experto/historia";
    }else{
        $salida = "administrador/gestiones";
    }

    if(isset($_POST['id'])){
        $id = htmlentities($_POST['id']);

        if(Historia::eliminar($id)){
            header("Location: ../vista/".$salida.".php");
            die();
        }else{
            header("Location: ../vista/".$salida.".php");
            die();
        }
    }
?>