<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adopción de Mascota</title>
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
                <h2>Adopción de Mascota</h2>
                <p class="lead">Adopta a una mascota</p>
            </div>

            <?php include_once "../../modelo/mascota.php"; ?>
            <?php include_once "../../modelo/propietario.php"; ?>
            <form action="../../controlador/controladorAdopcion.php" method="POST" class="needs-validation" novalidate>
                <div class="row g-5">
                    <div class="col-md-4 col-lg-4 order-md-last">
                        <h4 class="mb-3">Foto de mascota</h4>
                        <div class="text-center">
                            <?php $mascotas = Mascota::buscarId($_GET["id"]); ?>
                            <?php if(!is_null($mascotas)): ?>
                                <?php foreach($mascotas as $mascotaU): ?>
                                    <img src="data:image/*;base64,<?php echo base64_encode($mascotaU->imagen); ?>" alt='Imagen mascota' height="200">
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <h4 class="mt-5 mb-3">Opciones</h4>
                        
                        <a href="../adoptar.php"><button class="w-100 btn btn-secondary mt-4" type="button">Regresar</button></a>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <h4 class="mb-3">Información de mascota</h4>
                        
                        <?php $mascotas = Mascota::buscarId($_GET["id"]); ?>
                        <?php if(!is_null($mascotas)): ?>
                            <?php foreach($mascotas as $mascotaU): ?>
                                <div class="row g-3 mb-4">
                                    <div class="col-sm-6">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" value="<?php echo $mascotaU->nombre; ?>" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Especie</label>
                                        <input type="text" class="form-control" value="<?php echo $mascotaU->especie; ?>" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Tamaño</label>
                                        <input type="text" class="form-control" value="<?php echo $mascotaU->tamano; ?>" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Sexo</label>
                                        <input type="text" class="form-control" value="<?php echo $mascotaU->sexo; ?>" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Edad</label>
                                        <input type="text" class="form-control" value="<?php echo $mascotaU->edad; ?>" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Color</label>
                                        <input type="text" class="form-control" value="<?php echo $mascotaU->color; ?>" disabled>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form-label">Personalidad</label>
                                        <textarea class="form-control" disabled><?php echo $mascotaU->personalidad; ?></textarea>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <h4 class="mb-3">Información de dueño</h4>
                        
                        <?php $propietarios = Propietario::buscarIdM($mascotaU->propietario); ?>
                        <?php if(!is_null($propietarios)): ?>
                            <?php foreach($propietarios as $propietarioU): ?>
                                <div class="row g-3 mb-4">
                                    <div class="col-sm-12">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" value="<?php echo $propietarioU->nombre." ".$propietarioU->apellido; ?>" disabled>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form-label">Numero telefonico</label>
                                        <input type="text" class="form-control" value="<?php echo $propietarioU->telefono; ?>" disabled>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row g-5">
                    <div class="col-md-4 col-lg-4 order-md-last">
                        <button class="w-100 btn btn-primary mt-4" type="submit">Adoptar</button>
                        <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"]; ?>">
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <h4 class="mb-3">Información para ser candidato</h4>
                        
                        <div class="row g-3 mb-4">
                            <div class="col-sm-12">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere nombre...
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="correo" class="form-label">Correo electronico</label>
                                <input type="text" class="form-control" name="correo" id="correo" placeholder="Ingresar correo..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere correo...
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="numero" class="form-label">Numero telefonico</label>
                                <input type="text" class="form-control" name="numero" id="numero" placeholder="Ingresar numero..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere numero...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>