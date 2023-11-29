<?php
    include_once '../modelo/usuario.php';
    session_start();

    if(isset($_POST['id'])){
        $id = htmlentities($_POST['id']);

        if(Usuario::eliminar($id)){
            header("Location: ../vista/administrador/gestiones.php");
            die();
        }else{
            header("Location: ../vista/administrador/gestiones.php");
            die();
        }
    }
?>