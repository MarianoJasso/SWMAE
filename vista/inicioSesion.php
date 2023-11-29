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
        <title>Inicio de Sesión</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body style="background-image: url(../recursos/fondoInicio.png); background-size: cover;">
        <div class="container-fluid px-5 py-4">
            <div class="row align-items-center py-5">
                <div class="col-lg-6 text-center text-lg-start"></div>
                <div class="col-lg-6 mx-auto">
                    <form action="../controlador/controladorInicioSesion.php" method="POST" class="pt-2 pb-5 px-5 border rounded-3 bg-body-tertiary">
                        <div class="form-signin m-auto">
                            <div class="text-center pb-4">
                                <a href="index.php" class="d-inline-flex"><img src="../recursos/logo.png" alt="Logo" width="100" class="mt-0"></a>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" required>
                                <label for="correo">Correo electrónico...</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                                <label for="password">Contraseña...</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 mb-2" style="background-color:#ec802b; border:1px solid #ec802b;">Iniciar Sesión</button>
                        </div>
                        <hr class="my-4">
                        <small class="text-body-secondary">¿No tienes cuenta? <a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="registro.php">Regístrate</a></small>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>