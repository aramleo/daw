<?php

include("../template/cabecera2.php");
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
?>

  <div class="col-md-5 mt-3">

    <div class="card">
      <div class="card-header">
        Datos del Alquiler
      </div>
      <div class="card-body">
        <form action="agregarAlquiler.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" required placeholder="Referencia del inmueble">
          </div>
          <div class="mb-3">
            <label for="localidad" class="form-label">Localidad:</label>
            <input type="text" class="form-control" id="localidad" name="localidad" required placeholder="Localidad donde se encuentra">
          </div>
          <div class="mb-3">
            <label for="metros" class="form-label">Metros:</label>
            <input type="text" class="form-control" id="metros" name="metros" required placeholder="Metros de la propiedad">
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="text" class="form-control" id="imagen" name="imagen" required placeholder="Imagen">
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" required placeholder="Teléfono del propietario">
          </div>
          <div class="mb-3">
            <label for="activa" class="form-label">Activa:</label>
            <input type="text" class="form-control" id="activa" name="activa" required placeholder="Si activa 1 si no activa 0">
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
            <a class="btn btn-info mx-3" href="../alquileres.php" role="button">Volver</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- alerta error registro -->
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
  if (isset($_SESSION['registro']) && !empty($_SESSION['registro'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>OK! </strong> <?php echo $_SESSION['registro']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }
  $_SESSION['registro'] = '';
  ?>
<?php

  include("../template/pie.php");
} else {
  header('Location: ../../');
}
?>