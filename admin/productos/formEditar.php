<?php
//Comenzamos la sesión para registrar errores y usuarios
include("../template/cabecera2.php");
include("../config/funciones.php");
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'admin'){ 


// Variables que recogemos de la función editar en funciones.php
$actual = new Funciones;
$datos = $actual->editar($_GET['id']);
$estacion = $datos[0]['estacion'];
$nombre = $datos[0]['nombre'];
$mes = $datos[0]['clave_mes'];
$imagen = $datos[0]['img'];
$id = $datos[0]['ID'];
?>

<div class="col-md-5 mt-3">
  <div class="card">
    <div class="card-header">
      Datos del producto
    </div>
    <div class="card-body">
      <form action="editarProducto.php" method="post" enctype="multipart/form-data">
        <!-- Dato del ID oculto para actualizar en la base de datos -->
        <div>
          <input type="text" hidden id="ID" name="ID" value="<?php echo $id; ?>">
        </div>
        <!-- Introducción del nombre para actualizar -->
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre Producto:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
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
              ?><option value="1">Primavera</option>
                <option value="2" selected>Verano</option>
                <option value="3">Otoño</option>
                <option value="4">Invierno</option>
              <?php
                break;
              case '3':
              ?><option value="1">Primavera</option>
                <option value="2">Verano</option>
                <option value="3" selected>Otoño</option>
                <option value="4">Invierno</option>
              <?php
                break;
              default:
              ?><option value="1">Primavera</option>
                <option value="2">Verano</option>
                <option value="3">Otoño</option>
                <option value="4" selected>Invierno</option>
            <?php
                break;
            } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="mes" class="form-label">Mes:</label>
          <select name="mes" id="mes" class="form-control">
            <?php
            switch ($mes) {
              case '1':
                ?><option value="1" selected>Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                  <?php
                    break;
              case '2':
                ?><option value="1">Enero</option>
                <option value="2" selected>Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '3':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3" selected>Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '4':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4" selected>Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '5':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5" selected>Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '6':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6" selected>Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '7':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7" selected>Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '8':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8" selected>Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '9':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9" selected>Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '10':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10" selected>Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              case '11':
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11" selected>Noviembre</option>
                <option value="12">Diciembre</option>
                <?php
                  break;
              default:
                ?><option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12" selected>Diciembre</option>
              <?php
                  break;
            } ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="txtImagen" class="form-label">Imagen:</label>
          <input type="text" class="form-control" id="imagen" name="imagen" value="<?php echo $imagen; ?>">
        </div>
        <div class="btn-group" role="group" aria-label="">
          <button type="submit" name="actualizar" value="actualizar" class="btn btn-success">Actualizar</button>
          <a class="btn btn-info mx-3" href="../productos.php" role="button">Volver</a>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- alerta error registro comprobar después -->
<?php
if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>¡Error!</strong> <?php echo $_SESSION['error']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php
}
$_SESSION['error'] = '';
?>

<?php

include("../template/pie.php");
}
?>