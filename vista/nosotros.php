<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nosotros</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between px-4 border-bottom bg-body-tertiary">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="index.php" class="d-inline-flex"><img src="../recursos/logo.png" alt="Logo" width="100"></a>
            </div>
    
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 link-dark link-opacity-50-hover">Inicio</a></li>
                <li><a href="adoptar.php" class="nav-link px-2 link-dark link-opacity-50-hover">Adoptar</a></li>
                <li><a href="publicacionArticulo.php" class="nav-link px-2 link-dark link-opacity-50-hover">Articulos</a></li>
                <li><a href="publicacionHistoria.php" class="nav-link px-2 link-dark link-opacity-50-hover">Historias</a></li>
                <li><a href="nosotros.php" class="nav-link px-2 link-secondary">Nosotros</a></li>
            </ul>
    
            <div class="col-md-3 text-end">
                <a href="inicioSesion.php"><button type="button" class="btn btn-outline-dark me-2">Iniciar Sesión</button></a>
                <a href="registro.php"><button type="button" class="btn btn-dark">Registrarse</button></a>
            </div>
        </header>
        
        <div class="container-fluid">
            <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="bd-placeholder-img" width="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false" src="../recursos/slide1.png" alt="">
                        <div class="container">
                            <div class="carousel-caption text-start">
                                <h1>Adopta con amor, cambia vidas</h1>
                                <p><a class="btn btn-lg btn-primary" href="adoptar.php">Adoptar</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="bd-placeholder-img" width="100%" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false" src="../recursos/slide2.png" alt="">
                        <div class="container">
                            <div class="carousel-caption text-end">
                                <h1>Contactanos</h1>
                                <h3>Número telefonico</h3>
                                <h5>7773241098</h5>
                                <h3>Correo electrónico</h3>
                                <h5>apoyoemocional@gmail.com</h5>
                                <h3>Dirección</h3>
                                <h5>Lomas de Texcal, Jiutepec, Morelos</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>


            <div class="container marketing">
                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading fw-normal lh-1">¿Cómo comenzó nuestra historia?</h2>
                        <p class="lead">Nuestra historia comenzó con una simple pero poderosa convicción: la conexión entre los seres humanos y los animales tiene el poder de sanar y transformar vidas. Todo empezó con la idea de crear un espacio donde aquellos que buscan apoyo emocional pudieran encontrar compañía en seres amorosos de cuatro patas.</p>
                        <p class="lead">Estamos comprometidos a seguir construyendo puentes de afecto y creando historias de amor duraderas entre humanos y animales. Nuestra historia está tejida con momentos conmovedores, sonrisas compartidas y la convicción de que cada mascota adoptada marca el inicio de una nueva y hermosa historia de amistad y apoyo emocional. ¡Bienvenido a nuestra comunidad, donde las patas de peluche y los corazones humanos se encuentran para escribir juntos un capítulo de amor y conexión incondicional!"</p>
                    </div>
                    <div class="col-md-5">
                        <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false" src="../recursos/nosotros1.png" alt="">
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row">
                    <h2 class="featurette-heading fw-normal lh-1 pb-4">Nuestros valores</h2>
                    <div class="col-lg-3">
                        <img class="bd-placeholder-img rounded-circle" width="140" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false" src="../recursos/amor.png" alt="">
                        <h3 class="fw-normal">Amor</h3>
                    </div>
                    <div class="col-lg-3">
                    <img class="bd-placeholder-img rounded-circle" width="140" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false" src="../recursos/respeto.png" alt="">
                        <h3 class="fw-normal">Respeto</h3>
                    </div>
                    <div class="col-lg-3">
                    <img class="bd-placeholder-img rounded-circle" width="140" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false" src="../recursos/compromiso.png" alt="">
                        <h3 class="fw-normal">Compromiso</h3>
                    </div>
                    <div class="col-lg-3">
                    <img class="bd-placeholder-img rounded-circle" width="140" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false" src="../recursos/responsabilidad.png" alt="">
                        <h3 class="fw-normal">Responsabilidad</h3>
                    </div>
                </div>

                <hr class="featurette-divider">

                <div class="row featurette">
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading fw-normal lh-1">Misión</h2>
                        <p class="lead">Nos dedicamos a facilitar encuentros significativos entre seres humanos y mascotas, reconociendo el poder terapéutico de la conexión animal. Nuestra misión es proporcionar un espacio virtual donde aquellos que buscan apoyo emocional encuentren la compañía que solo los animales pueden ofrecer. Trabajamos para fomentar adopciones responsables y contribuir al bienestar emocional de personas y mascotas por igual.</p>
                        <h2 class="featurette-heading fw-normal lh-1">Visión</h2>
                        <p class="lead">Aspiramos a ser líderes en la promoción de la adopción responsable y en la creación de una comunidad en línea vibrante que celebra la conexión única entre humanos y animales. Visualizamos un futuro donde nuestras acciones inspiren a otros a abrir sus corazones y hogares a las mascotas necesitadas, creando así un tejido más fuerte de relaciones y apoyo emocional en todo el mundo.</p>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false" src="../recursos/nosotros2.png" alt="">
                    </div>
                </div>

                <hr class="featurette-divider">
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>