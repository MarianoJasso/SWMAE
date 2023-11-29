<?php
    include_once '../conexion/bd.php';
    include_once '../modelo/articulo.php';
    include_once '../modelo/publicacion.php';
    session_start();

    if (isset($_POST['titulo']) && isset($_POST['enlace']) && isset($_POST['cuerpo'])) {
        $titulo = htmlspecialchars($_POST['titulo'],ENT_QUOTES, 'UTF-8');
        $enlace = htmlspecialchars($_POST['enlace'],ENT_QUOTES, 'UTF-8');
        $cuerpo = htmlspecialchars($_POST['cuerpo'],ENT_QUOTES, 'UTF-8');

        $nuevo_articulo = new Articulo(0, $enlace);
        
        if ($nuevo_articulo->guardar()) {
            $articulos = Articulo::buscarenlace($enlace);
            foreach ($articulos as $articuloU) {
                $articuloId = $articuloU->id;
            }
            $nuevo_publicacion = new Publicacion(0, $_SESSION['id'], $titulo, "", $cuerpo, $articuloId, "");

            if($nuevo_publicacion->existe()){
                header("Location: ../vista/profesional/articulo.php");
                die();
            }else{
                if ($nuevo_publicacion->guardarArticulo()) {
                    header("Location: ../vista/profesional/articulo.php");
                    die();
                }else {
                    header("Location: ../vista/profesional/articulo.php");
                    die();
                }
            }
        }else {
            header("Location: ../vista/profesional/articulo.php");
            die();
        }
    }
?>