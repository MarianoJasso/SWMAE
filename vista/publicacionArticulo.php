<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Articulos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-4 border-bottom bg-body-tertiary">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="index.php" class="d-inline-flex"><img src="../recursos/logo.png" alt="Logo" width="100"></a>
            </div>
    
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 link-dark link-opacity-50-hover">Inicio</a></li>
                <li><a href="adoptar.php" class="nav-link px-2 link-dark link-opacity-50-hover">Adoptar</a></li>
                <li><a href="publicacionArticulo.php" class="nav-link px-2 link-secondary">Articulos</a></li>
                <li><a href="publicacionHistoria.php" class="nav-link px-2 link-dark link-opacity-50-hover">Historias</a></li>
                <li><a href="nosotros.php" class="nav-link px-2 link-dark link-opacity-50-hover">Nosotros</a></li>
            </ul>
    
            <div class="col-md-3 text-end">
                <a href="inicioSesion.php"><button type="button" class="btn btn-outline-dark me-2">Iniciar Sesión</button></a>
                <a href="registro.php"><button type="button" class="btn btn-dark">Registrarse</button></a>
            </div>
        </header>
        
        <div class="container-fluid">
            <hr class="featurette-divider">

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <img src="../recursos/articulo.png" alt="" width="10%">
                <h2 class="display-4 fw-normal text-body-emphasis">Articulos</h2>
            </div>

            <div class="row mb-2">
                <?php include_once "../modelo/publicacion.php"; ?>
                <?php include_once "../modelo/articulo.php"; ?>
                <?php include_once "../modelo/profesional.php"; ?>
                <?php $articulos = Articulo::buscarDos();?>
                <?php if(!is_null($articulos)): ?>
                    <?php foreach($articulos as $articuloU): ?>
                        <?php $publicaciones = Publicacion::buscarIdADos($articuloU->id); ?>
                        <?php if(!is_null($publicaciones)): ?>
                            <?php foreach($publicaciones as $publicacionU): ?>
                                <?php $profesionales = Profesional::buscarIdDos($publicacionU->usuario); ?>
                                <?php foreach($profesionales as $profesionalU): ?>

                                    <div class="col-md-4">
                                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                                            <div class="col p-4 d-flex flex-column position-static">
                                                <strong class="d-inline-block mb-2 text-primary-emphasis"><?php echo $profesionalU->nombre." ".$profesionalU->apellido; ?></strong>
                                                <h3 class="mb-0"><?php echo $publicacionU->titulo; ?></h3>
                                                <p class="card-text mb-auto"><?php echo $publicacionU->fecha; ?></p>
                                                <a href="detalles/articulos.php?idP=<?php echo $publicacionU->id; ?>&?id=<?php echo $articuloU->id; ?>"><button type="button" class="w-50 btn btn-outline-primary">Continuar leyendo</button></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h5>No existen articulos almacenados</h5>
                <?php endif; ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>