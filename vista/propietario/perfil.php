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
        <title>Perfil - Propietario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>

        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-4 border-bottom bg-body-tertiary">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="perfil.php" class="d-inline-flex"><img src="../../recursos/logo.png" alt="Logo" width="100"></a>
            </div>
    
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="perfil.php" class="nav-link px-2 link-secondary">Perfil</a></li>
                <li><a href="../adoptar.php" class="nav-link px-2 link-dark link-opacity-50-hover">Adoptar</a></li>
                <li><a href="../publicacionArticulo.php" class="nav-link px-2 link-dark link-opacity-50-hover">Articulos</a></li>
                <li><a href="../publicacionHistoria.php" class="nav-link px-2 link-dark link-opacity-50-hover">Historias</a></li>
                <li><a href="../nosotros.php" class="nav-link px-2 link-dark link-opacity-50-hover">Nosotros</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <a href="../../conexion/cerrarSesion.php"><button type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button></a>
            </div>
        </header>

        <div class="container">
            <div class="py-5 text-center">
                <h2>Propietario de mascotas</h2>
                <p class="lead">Perfil de usuario</p>
            </div>

            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center text-primary mb-3">Menú especial</h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Adopción</h6>
                                <small class="text-body-secondary">Poner mascotas en adopción</small>
                            </div>
                            <a href="adopcion.php"><img src="../../recursos/ir.png" alt="seleccionador"></a>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Historias</h6>
                                <small class="text-body-secondary">Subir historias de éxito</small>
                            </div>
                            <a href="historia.php"><img src="../../recursos/ir.png" alt="seleccionador"></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Información de Usuario</h4>

                    <?php include_once "../../modelo/usuario.php"; ?>
                    <?php include_once "../../modelo/direccion.php"; ?>
                    <?php include_once "../../modelo/propietario.php"; ?>
                    <form action="../../controlador/controladorPropietarioEditar.php" method="POST" class="needs-validation" novalidate>
                        <?php $usuarios = Usuario::buscarId($_SESSION['id']); ?>
                        <?php if(!is_null($usuarios)): ?>
                            <?php foreach($usuarios as $usuarioU): ?>
                                <?php $propietarios = Propietario::buscarIdM($_SESSION['propietario']); ?>
                                <?php if(!is_null($propietarios)): ?>
                                    <?php foreach($propietarios as $propietarioU): ?>
                                        <?php $direcciones = Direccion::buscarId($usuarioU->direccion); ?>
                                        <?php if(!is_null($direcciones)): ?>
                                            <?php foreach($direcciones as $direccionU): ?>
                                                <div class="row g-3 mb-4">
                                                    <div class="row g-3">
                                                        <div class="col-sm-6">
                                                            <label for="nombre" class="form-label">Nombre/s</label>
                                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre/s..." value="<?php echo $propietarioU->nombre;?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requieren nombres...
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="apellido" class="form-label">Apellido/s</label>
                                                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresar apellido/s..." value="<?php echo $propietarioU->apellido;?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requieren apellidos...
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="correo" class="form-label">Correo electrónico</label>
                                                            <div class="input-group has-validation">
                                                                <span class="input-group-text">@</span>
                                                                <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingresar correo electrónico..." value="<?php echo $usuarioU->correo;?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere correo electrónico...
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="numero" class="form-label">Número de telefono</label>
                                                            <input type="text" class="form-control" name="numero" id="numero" placeholder="Ingresar número de telefono..." value="<?php echo $propietarioU->telefono;?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requiere número de telefono...
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3">
                                                        <div class="col-sm-6">
                                                            <label for="estado" class="form-label">Estado</label>
                                                            <input type="text" class="form-control" name="estado" id="estado" placeholder="Ingresar estado..." value="<?php echo $direccionU->estado;?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requiere estado...
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="ciudad" class="form-label">Ciudad</label>
                                                            <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ingresar ciudad..." value="<?php echo $direccionU->ciudad;?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requiere ciudad...
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <label for="detalles" class="form-label">Detalles domicilio</label>
                                                            <input type="text" class="form-control" name="detalles" id="detalles" placeholder="Ingresar detalles..." value="<?php echo $direccionU->detalles;?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requieren detalles...
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="idU" name="idU" value="<?php echo $_SESSION['id']; ?>">
                                                <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['propietario']; ?>">
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <button class="w-100 btn btn-primary my-4" type="submit">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>