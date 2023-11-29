<?php
    include_once '../modelo/articulo.php';
    session_start();

    if(isset($_SESSION['profesional'])){
        $salida = "profesional/articulo";
    }else{
        $salida = "administrador/gestiones";
    }

    if(isset($_POST['id'])){
        $id = htmlentities($_POST['id']);

        if(Articulo::eliminar($id)){
            header("Location: ../vista/".$salida.".php");
            die();
        }else{
            header("Location: ../vista/".$salida.".php");
            die();
        }
    }
?>