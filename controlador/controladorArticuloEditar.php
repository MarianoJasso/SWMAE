<?php
    include_once '../modelo/publicacion.php';
    include_once '../modelo/articulo.php';
    session_start();

    if(isset($_SESSION['profesional'])){
        $salida = "profesional/articulo";
    }else{
        $salida = "administrador/gestiones";
    }

    if (isset($_POST['idP']) && isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['enlace']) && isset($_POST['cuerpo'])) {
        $idP = htmlentities($_POST['idP']);
        $id = htmlentities($_POST['id']);
        $titulo = htmlspecialchars($_POST['titulo'],ENT_QUOTES, 'UTF-8');
        $enlace = htmlspecialchars($_POST['enlace'],ENT_QUOTES, 'UTF-8');
        $cuerpo = htmlspecialchars($_POST['cuerpo'],ENT_QUOTES, 'UTF-8');

        $nuevo_articulo = new Articulo($id, $enlace);
        
        if ($nuevo_articulo->actualizar()) {
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