<?php
    session_start();
    
    if(isset($_SESSION['propietario'])){
        header('Location: propietario/perfil.php');
        die();
    }elseif (isset($_SESSION['profesional'])) {
        header('Location: profesional/perfil.php');
        die();
    }elseif (isset($_SESSION['experto'])) {
        header('Location: experto/perfil.php');
        die();
    } elseif (isset($_SESSION['usuario'])) {
        header('Location: administrador/gestiones.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro de Usuario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body style="background-image: url(../recursos/fondoRegistro.png); background-size: cover;">
        <div class="container-fluid px-5">
            <div class="row align-items-center py-4">
                <div class="col-lg-8 mx-auto">
                    <form action="../controlador/controladorUsuario.php" method="POST" class="needs-validation pt-2 pb-5 px-5 border rounded-3 bg-body-tertiary" novalidate>
                        <div class="text-center pb-2">
                            <a href="index.php" class="d-inline-flex"><img src="../recursos/logo.png" alt="Logo" width="100" class="mt-0"></a>
                        </div>
                        
                        <p class="text-center py-2">Llena los campos para registrarte en el sistema:</p>
                            
                        <div class="row align-items-md-stretch">
                            <div class="col-md-6">
                                <div class="pt-2 pb-3">
                                    <div class="row align-items-md-stretch g-3">
                                        <div class="col-md-6">
                                            <label for="nombre" class="form-label">Nombre/s</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresar nombre/s..." required>
                                            <div class="invalid-feedback">
                                                Se requieren nombres...
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="apellido" class="form-label">Apellido/s</label>
                                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingresar apellido/s..." required>
                                            <div class="invalid-feedback">
                                                Se requieren apellidos...
                                            </div>
                                        </div>

                                        <div class="col-md-12">
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
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="pt-2 pb-3">
                                    <div class="row align-items-md-stretch g-3">
                                        <div class="col-md-12">
                                            <label for="correo" class="form-label">Correo electrónico</label>
                                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingresar correo electrónico..." required>
                                            <div class="invalid-feedback">
                                                Se requieren correo electrónico...
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="password" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Ingresar contraseña..." required>
                                            <div class="invalid-feedback">
                                                Se requieren contraseña...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" style="background-color:#ec802b; border:1px solid #ec802b;">Registrar</button>
                    
                        <hr class="my-4">
                        <small class="text-body-secondary">¿Ya tienes cuenta? <a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="inicioSesion.php">Inicia sesión</a></small>
                    </form>
                </div>
                <div class="col-lg-4 text-center text-lg-start"></div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>