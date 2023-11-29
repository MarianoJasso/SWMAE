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
        <title>Base de datos y Reportes - Administrador</title>
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
                <li><a href="gestiones.php" class="nav-link px-2 link-info link-opacity-50-hover">Gestiones</a></li>
                <li><a href="bdReporte.php" class="nav-link px-2 link-secondary">Base de datos y Reportes</a></li>
            </ul>
    
            <div class="col-md-3 text-end">
                <a href="../../conexion/cerrarSesion.php"><button type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button></a>
            </div>
        </header>

        <div class="container">
            <div class="py-5 text-center">
                <h2>Base de datos y Reportes</h2>
                <p class="lead">Respaldo y Recuperación de base de datos / Reportes</p>
            </div>

            <div class="row g-5">
                <div class="col-md-6 col-lg-6 order-md-last">
                    <h4 class="mb-3">Generación de reportes</h4>

                    <form action="../../controlador/controladorReporte.php" method="post" target="_blank">
                        <label class="form-label">Usuarios</label>
                        <input type="hidden" name="numeroReporte" value="1">
                        <button class="w-100 btn btn-light" type="submit">
                            Generar reporte
                        </button>
                    </form>

                    <form action="../../controlador/controladorReporte.php" method="post" target="_blank">
                        <label class="form-label mt-4">Mascotas</label>
                        <input type="hidden" name="numeroReporte" value="2">
                        <button class="w-100 btn btn-light" type="submit">
                            Generar reporte
                        </button>
                    </form>

                    <form action="../../controlador/controladorReporte.php" method="post" target="_blank">
                        <label class="form-label mt-4">Adopciones</label>
                        <input type="hidden" name="numeroReporte" value="3">
                        <button class="w-100 btn btn-light" type="submit">
                            Generar reporte
                        </button>
                    </form>
                </div>
                <div class="col-md-6 col-lg-6">
                    <h4 class="mb-3">Respaldo y recuperación de base de datos</h4>

                    <form action="../../controlador/controladorBaseDatos.php" method="POST" class="needs-validation">
                        <label class="form-label">Respaldo de base de datos</label>
                        <button type="submit" name="repaldo" value="Respaldo Base de Datos" class="w-100 btn btn-outline-primary">Respaldar</button>
                    </form>
                    
                    <form action="../../controlador/controladorBaseDatos.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <label class="form-label mt-4">Recuperación de base de datos</label>

                        <input type="file" class="form-control" name="archivo" id="archivo" required>
                        <div class="invalid-feedback">
                            Se requiere un archivo...
                        </div>
                        <button type="submit" name="recuperacion" value="Recuperación Base de Datos" class="w-100 btn btn-primary">Recuperar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/5.1/examples/checkout/form-validation.js"></script>
    </body>
</html>