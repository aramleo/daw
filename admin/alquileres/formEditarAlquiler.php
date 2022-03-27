<?php
//Comenzamos la sesión para registrar errores y usuarios
include("../template/cabecera2.php");
include("../../config/funcionesAlquileres.php");
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  
  // Variables que recogemos de la función editar en funciones.php
  $actual = new FuncionesAlquileres;
  $datos = $actual->editar($_GET['id']);
  $referencia = $datos[0]['referencia'];
  $localidad = $datos[0]['localidad'];
  $metros = $datos[0]['metros'];
  $imagen = $datos[0]['imagen'];
  $telefono = $datos[0]['telefono'];
  $activa = $datos[0]['activa'];
  $id = $datos[0]['id'];
?>

  <div class="col-md-5 mt-3">
    <div class="card">
      <div class="card-header">
        Datos del Alquiler
      </div>
      <div class="card-body">
        <form action="editarAlquiler.php" method="post" enctype="multipart/form-data">
          <!-- Dato del ID oculto para actualizar en la base de datos -->
          <div>
            <input type="text" hidden id="id" name="id" value="<?php echo $id; ?>">
          </div>
          <!-- Introducción del nombre para actualizar -->
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" value="<?php if(isset($referencia)){echo $referencia; }?>" required>
          </div>
          <div class="mb-3">
            <label for="localidad" class="form-label">Localidad:</label>
            <input type="text" class="form-control" id="localidad" name="localidad" value="<?php if(isset($localidad)){echo $localidad; } ?>" required>
          </div>
          <div class="mb-3">
            <label for="metros" class="form-label">Metros:</label>
            <input type="text" class="form-control" id="metros" name="metros" value="<?php if(isset($metros)){echo $metros; } ?>" required>
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="text" class="form-control" id="imagen" name="imagen" value="<?php if(isset($imagen)){echo $imagen; } ?>" required>
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php if(isset($telefono)){echo $telefono; } ?>" required>
          </div>
          <div class="mb-3">
            <label for="activa" class="form-label">Activa:</label>
            <input type="text" class="form-control" id="activa" name="activa" value="<?php if(isset($activa)){echo $activa; } ?>" required>
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