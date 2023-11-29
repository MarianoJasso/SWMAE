<?php
    session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: ../inicioSesion.php');
        die();
    }

    if(isset($_SESSION['propietario'])){
        header('Location: ../propietario/perfil.php');
        die();
    }elseif (isset($_SESSION['profesional'])) {
        header('Location: ../profesional/perfil.php');
        die();
    }elseif (isset($_SESSION['experto'])) {
        header('Location: ../experto/perfil.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestiones - Administrador</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-4 border-bottom bg-body-tertiary">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="gestiones.php" class="d-inline-flex"><img src="../../recursos/logo.png" alt="Logo" width="100"></a>
            </div>
    
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="../adoptar.php" class="nav-link px-2 link-dark link-opacity-50-hover">Adoptar</a></li>
                <li><a href="../publicacionArticulo.php" class="nav-link px-2 link-dark link-opacity-50-hover">Articulos</a></li>
                <li><a href="../publicacionHistoria.php" class="nav-link px-2 link-dark link-opacity-50-hover">Historias</a></li>
                <li><a href="../nosotros.php" class="nav-link px-2 link-dark link-opacity-50-hover">Nosotros</a></li>
            </ul>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="gestiones.php" class="nav-link px-2 link-secondary">Gestiones</a></li>
                <li><a href="bdReporte.php" class="nav-link px-2 link-info link-opacity-50-hover">Base de datos y Reportes</a></li>
            </ul>
    
            <div class="col-md-3 text-end">
                <a href="../../conexion/cerrarSesion.php"><button type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button></a>
            </div>
        </header>

        <div class="container">
            <div class="py-5 text-center">
                <h2>Gestión de registros</h2>
                <p class="lead">Gestión de usuarios, mascotas, historias y articulos</p>
            </div>

            <div class="row g-5">
                <div class="col-md-4 col-lg-4 order-md-last">
                    <h4 class="mb-3">Registro de nuevo usuario</h4>
                    <form action="../../controlador/controladorUsuario.php" method="POST" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="nombre" class="form-label">Nombre/s</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre/s..." required>
                                <div class="invalid-feedback">
                                    Se requieren nombres...
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="apellido" class="form-label">Apellido/s</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresar apellido/s..." required>
                                <div class="invalid-feedback">
                                    Se requieren apellidos...
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="tipo" class="form-label">Tipo de usuario</label>
                                <select class="form-select" name="tipo" id="tipo" required>
                                    <option value="">Seleccionar tipo de usuario</option>
                                    <option value="1">Propietario de mascotas</option>
                                    <option value="2">Profesional</option>
                                    <option value="3">Experto</option>
                                </select>
                                <div class="invalid-feedback">
                                    Se requiere tipo de usuario...
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingresar correo electrónico..." required>
                                <div class="invalid-feedback">
                                    Se requieren correo electrónico...
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Ingresar contraseña..." required>
                                <div class="invalid-feedback">
                                    Se requieren contraseña...
                                </div>
                            </div>
                        </div>

                        <button class="w-100 btn btn-primary mt-4" type="submit">Guardar</button>
                    </form>
                </div>
                <div class="col-md-8 col-lg-8">
                    <h4 class="mb-3">Registros de usuarios</h4>
                    <div class="text-center table-responsive pt-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Correo</th>
                                    <th>Fecha de registro</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>Propietarios</td>
                                </tr>

                                <?php include_once "../../modelo/propietario.php"; ?>
                                <?php include_once "../../modelo/usuario.php"; ?>
                                <?php $propietarios = Propietario::buscar();?>
                                <?php if(!is_null($propietarios)): ?>
                                    <?php foreach($propietarios as $propietarioU): ?>
                                        <?php $usuarios = Usuario::buscarId($propietarioU->usuario); ?>
                                        <?php foreach($usuarios as $usuarioU): ?>
                                            <tr>
                                                <td><?php echo $usuarioU->correo; ?></td>
                                                <td><?php echo $usuarioU->fechaRegistro; ?></td>
                                                <td><a href="cambiosUsuario.php?idU=<?php echo $usuarioU->id; ?>&id1=<?php echo $propietarioU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                <form action="../../controlador/controladorUsuarioEliminar.php" method="POST">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $usuarioU->id; ?>">
                                                    <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                </form>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h5>No existen propietarios almacenados</h5>
                                <?php endif; ?>

                                <tr>
                                    <td>Profesionales</td>
                                </tr>

                                <?php include_once "../../modelo/profesional.php"; ?>
                                <?php include_once "../../modelo/usuario.php"; ?>
                                <?php $profesionales = Profesional::buscar();?>
                                <?php if(!is_null($profesionales)): ?>
                                    <?php foreach($profesionales as $profesionalU): ?>
                                        <?php $usuarios = Usuario::buscarId($profesionalU->usuario); ?>
                                        <?php foreach($usuarios as $usuarioU): ?>
                                            <tr>
                                                <td><?php echo $usuarioU->correo; ?></td>
                                                <td><?php echo $usuarioU->fechaRegistro; ?></td>
                                                <td><a href="cambiosUsuario.php?idU=<?php echo $usuarioU->id; ?>&id2=<?php echo $profesionalU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                <form action="../../controlador/controladorUsuarioEliminar.php" method="POST">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $usuarioU->id; ?>">
                                                    <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                </form>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h5>No existen profesionales almacenados</h5>
                                <?php endif; ?>

                                <tr>
                                    <td>Expertos</td>
                                </tr>

                                <?php include_once "../../modelo/experto.php"; ?>
                                <?php include_once "../../modelo/usuario.php"; ?>
                                <?php $expertos = Experto::buscar();?>
                                <?php if(!is_null($expertos)): ?>
                                    <?php foreach($expertos as $expertoU): ?>
                                        <?php $usuarios = Usuario::buscarId($expertoU->usuario); ?>
                                        <?php foreach($usuarios as $usuarioU): ?>
                                            <tr>
                                                <td><?php echo $usuarioU->correo; ?></td>
                                                <td><?php echo $usuarioU->fechaRegistro; ?></td>
                                                <td><a href="cambiosUsuario.php?idU=<?php echo $usuarioU->id; ?>&id3=<?php echo $expertoU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                <form action="../../controlador/controladorUsuarioEliminar.php" method="POST">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $usuarioU->id; ?>">
                                                    <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                </form>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h5>No existen expertos almacenados</h5>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row g-5">
                <div class="col-md-0 col-lg-0 order-md-last"></div>
                <div class="col-md-12 col-lg-12">
                    <h4 class="mb-3">Registros de mascotas</h4>
                    <div class="text-center table-responsive pt-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Especie</th>
                                    <th>Dueño</th>
                                    <th>Fecha de registro</th>
                                    <th>Estatus</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody class="table-group-divider">
                                <?php include_once "../../modelo/mascota.php"; ?>
                                <?php include_once "../../modelo/propietario.php"; ?>
                                <?php $mascotas = Mascota::buscar();?>
                                <?php if(!is_null($mascotas)): ?>
                                    <?php foreach($mascotas as $mascotaU): ?>
                                        <?php $propietarios = Propietario::buscarIdM($mascotaU->propietario); ?>
                                        <?php if(!is_null($propietarios)): ?>
                                            <?php foreach($propietarios as $propietarioU): ?>
                                                <tr>
                                                    <td><?php echo $mascotaU->nombre; ?></td>
                                                    <td><?php echo $mascotaU->especie; ?></td>
                                                    <td><?php echo $propietarioU->nombre." ".$propietarioU->apellido; ?></td>
                                                    <td><?php echo $mascotaU->fechaRegistro; ?></td>
                                                    <td><?php echo $mascotaU->estatus; ?></td>
                                                    <td><a href="cambiosMascota.php?id=<?php echo $mascotaU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                    <form action="../../controlador/controladorMascotaEliminar.php" method="POST">
                                                        <input type="hidden" id="id" name="id" value="<?php echo $mascotaU->id; ?>">
                                                        <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                    </form>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <h5>No existen mascotas almacenadas</h5>
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

            <hr class="my-4">

            <div class="row g-5">
                <div class="col-md-0 col-lg-0 order-md-last"></div>
                <div class="col-md-12 col-lg-12">
                    <h4 class="mb-3">Registros de publicaciones</h4>
                    <div class="text-center table-responsive pt-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Fecha de Publicación</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody class="table-group-divider">
                                <tr>
                                    <td>Historias</td>
                                </tr>

                                <?php include_once "../../modelo/publicacion.php"; ?>
                                <?php include_once "../../modelo/historia.php"; ?>
                                <?php include_once "../../modelo/propietario.php"; ?>
                                <?php include_once "../../modelo/experto.php"; ?>
                                <?php $historias = Historia::buscar();?>
                                <?php if(!is_null($historias)): ?>
                                    <?php foreach($historias as $historiaU): ?>
                                        <?php $publicaciones = Publicacion::buscarId($historiaU->id); ?>
                                        <?php if(!is_null($publicaciones)): ?>
                                            <?php foreach($publicaciones as $publicacionU): ?>
                                                <?php $propietarios = Propietario::buscarId($publicacionU->usuario); ?>
                                                <?php if(!is_null($propietarios)): ?>
                                                    <?php foreach($propietarios as $propietarioU): ?>
                                                        <tr>
                                                            <td><?php echo $publicacionU->titulo; ?></td>
                                                            <td><?php echo $propietarioU->nombre." ".$propietarioU->apellido; ?></td>
                                                            <td><?php echo $publicacionU->fecha; ?></td>
                                                            <td><a href="cambiosPublicacion.php?idP=<?php echo $publicacionU->id; ?>&id1=<?php echo $historiaU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                            <form action="../../controlador/controladorHistoriaEliminar.php" method="POST">
                                                                <input type="hidden" id="id" name="id" value="<?php echo $historiaU->id; ?>">
                                                                <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                            </form>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <?php $expertos = Experto::buscarId($publicacionU->usuario); ?>
                                                    <?php foreach($expertos as $expertoU): ?>
                                                        <tr>
                                                            <td><?php echo $publicacionU->titulo; ?></td>
                                                            <td><?php echo $expertoU->nombre." ".$expertoU->apellido; ?></td>
                                                            <td><?php echo $publicacionU->fecha; ?></td>
                                                            <td><a href="cambiosPublicacion.php?idP=<?php echo $publicacionU->id; ?>&id1=<?php echo $historiaU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                            <form action="../../controlador/controladorHistoriaEliminar.php" method="POST">
                                                                <input type="hidden" id="id" name="id" value="<?php echo $historiaU->id; ?>">
                                                                <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                            </form>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h5>No existen historias almacenadas</h5>
                                <?php endif; ?>

                                <tr>
                                    <td>Articulos</td>
                                </tr>

                                <?php include_once "../../modelo/publicacion.php"; ?>
                                <?php include_once "../../modelo/articulo.php"; ?>
                                <?php include_once "../../modelo/profesional.php"; ?>
                                <?php $articulos = Articulo::buscar();?>
                                <?php if(!is_null($articulos)): ?>
                                    <?php foreach($articulos as $articuloU): ?>
                                        <?php $publicaciones = Publicacion::buscarIdA($articuloU->id); ?>
                                        <?php if(!is_null($publicaciones)): ?>
                                            <?php foreach($publicaciones as $publicacionU): ?>
                                                <?php $profesionales = Profesional::buscarId($publicacionU->usuario); ?>
                                                <?php foreach($profesionales as $profesionalU): ?>
                                                    <tr>
                                                        <td><?php echo $publicacionU->titulo; ?></td>
                                                        <td><?php echo $profesionalU->nombre." ".$profesionalU->apellido; ?></td>
                                                        <td><?php echo $publicacionU->fecha; ?></td>
                                                        <td><a href="cambiosPublicacion.php?idP=<?php echo $publicacionU->id; ?>&id2=<?php echo $articuloU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                        <form action="../../controlador/controladorArticuloEliminar.php" method="POST">
                                                            <input type="hidden" id="id" name="id" value="<?php echo $articuloU->id; ?>">
                                                            <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                        </form>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h5>No existen articulos almacenados</h5>
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