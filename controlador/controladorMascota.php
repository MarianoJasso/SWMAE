<?php
    include_once '../conexion/bd.php';
    include_once '../modelo/mascota.php';
    session_start();

    if (isset($_POST['nombre']) && isset($_POST['especie']) && isset($_POST['tamano']) && isset($_POST['sexo']) && isset($_POST['edad']) && isset($_POST['color']) && isset($_POST['personalidad'])) {
        $nombre = htmlspecialchars($_POST['nombre'],ENT_QUOTES, 'UTF-8');
        $especie = htmlspecialchars($_POST['especie'],ENT_QUOTES, 'UTF-8');
        $tamano = htmlspecialchars($_POST['tamano'],ENT_QUOTES, 'UTF-8');
        $sexo = htmlspecialchars($_POST['sexo'],ENT_QUOTES, 'UTF-8');
        $edad = htmlspecialchars($_POST['edad'],ENT_QUOTES, 'UTF-8');
        $color = htmlspecialchars($_POST['color'],ENT_QUOTES, 'UTF-8');
        $personalidad = htmlspecialchars($_POST['personalidad'],ENT_QUOTES, 'UTF-8');
        $imagen = file_get_contents($_FILES["imagen"]["tmp_name"]);

        $nuevo_mascota = new Mascota(0, $nombre, $especie, $tamano, $sexo, $edad, $color, $personalidad, "", "Disponible", $imagen, $_SESSION['propietario']);
        
        if($nuevo_mascota->existe()){
            header("Location: ../vista/propietario/adopcion.php");
            die();
        }else{
            if ($nuevo_mascota->guardar()) {
                header("Location: ../vista/propietario/adopcion.php");
                die();
            }else {
                header("Location: ../vista/propietario/adopcion.php");
                die();
            }
        }
    }
?>