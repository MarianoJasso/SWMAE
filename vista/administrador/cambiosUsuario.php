<?php
    session_start();
    
    if(!isset($_SESSION['usuario'])){
        header('Location: ../inicioSesion.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cambios en Usuario - Administrador</title>
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
                <h2>Cambios en Usuario</h2>
                <p class="lead">Cambio en información de registro de usuario</p>
            </div>

            <?php include_once "../../modelo/usuario.php"; ?>
            <?php include_once "../../modelo/direccion.php"; ?>
            <?php include_once "../../modelo/propietario.php"; ?>
            <?php include_once "../../modelo/profesional.php"; ?>
            <?php include_once "../../modelo/experto.php"; ?>

            <?php if(isset($_GET["id1"])): ?>
                <form action="../../controlador/controladorPropietarioEditar.php" method="POST" class="needs-validation" novalidate>
                    <div class="row g-5">
                        <div class="col-md-4 col-lg-4 order-md-last">
                            <h4 class="mb-3">Opciones</h4>
                            
                            <button class="w-100 btn btn-primary mt-4" type="submit">Actualizar</button>
                            <input type="hidden" id="idU" name="idU" value="<?php echo $_GET["idU"]; ?>">
                            <input type="hidden" id="id" name="id" value="<?php echo $_GET["id1"]; ?>">

                            <a href="gestiones.php"><button class="w-100 btn btn-secondary mt-4" type="button">Cancelar</button></a>
                        </div>
                        <div class="col-md-8 col-lg-8">
                            <h4 class="mb-3">Información de usuario</h4>
                            
                            <?php $usuarios = Usuario::buscarId($_GET["idU"]); ?>
                            <?php if(!is_null($usuarios)): ?>
                                <?php foreach($usuarios as $usuarioU): ?>
                                    <?php $propietarios = Propietario::buscarIdM($_GET["id1"]); ?>
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
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            <?php elseif(isset($_GET["id2"])): ?>
                <form action="../../controlador/controladorProfesionalEditar.php" method="POST" class="needs-validation" novalidate>
                    <div class="row g-5">
                        <div class="col-md-4 col-lg-4 order-md-last">
                            <h4 class="mb-3">Opciones</h4>
                            
                            <button class="w-100 btn btn-primary mt-4" type="submit">Actualizar</button>
                            <input type="hidden" id="idU" name="idU" value="<?php echo $_GET["idU"]; ?>">
                            <input type="hidden" id="id" name="id" value="<?php echo $_GET["id2"]; ?>">

                            <a href="gestiones.php"><button class="w-100 btn btn-secondary mt-4" type="button">Cancelar</button></a>
                        </div>
                        <div class="col-md-8 col-lg-8">
                            <h4 class="mb-3">Información de usuario</h4>
                            
                            <?php $usuarios = Usuario::buscarId($_GET["idU"]); ?>
                            <?php if(!is_null($usuarios)): ?>
                                <?php foreach($usuarios as $usuarioU): ?>
                                    <?php $profesionales = Profesional::buscarIdP($_GET["id2"]); ?>
                                    <?php if(!is_null($profesionales)): ?>
                                        <?php foreach($profesionales as $profesionalU): ?>
                                            <?php $direcciones = Direccion::buscarId($usuarioU->direccion); ?>
                                            <?php if(!is_null($direcciones)): ?>
                                                <?php foreach($direcciones as $direccionU): ?>
                                                    <div class="row g-3 mb-4">
                                                        <div class="col-sm-6">
                                                            <label for="nombre" class="form-label">Nombre/s</label>
                                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre/s..." value="<?php echo $profesionalU->nombre; ?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requieren nombres...
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="apellido" class="form-label">Apellido/s</label>
                                                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresar apellido/s..." value="<?php echo $profesionalU->apellido; ?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requieren apellidos...
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="correo" class="form-label">Correo electrónico</label>
                                                            <div class="input-group has-validation">
                                                                <span class="input-group-text">@</span>
                                                                <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingresar correo electrónico..." value="<?php echo $usuarioU->correo; ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere correo electrónico...
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="especialidad" class="form-label">Especialidad</label>
                                                            <input type="text" class="form-control" name="especialidad" id="especialidad" placeholder="Ingresar especialidad..." value="<?php echo $profesionalU->especialidad; ?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requiere especialidad...
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <label for="experiencia" class="form-label">Experiencia (años)</label>
                                                            <input type="number" class="form-control" name="experiencia" id="experiencia" placeholder="Ingresar experiencia..." value="<?php echo $profesionalU->experiencia; ?>" required>
                                                            <div class="invalid-feedback">
                                                                Se requiere experiencia...
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
                                                                <input type="text" class="form-control" name="detalles" id="detalles" placeholder="Ingresar detalles..." value="<?php echo $direccionU->detalles; ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requieren detalles...
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
                    </div>
                </form>
            <?php else: ?>
                <form action="../../controlador/controladorExpertoEditar.php" method="POST" class="needs-validation" novalidate>
                    <div class="row g-5">
                        <div class="col-md-4 col-lg-4 order-md-last">
                            <h4 class="mb-3">Opciones</h4>
                            
                            <button class="w-100 btn btn-primary mt-4" type="submit">Actualizar</button>
                            <input type="hidden" id="idU" name="idU" value="<?php echo $_GET["idU"]; ?>">
                            <input type="hidden" id="id" name="id" value="<?php echo $_GET["id3"]; ?>">

                            <a href="gestiones.php"><button class="w-100 btn btn-secondary mt-4" type="button">Cancelar</button></a>
                        </div>
                        <div class="col-md-8 col-lg-8">
                            <h4 class="mb-3">Información de usuario</h4>
                            
                            <?php $usuarios = Usuario::buscarId($_GET["idU"]); ?>
                            <?php if(!is_null($usuarios)): ?>
                                <?php foreach($usuarios as $usuarioU): ?>
                                    <?php $expertos = Experto::buscarIdE($_GET["id3"]); ?>
                                    <?php if(!is_null($expertos)): ?>
                                        <?php foreach($expertos as $expertoU): ?>
                                            <?php $direcciones = Direccion::buscarId($usuarioU->direccion); ?>
                                            <?php if(!is_null($direcciones)): ?>
                                                <?php foreach($direcciones as $direccionU): ?>
                                                    <div class="row g-3 mb-4">
                                                        <div class="row g-3">
                                                            <div class="col-sm-6">
                                                                <label for="nombre" class="form-label">Nombre/s</label>
                                                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre/s..." value="<?php echo $expertoU->nombre; ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requieren nombres...
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="apellido" class="form-label">Apellido/s</label>
                                                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresar apellido/s..." value="<?php echo $expertoU->apellido; ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requieren apellidos...
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="correo" class="form-label">Correo electrónico</label>
                                                                <div class="input-group has-validation">
                                                                    <span class="input-group-text">@</span>
                                                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingresar correo electrónico..." value="<?php echo $usuarioU->correo; ?>" required>
                                                                    <div class="invalid-feedback">
                                                                        Se requiere correo electrónico...
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="area" class="form-label">Area de conocimiento</label>
                                                                <input type="text" class="form-control" name="area" id="area" placeholder="Ingresar area de conocimiento..." value="<?php echo $expertoU->area; ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere area de conocimiento...
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="desc" class="form-label">Descripción</label>
                                                                <textarea class="form-control" name="desc" id="desc" placeholder="Ingresar descripción..." required><?php echo $expertoU->descripcion; ?></textarea>
                                                                <div class="invalid-feedback">
                                                                    Se requiere descripción...
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
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>