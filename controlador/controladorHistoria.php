<?php
    include_once '../conexion/bd.php';
    include_once '../modelo/historia.php';
    include_once '../modelo/publicacion.php';
    session_start();

    if(isset($_SESSION['propietario'])){
        $salida = "propietario";
    }else{
        $salida = "experto";
    }

    if (isset($_POST['titulo']) && isset($_POST['descri']) && isset($_POST['cuerpo'])) {
        $titulo = htmlspecialchars($_POST['titulo'],ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars($_POST['descri'],ENT_QUOTES, 'UTF-8');
        $cuerpo = htmlspecialchars($_POST['cuerpo'],ENT_QUOTES, 'UTF-8');

        $nuevo_historia = new Historia(0, $descripcion);
        
        if ($nuevo_historia->guardar()) {
            $historias = Historia::buscardescripcion($descripcion);
            foreach ($historias as $historiaU) {
                $historiaId = $historiaU->id;
            }
            $nuevo_publicacion = new Publicacion(0, $_SESSION['id'], $titulo, "", $cuerpo, "", $historiaId);

            if($nuevo_publicacion->existe()){
                header("Location: ../vista/".$salida."/historia.php");
                die();
            }else{
                if ($nuevo_publicacion->guardarHistoria()) {
                    header("Location: ../vista/".$salida."/historia.php");
                    die();
                }else {
                    header("Location: ../vista/".$salida."/historia.php");
                    die();
                }
            }
        }else {
            header("Location: ../vista/".$salida."/historia.php");
            die();
        }
    }
?>