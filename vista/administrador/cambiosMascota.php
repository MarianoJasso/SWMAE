<?php
    session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: ../inicioSesion.php');
        die();
    }

    if(isset($_SESSION['propietario'])){
        $salida = "../propietario/adopcion";
    }else{
        $salida = "gestiones";
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cambios en Mascota</title>
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
                <h2>Cambios en Mascota</h2>
                <p class="lead">Cambio en información de registro de mascota</p>
            </div>

            <?php include_once "../../modelo/mascota.php"; ?>
            <form action="../../controlador/controladorMascotaEditar.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                        
                        <button class="w-100 btn btn-primary mt-4" type="submit">Actualizar</button>
                        <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"]; ?>">

                        <a href="<?php echo $salida; ?>.php"><button class="w-100 btn btn-secondary mt-4" type="button">Cancelar</button></a>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <h4 class="mb-3">Información de mascota</h4>
                        
                        <?php $mascotas = Mascota::buscarId($_GET["id"]); ?>
                        <?php if(!is_null($mascotas)): ?>
                            <?php foreach($mascotas as $mascotaU): ?>
                                <div class="row g-3 mb-4">
                                    <div class="col-sm-6">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre..." value="<?php echo $mascotaU->nombre; ?>" required>
                                        <div class="invalid-feedback">
                                            Se requiere nombre...
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="especie" class="form-label">Especie</label>
                                        <input type="text" class="form-control" name="especie" id="especie" placeholder="Ingresar especie..." value="<?php echo $mascotaU->especie; ?>" required>
                                        <div class="invalid-feedback">
                                            Se requiere especie...
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="tamano" class="form-label">Tamaño</label>
                                        <input type="text" class="form-control" name="tamano" id="tamano" placeholder="Ingresar tamaño..." value="<?php echo $mascotaU->tamano; ?>" required>
                                        <div class="invalid-feedback">
                                            Se requiere tamaño...
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <input type="text" class="form-control" name="sexo" id="sexo" placeholder="Ingresar sexo..." value="<?php echo $mascotaU->sexo; ?>" required>
                                        <div class="invalid-feedback">
                                            Se requiere sexo de la mascota...
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="edad" class="form-label">Edad</label>
                                        <input type="text" class="form-control" name="edad" id="edad" placeholder="Ingresar edad..." value="<?php echo $mascotaU->edad; ?>" required>
                                        <div class="invalid-feedback">
                                            Se requiere edad...
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="color" class="form-label">Color</label>
                                        <input type="text" class="form-control" name="color" id="color" placeholder="Ingresar color..." value="<?php echo $mascotaU->color; ?>" required>
                                        <div class="invalid-feedback">
                                            Se requiere color...
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="personalidad" class="form-label">Personalidad</label>
                                        <textarea class="form-control" name="personalidad" id="personalidad" placeholder="Ingresar personalidad..." required><?php echo $mascotaU->personalidad; ?></textarea>
                                        <div class="invalid-feedback">
                                            Se requiere personalidad...
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="imagen" class="form-label">Imagen</label>
                                        <input type="file" accept="image/*" class="form-control" name="imagen" id="imagen" placeholder="Ingresar imagen..." value="">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>