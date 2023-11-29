<?php
    session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: ../inicioSesion.php');
        die();
    }

    if(isset($_SESSION['profesional'])){
        header('Location: ../profesional/perfil.php');
        die();
    }elseif (isset($_SESSION['experto'])) {
        header('Location: ../experto/perfil.php');
        die();
    }elseif (!isset($_SESSION['propietario'])) {
        header('Location: ../administrador/gestiones.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Adopción - Propietario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-4 border-bottom bg-body-tertiary">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="perfil.php" class="d-inline-flex"><img src="../../recursos/logo.png" alt="Logo" width="100"></a>
            </div>
    
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="perfil.php" class="nav-link px-2 link-dark link-opacity-50-hover">Perfil</a></li>
                <li><a href="../adoptar.php" class="nav-link px-2 link-dark link-opacity-50-hover">Adoptar</a></li>
                <li><a href="../publicacionArticulo.php" class="nav-link px-2 link-dark link-opacity-50-hover">Articulos</a></li>
                <li><a href="../publicacionHistoria.php" class="nav-link px-2 link-dark link-opacity-50-hover">Historias</a></li>
                <li><a href="../nosotros.php" class="nav-link px-2 link-dark link-opacity-50-hover">Nosotros</a></li>
            </ul>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="adopcion.php" class="nav-link px-2 link-secondary">Poner en adopción</a></li>
                <li><a href="historia.php" class="nav-link px-2 link-info link-opacity-50-hover">Subir historia</a></li>
            </ul>
    
            <div class="col-md-3 text-end">
                <a href="../../conexion/cerrarSesion.php"><button type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button></a>
            </div>
        </header>

        <div class="container">
            <div class="py-5 text-center">
                <h2>Adopción de mascotas</h2>
                <p class="lead">Gestión de mascotas para adopción</p>
            </div>

            <div class="row g-5">
                <div class="col-md-4 col-lg-4 order-md-last">
                    <h4 class="mb-3">Registro de nueva mascota</h4>
                    <form action="../../controlador/controladorMascota.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere nombre...
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="especie" class="form-label">Especie</label>
                                <input type="text" class="form-control" name="especie" id="especie" placeholder="Ingresar especie..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere especie...
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="tamano" class="form-label">Tamaño</label>
                                <input type="text" class="form-control" name="tamano" id="tamano" placeholder="Ingresar tamaño..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere tamaño...
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="sexo" class="form-label">Sexo</label>
                                <input type="text" class="form-control" name="sexo" id="sexo" placeholder="Ingresar sexo..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere sexo de la mascota...
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="edad" class="form-label">Edad</label>
                                <input type="text" class="form-control" name="edad" id="edad" placeholder="Ingresar edad..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere edad...
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" name="color" id="color" placeholder="Ingresar color..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere color...
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="personalidad" class="form-label">Personalidad</label>
                                <textarea class="form-control" name="personalidad" id="personalidad" placeholder="Ingresar personalidad..." required></textarea>
                                <div class="invalid-feedback">
                                    Se requiere personalidad...
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="imagen" class="form-label">Imagen</label>
                                <input type="file" accept="image/*" class="form-control" name="imagen" id="imagen" placeholder="Ingresar imagen..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere imagen...
                                </div>
                            </div>
                        </div>

                        <button class="w-100 btn btn-primary mt-4" type="submit">Poner en adopción</button>
                    </form>
                </div>
                <div class="col-md-8 col-lg-8">
                    <h4 class="mb-3">Registros de mascotas</h4>
                    <div class="text-center table-responsive pt-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Especie</th>
                                    <th>Edad</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody class="table-group-divider">
                                <?php include_once "../../modelo/mascota.php"; ?>
                                <?php $mascotas = Mascota::buscarPropietario($_SESSION['propietario']);?>
                                <?php if(!is_null($mascotas)): ?>
                                    <?php foreach($mascotas as $mascotaU): ?>
                                        <?php if(($mascotaU->estatus == "Disponible")): ?>
                                            <tr>
                                                <td><?php echo $mascotaU->nombre; ?></td>
                                                <td><?php echo $mascotaU->especie; ?></td>
                                                <td><?php echo $mascotaU->edad; ?></td>
                                                <td><a href="../administrador/cambiosMascota.php?id=<?php echo $mascotaU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                <form action="../../controlador/controladorMascotaEliminar.php" method="POST">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $mascotaU->id; ?>">
                                                    <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                </form>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h5>No existen mascotas almacenadas</h5>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row g-5 mt-4">
                <div class="col-md-0 col-lg-12 order-md-last"></div>
                <div class="col-md-12 col-lg-12">
                    <h4 class="mb-3">Registros de adopciones</h4>
                    <div class="text-center table-responsive pt-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Nombre mascota</th>
                                    <th>Candidato</th>
                                    <th>Correo</th>
                                    <th>Numero telefonico</th>
                                </tr>
                            </thead>
                            
                            <tbody class="table-group-divider">
                                <?php include_once "../../modelo/mascota.php"; ?>
                                <?php include_once "../../modelo/adopcion.php"; ?>
                                <?php $mascotas = Mascota::buscarPropietario($_SESSION['propietario']);?>
                                <?php if(!is_null($mascotas)): ?>
                                    <?php foreach($mascotas as $mascotaU): ?>
                                        <?php if(($mascotaU->estatus == "Adoptado")): ?>
                                            <?php $adopciones = Adopcion::buscarId($mascotaU->id);?>
                                            <?php if(!is_null($adopciones)): ?>
                                                <?php foreach($adopciones as $adopcionU): ?>
                                                    <tr>
                                                        <td><?php echo $mascotaU->nombre; ?></td>
                                                        <td><?php echo $adopcionU->nombre; ?></td>
                                                        <td><?php echo $adopcionU->correo; ?></td>
                                                        <td><?php echo $adopcionU->telefono; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <h5>No existen adopciones almacenadas</h5>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h5>No existen mascotas almacenadas</h5>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>