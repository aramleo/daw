<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../img/ico.png" type="image/x-icon">
    <title>Huertos Urbanos</title>
    

</head>

<body>

    <?php  $url="http://".$_SERVER['HTTP_HOST']."/daw/" ?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Administrador<span
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