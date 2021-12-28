<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/ico.png" type="image/x-icon">
    <title>Huertos Urbanos</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" />
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <?php  $url="http://".$_SERVER['HTTP_HOST']."/xampp/htdocs/daw/" ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Administrador<span
                        class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url."admin/inicio.php";?>">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url."admin/productos.php";?>">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url."admin/cerrar.php";?>">Cerrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php  echo $url;?>">Sitio web</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="row">