<?php 
session_start();

include("template/cabecera.php");
include("config/conexion.php");
include("config/funciones.php");

$actual = new Funciones();
$datos = $actual->extraer($conn, $_GET['id']);
$estacion = $datos[0]["estacion"];
$nombre = $datos[0]['nombre'];
?>

<div class="col-md-5 mt-3">

    <div class="card">
        <div class="card-header">
            Datos del producto
        </div>
        <div class="card-body">
        <form action="agregarProducto.php" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="nombre" class="form-label">Nombre Producto:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>">
      </div>
      <div class="mb-3">
        <label for="nombre" class="form-label">Estación:</label>
        <select name="estacion" id="estacion" class="form-control">
        <?php 
        switch ($estacion) {
            case '1':
                ?><option value="1" selected>Primavera</option>
                <option value="2">Verano</option>
                <option value="3">Otoño</option>
                <option value="4">Invierno</option>
                <?php
                break;
            case '2':
                ?><option value="1" selected>Primavera</option>
                <option value="2" selected>Verano</option>
                <option value="3">Otoño</option>
                <option value="4">Invierno</option>
                <?php
                break;
            case '3':
                ?><option value="1" selected>Primavera</option>
                <option value="2">Verano</option>
                <option value="3" selected>Otoño</option>
                <option value="4">Invierno</option>
                <?php
                break;
            default:
                ?><option value="1" selected>Primavera</option>
                <option value="2">Verano</option>
                <option value="3">Otoño</option>
                <option value="4" selected>Invierno</option>
                <?php
                break;
        }?>
        </select>
      </div>
      <div class="mb-3">
        <label for="txtImagen" class="form-label">Imagen:</label>
        <input type="file" class="form-control" id="txtImagen" name="txtImagen">
      </div>
        <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="actuallizar" value="Actualizar" class="btn btn-success">Actualizar</button>
            <a href="productos.php"><input type="button" value="Volver" class="btn btn-info"></a>
        </div>
    </form>
        </div>
    </div>    
    </div>
    <!-- alerta error -->
    <?php
      if (isset($_SESSION['error'])){
        ?>  
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error'];?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
      }
    ?>
<?php

include("template/pie.php");

?>




