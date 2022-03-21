<?php
//Comenzamos la sesión para registrar errores y usuarios
include("../template/cabecera2.php");
include("../config/funcionesAlquileres.php");
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'admin') {
  
  // Variables que recogemos de la función editar en funciones.php
  $actual = new FuncionesAlquileres;
  $datos = $actual->editar($_GET['id']);
  $referencia = $datos[0]['referencia'];
  $localidad = $datos[0]['localidad'];
  $metros = $datos[0]['metros'];
  $imagen = $datos[0]['imagen'];
  $id = $datos[0]['id'];
?>

  <div class="col-md-5 mt-3">
    <div class="card">
      <div class="card-header">
        Datos del Alquiler
      </div>
      <div class="card-body">
        <form action="editarProducto.php" method="post" enctype="multipart/form-data">
          <!-- Dato del ID oculto para actualizar en la base de datos -->
          <div>
            <input type="text" hidden id="ID" name="ID" value="<?php echo $id; ?>">
          </div>
          <!-- Introducción del nombre para actualizar -->
          <div class="mb-3">
            <label for="nombre" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $referencia; ?>" required>
          </div>
          <div class="mb-3">
            <label for="nombre" class="form-label">Localidad:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $localidad; ?>" required>
          </div>
          <div class="mb-3">
            <label for="nombre" class="form-label">Metros:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $metros; ?>" required>
          </div>
          <div class="mb-3">
            <label for="txtImagen" class="form-label">Imagen:</label>
            <input type="text" class="form-control" id="imagen" name="imagen" value="<?php echo $imagen; ?>">
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="actualizar" value="actualizar" class="btn btn-success">Actualizar</button>
            <a class="btn btn-info mx-3" href="../alquileres.php" role="button">Volver</a>
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