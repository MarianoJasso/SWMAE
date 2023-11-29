<?php
    include_once '../modelo/publicacion.php';
    include_once '../modelo/historia.php';
    session_start();

    if(isset($_SESSION['propietario'])){
        $salida = "propietario/historia";
    }elseif (isset($_SESSION['experto'])) {
        $salida = "experto/historia";
    }else{
        $salida = "administrador/gestiones";
    }

    if (isset($_POST['idP']) && isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['descri']) && isset($_POST['cuerpo'])) {
        $idP = htmlentities($_POST['idP']);
        $id = htmlentities($_POST['id']);
        $titulo = htmlspecialchars($_POST['titulo'],ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST['descri'],ENT_QUOTES, 'UTF-8');
        $cuerpo = htmlspecialchars($_POST['cuerpo'],ENT_QUOTES, 'UTF-8');

        $nuevo_historia = new Historia($id, $descripcion);
        
        if ($nuevo_historia->actualizar()) {
            $nuevo_publicacion = new Publicacion($idP, "", $titulo, "", $cuerpo, "", $id);
            
            if ($nuevo_publicacion->actualizar()) {
                header("Location: ../vista/".$salida.".php");
                die();
            }else {
                header("Location: ../vista/".$salida.".php");
                die();
            }
        }else {
            header("Location: ../vista/".$salida.".php");
            die();
        }
    }
?>