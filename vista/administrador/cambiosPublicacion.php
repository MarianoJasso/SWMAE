<?php
    session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: ../inicioSesion.php');
        die();
    }

    if(isset($_SESSION['propietario'])){
        $salida = "../propietario/historia";
    }elseif (isset($_SESSION['experto'])) {
        $salida = "../experto/historia";
    }elseif (isset($_SESSION['profesional'])) {
        $salida = "../profesional/articulo";
    }else{
        $salida = "gestiones";
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cambios en Publicacion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-4 border-bottom bg-body-tertiary">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="gestiones.php" class="d-inline-flex"><img src="../../recursos/logo.png" alt="Logo" width="100"></a>
            </div>
    
            <div class="col-md-3 text-end">
                <a href="../../conexion/cerrarSesion.php"><button type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button></a>
            </div>
        </header>

        <div class="container">
            <div class="py-5 text-center">
                <h2>Cambios en Publicacion</h2>
                <p class="lead">Cambio en información de registro de publicacion</p>
            </div>

            <?php include_once "../../modelo/publicacion.php"; ?>
            <?php include_once "../../modelo/historia.php"; ?>
            <?php include_once "../../modelo/articulo.php"; ?>

            <?php if(isset($_GET["id1"])): ?>
                <form action="../../controlador/controladorHistoriaEditar.php" method="POST" class="needs-validation" novalidate>
                    <div class="row g-5">
                        <div class="col-md-4 col-lg-4 order-md-last">
                            <h4 class="mb-3">Opciones</h4>
                            
                            <button class="w-100 btn btn-primary mt-4" type="submit">Actualizar</button>
                            <input type="hidden" id="idP" name="idP" value="<?php echo $_GET["idP"]; ?>">
                            <input type="hidden" id="id" name="id" value="<?php echo $_GET["id1"]; ?>">

                            <a href="<?php echo $salida; ?>.php"><button class="w-100 btn btn-secondary mt-4" type="button">Cancelar</button></a>
                        </div>
                        <div class="col-md-8 col-lg-8">
                            <h4 class="mb-3">Información de Historia</h4>
                            
                            <?php $publicaciones = Publicacion::buscarIdP($_GET["idP"]); ?>
                            <?php if(!is_null($publicaciones)): ?>
                                <?php foreach($publicaciones as $publicacionU): ?>
                                    <?php $historias = Historia::buscarId($_GET["id1"]); ?>
                                    <?php if(!is_null($historias)): ?>
                                        <?php foreach($historias as $hsitoriaU): ?>
                                            <div class="row g-3 mb-4">
                                                <div class="col-sm-12">
                                                    <label for="titulo" class="form-label">Titulo</label>
                                                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingresar titulo..." value="<?php echo $publicacionU->titulo; ?>" required>
                                                    <div class="invalid-feedback">
                                                        Se requiere titulo...
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label for="descri" class="form-label">Descripción</label>
                                                    <textarea class="form-control" name="descri" id="descri" placeholder="Ingresar descripción..." required><?php echo $hsitoriaU->descripcion; ?></textarea>
                                                    <div class="invalid-feedback">
                                                        Se requiere descripción...
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label for="cuerpo" class="form-label">Cuenta la historia</label>
                                                    <textarea class="form-control" name="cuerpo" id="cuerpo" placeholder="Ingresar historia..." required><?php echo $publicacionU->cuerpo; ?></textarea>
                                                    <div class="invalid-feedback">
                                                        Se requiere historia...
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            <?php elseif(isset($_GET["id2"])): ?>
                <form action="../../controlador/controladorArticuloEditar.php" method="POST" class="needs-validation" novalidate>
                    <div class="row g-5">
                        <div class="col-md-4 col-lg-4 order-md-last">
                            <h4 class="mb-3">Opciones</h4>
                            
                            <button class="w-100 btn btn-primary mt-4" type="submit">Actualizar</button>
                            <input type="hidden" id="idP" name="idP" value="<?php echo $_GET["idP"]; ?>">
                            <input type="hidden" id="id" name="id" value="<?php echo $_GET["id2"]; ?>">

                            <a href="<?php echo $salida; ?>.php"><button class="w-100 btn btn-secondary mt-4" type="button">Cancelar</button></a>
                        </div>
                        <div class="col-md-8 col-lg-8">
                        <h4 class="mb-3">Información de Articulo</h4>
                            
                            <?php $publicaciones = Publicacion::buscarIdP($_GET["idP"]); ?>
                            <?php if(!is_null($publicaciones)): ?>
                                <?php foreach($publicaciones as $publicacionU): ?>
                                    <?php $articulos = Articulo::buscarId($_GET["id2"]); ?>
                                    <?php if(!is_null($articulos)): ?>
                                        <?php foreach($articulos as $articuloU): ?>
                                            <div class="row g-3 mb-4">
                                                <div class="col-sm-12">
                                                    <label for="titulo" class="form-label">Titulo</label>
                                                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingresar titulo..." value="<?php echo $publicacionU->titulo; ?>" required>
                                                    <div class="invalid-feedback">
                                                        Se requiere titulo...
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label for="enlace" class="form-label">Enlace de apoyo (link)</label>
                                                    <input type="text" class="form-control" name="enlace" id="enlace" placeholder="Ingresar enlace de apoyo..." value="<?php echo $articuloU->enlace; ?>" required>
                                                    <div class="invalid-feedback">
                                                        Se requiere enlace de apoyo...
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <label for="cuerpo" class="form-label">Cuenta la historia</label>
                                                    <textarea class="form-control" name="cuerpo" id="cuerpo" placeholder="Ingresar historia..." required><?php echo $publicacionU->cuerpo; ?></textarea>
                                                    <div class="invalid-feedback">
                                                        Se requiere historia...
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            <?php else: ?>
            <?php endif; ?>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>