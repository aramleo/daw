<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  include("../template/cabecera2.php");
?>

  <div class="col-md-5 mt-3">

    <div class="card">
      <div class="card-header">
        Datos del Servicio
      </div>
      <div class="card-body">
        <form action="agregarServicio.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" required placeholder="Referencia del servicio">
          </div>
          <div class="mb-3">
            <label for="servicio" class="form-label">Servicio:</label>
            <input type="text" class="form-control" id="servicio" name="servicio" required placeholder="Servicio a prestar">
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Imagen">
          </div>
          <div class="mb-3">
            <label for="activa" class="form-label">Activa:</label>
            <input type="text" class="form-control" id="activa" name="activa" required placeholder="Si activa 1 si no activa 0">
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
            <a class="btn btn-info mx-3" href="../serviciosAd.php" role="button">Volver</a>
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