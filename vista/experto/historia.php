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
    }elseif (!isset($_SESSION['experto'])) {
        header('Location: ../administrador/gestiones.php');
        die();
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Historia - Experto</title>
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
                <li><a href="historia.php" class="nav-link px-2 link-secondary">Subir historia</a></li>
            </ul>
    
            <div class="col-md-3 text-end">
                <a href="../../conexion/cerrarSesion.php"><button type="button" class="btn btn-outline-dark me-2">Cerrar Sesión</button></a>
            </div>
        </header>

        <div class="container">
            <div class="py-5 text-center">
                <h2>Historias de éxito</h2>
                <p class="lead">Gestión de historias de éxito</p>
            </div>

            <div class="row g-5">
                <div class="col-md-4 col-lg-4 order-md-last">
                    <h4 class="mb-3">Publicación de nueva historia</h4>
                    <form action="../../controlador/controladorHistoria.php" method="POST" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="titulo" class="form-label">Titulo</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ingresar titulo..." value="" required>
                                <div class="invalid-feedback">
                                    Se requiere titulo...
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="descri" class="form-label">Descripción</label>
                                <textarea class="form-control" name="descri" id="descri" placeholder="Ingresar descripción..." required></textarea>
                                <div class="invalid-feedback">
                                    Se requiere descripción...
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <label for="cuerpo" class="form-label">Cuenta la historia</label>
                                <textarea class="form-control" name="cuerpo" id="cuerpo" placeholder="Ingresar historia..." required></textarea>
                                <div class="invalid-feedback">
                                    Se requiere historia...
                                </div>
                            </div>
                        </div>

                        <button class="w-100 btn btn-primary mt-4" type="submit">Publicar</button>
                    </form>
                </div>
                <div class="col-md-8 col-lg-8">
                    <h4 class="mb-3">Registros de historias</h4>
                    <div class="text-center table-responsive pt-4">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Titulo</th>
                                    <th>Descripción</th>
                                    <th>Fecha de Publicación</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            
                            <tbody class="table-group-divider">
                                <?php include_once "../../modelo/publicacion.php"; ?>
                                <?php include_once "../../modelo/historia.php"; ?>
                                <?php $publicaciones = Publicacion::buscarAutor($_SESSION['id']); ?>
                                <?php if(!is_null($publicaciones)): ?>
                                    <?php foreach($publicaciones as $publicacionU): ?>
                                        <?php $historias = Historia::buscarId($publicacionU->historia);?>
                                        <?php foreach($historias as $historiaU): ?>
                                            <tr>
                                                <td><?php echo $publicacionU->titulo; ?></td>
                                                <td><?php echo $historiaU->descripcion; ?></td>
                                                <td><?php echo $publicacionU->fecha; ?></td>
                                                <td><a href="../administrador/cambiosPublicacion.php?idP=<?php echo $publicacionU->id; ?>&id1=<?php echo $historiaU->id; ?>"><button type="button" class="w-100 btn btn-secondary btn-sm">Ver y Editar</button></a></td>
                                                <form action="../../controlador/controladorHistoriaEliminar.php" method="POST">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $historiaU->id; ?>">
                                                    <td><button type="submit" class="w-100 btn btn-danger btn-sm">Eliminar</button></td>
                                                </form>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <h5>No existen historias almacenadas</h5>
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