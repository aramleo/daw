<?php
// Si no hemos iniciado sesión
if (!isset($_SESSION)) {

    session_start();
}
?>
<!-- Encabezado en páginas principales -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Huertos urbanos, alquilar, servicios, descargas, blog plantas">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="shortcut icon" href="img/ico.png" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Huertos Urbanos</title>
</head>

<body class="d-flex flex-column vh-100">
    <nav class="navbar navbar-expand-sm navbar-dark bg-success">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuID" aria-controls="menuID" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="menuID">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="./">Home</a>
                    <a class="nav-link active" aria-current="page" href="blog.php">Blog</a>
                    <?php
                    if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '2') {
                    ?>
                        <a class="nav-link active" aria-current="page" href="tienda.php">Tienda</a>
                        <a class="nav-link active" aria-current="page" href="alquiler.php">Alquiler</a>
                        <a class="nav-link active" aria-current="page" href="servicios.php">Servicios</a>
                        <a class="nav-link active" aria-current="page" href="descargas.php">Descargar</a>
                    <?php
                    } else if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
                    ?>
                        <a class="nav-link active" aria-current="page" href="tienda.php">Tienda</a>
                        <a class="nav-link active" aria-current="page" href="alquiler.php">Alquiler</a>
                        <a class="nav-link active" aria-current="page" href="servicios.php">Servicios</a>
                        <a class="nav-link active" aria-current="page" href="descargas.php">Descargar</a>
                        <a class="nav-link active" aria-current="page" href="admin/">Administrador</a>
                    <?php
                    } else {
                    ?>
                        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
                    <?php
                    }
                    ?>
                    <a class="nav-link active" aria-current="page" href="acerca.php">Acerca de</a>
                </div>

                <?php
                if (isset($_SESSION['usuario'])) {
                ?>
                    <div class="navbar-nav" style="border-top:1px solid white">
                        <a class="nav-link active d-sm-none" aria-current="page" href="perfil.php">Perfil</a>
                        <a class="nav-link active d-sm-none" aria-current="page" href="cerrarSesion.php">Cerrar sesión</a>
                    </div>
                <?php
                }
                ?>

            </div>
            <div class="navbar-nav " style="border-left:1px solid white">
                <?php
                if (isset($_SESSION['usuario'])) {
                ?>
                    <div class="cols-6">
                        <a class="nav-link active  d-none d-md-inline" aria-current="page" href="perfil.php">Perfil</a>
                    </div>
                    <div class="cols-6">
                        <a class="nav-link active  d-none d-md-inline" aria-current="page" href="cerrarSesion.php">Cerrar sesión</a>
                    </div>
            </div>
            <?php
                    }
            ?>
        </div>
    </nav>
    <div class="container-fluid !direction !spacing">
        <b5-row></b5-row>
    </div>
</body>

</html>