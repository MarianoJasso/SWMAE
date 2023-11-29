<?php
    include_once '../modelo/mascota.php';
    session_start();

    if(isset($_SESSION['propietario'])){
        $salida = "propietario/adopcion";
    }else{
        $salida = "administrador/gestiones";
    }

    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['especie']) && isset($_POST['tamano']) && isset($_POST['sexo']) && isset($_POST['edad']) && isset($_POST['color']) && isset($_POST['personalidad']) && isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $id = htmlentities($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES, 'UTF-8');
        $especie = htmlspecialchars($_POST['especie'],ENT_QUOTES, 'UTF-8');
        $tamano = htmlspecialchars($_POST['tamano'],ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST['sexo'],ENT_QUOTES, 'UTF-8');
        $edad = htmlspecialchars($_POST['edad'],ENT_QUOTES, 'UTF-8');
        $color = htmlspecialchars($_POST['color'],ENT_QUOTES, 'UTF-8');
        $personalidad = htmlspecialchars($_POST['personalidad'],ENT_QUOTES, 'UTF-8');
        $imagen = file_get_contents($_FILES["imagen"]["tmp_name"]);

        $nuevo_mascota = new Mascota($id, $nombre, $especie, $tamano, $sexo, $edad, $color, $personalidad, "", "", $imagen, "");
        
        if ($nuevo_mascota->actualizarI()) {
            header("Location: ../vista/".$salida.".php");
            die();
        }else {
            header("Location: ../vista/".$salida.".php");
            die();
        }
    }

    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['especie']) && isset($_POST['tamano']) && isset($_POST['sexo']) && isset($_POST['edad']) && isset($_POST['color']) && isset($_POST['personalidad'])) {
        $id = htmlentities($_POST['id']);
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES, 'UTF-8');
        $especie = htmlspecialchars($_POST['especie'],ENT_QUOTES, 'UTF-8');
        $tamano = htmlspecialchars($_POST['tamano'],ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST['sexo'],ENT_QUOTES, 'UTF-8');
        $edad = htmlspecialchars($_POST['edad'],ENT_QUOTES, 'UTF-8');
        $color = htmlspecialchars($_POST['color'],ENT_QUOTES, 'UTF-8');
        $personalidad = htmlspecialchars($_POST['personalidad'],ENT_QUOTES, 'UTF-8');

        $nuevo_mascota = new Mascota($id, $nombre, $especie, $tamano, $sexo, $edad, $color, $personalidad, "", "", "", "");
        
        if ($nuevo_mascota->actualizar()) {
            header("Location: ../vista/".$salida.".php");
            die();
        }else {
            header("Location: ../vista/".$salida.".php");
            die();
        }
    }
?>