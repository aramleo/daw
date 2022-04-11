<?php
//Comenzamos la sesión para registrar errores y usuarios
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  include("../template/cabecera2.php");
  include("../../config/funcionesProductos.php");


  // Variables que recogemos de la función editar en funciones.php
  $actual = new Funciones;
  $datos = $actual->editar($_GET['id']);
  $referencia = $datos[0]['referencia'];
  $nombre = $datos[0]['nombre'];
  $precio = $datos[0]['precio'];
  $cantidad = $datos[0]['cantidad'];
  $id = $datos[0]['id'];

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
            <input type="text" id="id" name="id" value="<?php echo $id; ?>">
          </div>
          <!-- Introducción de los datos para actualizar -->
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Producto:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
          </div>
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" value="<?php echo $referencia; ?>" required>
          </div>
          <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>" required>
          </div>
          <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad:</label>
            <input type="text" class="form-control" id="cantidad" name="cantidad" value="<?php echo $cantidad; ?>">
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Cantidad del producto">
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
} else {
  header('Location: ../../');
}
?>