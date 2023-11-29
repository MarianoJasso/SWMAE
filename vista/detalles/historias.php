<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lectura de historia</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-4 border-bottom bg-body-tertiary">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="../index.php" class="d-inline-flex"><img src="../../recursos/logo.png" alt="Logo" width="100"></a>
            </div>
    
            <div class="col-md-3 text-end">
                <a href="inicioSesion.php"><button type="button" class="btn btn-outline-dark me-2">Iniciar Sesión</button></a>
                <a href="registro.php"><button type="button" class="btn btn-dark">Registrarse</button></a>
            </div>
        </header>

        <div class="container">
            <div class="py-5 text-center">
                <h2>Lectura de historia</h2>
                <p class="lead">Disfruta de una historia de éxito</p>
            </div>

            <?php include_once "../../modelo/publicacion.php"; ?>
            <?php include_once "../../modelo/propietario.php"; ?>
            <?php include_once "../../modelo/experto.php"; ?>
            <?php include_once "../../modelo/historia.php"; ?>
            <?php $publicaciones = Publicacion::buscarIdP($_GET["idP"]); ?>
            <?php if(!is_null($publicaciones)): ?>
                <?php foreach($publicaciones as $publicacionU): ?>
                    <?php $historia = Historia::buscarId($publicacionU->historia); ?>
                    <?php if(!is_null($historia)): ?>
                        <?php foreach($historia as $historiaU): ?>
                            <?php $propietarios = Propietario::buscarId($publicacionU->usuario); ?>
                            <?php if(!is_null($propietarios)): ?>
                                <?php foreach($propietarios as $propietarioU): ?>
                                    <div class="row g-5">
                                        <div class="col-md-4 col-lg-4 order-md-last">
                                            <h4 class="mb-3">Opciones</h4>
                                            
                                            <a href="../publicacionHistoria.php"><button class="w-100 btn btn-secondary mt-4" type="button">Regresar</button></a>
                                        </div>
                                        <div class="col-md-8 col-lg-8">
                                            <h4 class="mb-3">Historia</h4>
                                            
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <h5 class="card-title"><?php echo $publicacionU->titulo; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-subtitle text-body-secondary"><?php echo $propietarioU->nombre." ".$propietarioU->apellido; ?></h5>
                                                    <p class="card-text"><?php echo $historiaU->descripcion; ?></p>
                                                    <p class="text-body-secondary"><?php echo $publicacionU->cuerpo; ?></p>
                                                </div>
                                                <div class="card-footer text-body-secondary">
                                                    <?php echo $publicacionU->fecha; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <?php $expertos = Experto::buscarId($publicacionU->usuario); ?>
                                <?php foreach($expertos as $expertoU): ?>
                                    <div class="row g-5">
                                        <div class="col-md-4 col-lg-4 order-md-last">
                                            <h4 class="mb-3">Opciones</h4>
                                            
                                            <a href="../publicacionHistoria.php"><button class="w-100 btn btn-secondary mt-4" type="button">Regresar</button></a>
                                        </div>
                                        <div class="col-md-8 col-lg-8">
                                            <h4 class="mb-3">Historia</h4>
                                            
                                            <div class="card text-center">
                                                <div class="card-header">
                                                    <h5 class="card-title"><?php echo $publicacionU->titulo; ?></h5>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-subtitle text-body-secondary"><?php echo $expertoU->nombre." ".$expertoU->apellido; ?></h5>
                                                    <p class="card-text"><?php echo $historiaU->descripcion; ?></p>
                                                    <p class="text-body-secondary"><?php echo $publicacionU->cuerpo; ?></p>
                                                </div>
                                                <div class="card-footer text-body-secondary">
                                                    <?php echo $publicacionU->fecha; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>