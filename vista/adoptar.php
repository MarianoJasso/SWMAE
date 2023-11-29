<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adoptar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-4 border-bottom bg-body-tertiary">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="index.php" class="d-inline-flex"><img src="../recursos/logo.png" alt="Logo" width="100"></a>
            </div>
    
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 link-dark link-opacity-50-hover">Inicio</a></li>
                <li><a href="adoptar.php" class="nav-link px-2 link-secondary">Adoptar</a></li>
                <li><a href="publicacionArticulo.php" class="nav-link px-2 link-dark link-opacity-50-hover">Articulos</a></li>
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
                <img src="../recursos/adopcion.png" alt="" width="10%">
                <h2 class="display-4 fw-normal text-body-emphasis">Adopción de mascotas</h2>
            </div>

            <div class="row row-cols-1 row-cols-md-4 mb-3">
                <?php include_once "../modelo/mascota.php"; ?>
                <?php include_once "../modelo/propietario.php"; ?>
                <?php $mascotas = Mascota::buscarDos();?>
                <?php if(!is_null($mascotas)): ?>
                    <?php foreach($mascotas as $mascotaU): ?>
                        <?php if(($mascotaU->estatus == "Disponible")): ?>
                            <div class="col">
                                <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-header py-3 text-center">
                                        <h4 class="my-0 fw-normal"><?php echo $mascotaU->nombre; ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col d-flex flex-column position-static">
                                                <h3 class="card-title pricing-card-title"><?php echo $mascotaU->especie; ?></h3>
                                                <ul class="list-unstyled mt-3 mb-4">
                                                    <li><?php echo $mascotaU->fechaRegistro; ?></li>    
                                                    <li><?php echo $mascotaU->sexo; ?></li>
                                                    <li><?php echo $mascotaU->edad; ?></li>
                                                </ul>
                                            </div>
                                            <div class="col d-flex flex-column position-static text-center">
                                                <img src="data:image/*;base64,<?php echo base64_encode($mascotaU->imagen); ?>" alt='Imagen mascota' width="100">
                                            </div>
                                            <a href="detalles/mascotas.php?id=<?php echo $mascotaU->id; ?>"><button type="button" class="w-100 btn btn-outline-primary mt-2">Adoptar</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h5>No existen mascotas almacenadas</h5>
                <?php endif; ?>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>