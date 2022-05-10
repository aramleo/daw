<?php
// Inicio de sesión
session_start();
// Comrpobación usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  // Inclusión de los archivos necesarios
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
            <input type="text" class="form-control" id="referencia" name="referencia" minlength="3" maxlength="25" required placeholder="Referencia del servicio">
          </div>
          <div class="mb-3">
            <label for="servicio" class="form-label">Servicio:</label>
            <input type="text" class="form-control" id="servicio" name="servicio" minlength="5" maxlength="50" required placeholder="Servicio a prestar">
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Imagen">
          </div>
          <div class="mb-3">
            <label for="activa" class="form-label">Activa:</label>
            <select id="activa" name="activa">
              <option value="1">Activo</option>
              <option value="0">No Activo</option>
            </select>
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
    $_SESSION['error'] = '';
  }

  if (isset($_SESSION['error_refS']) && !empty($_SESSION['error_refS'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_refS']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    $_SESSION['error_refS'] = '';
  }
  if (isset($_SESSION['error_servicioS']) && !empty($_SESSION['error_servicioS'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_servicioS']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    $_SESSION['error_servicioS'] = '';
  }

  if (isset($_SESSION['registro']) && !empty($_SESSION['registro'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>OK! </strong> <?php echo $_SESSION['registro']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
  }
  $_SESSION['registro'] = '';

  include("../template/pie.php");
} else {
  // No existe usuario o rol
  header('Location: ../../');
}
?>