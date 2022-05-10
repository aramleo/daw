<?php
// Inicio de sesión
session_start();
// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  // Archivo de menu 
  include("../template/cabecera2.php");
?>
  <!-- Se carga el formulario -->
  <div class="col-md-5 mt-3">

    <div class="card">
      <div class="card-header">
        Datos del Alquiler
      </div>
      <div class="card-body">
        <form action="agregarAlquiler.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" minlength="3" maxlength="25" required placeholder="Referencia del inmueble">
          </div>
          <div class="mb-3">
            <label for="localidad" class="form-label">Localidad:</label>
            <input type="text" class="form-control" id="localidad" name="localidad" minlength="3" maxlength="50" required placeholder="Localidad donde se encuentra">
          </div>
          <div class="mb-3">
            <label for="metros" class="form-label">Metros:</label>
            <input type="text" class="form-control" id="metros" name="metros" minlength="1" maxlength="10" required placeholder="Metros de la propiedad">
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Imagen">
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono propietario:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" pattern="[0-9]{9}" required placeholder="Teléfono del propietario">
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
    $_SESSION['error'] = '';
  }
  if (isset($_SESSION['error_refA']) && !empty($_SESSION['error_refA'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_refA']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    $_SESSION['error_refA'] = '';
  }
  if (isset($_SESSION['error_localidadA']) && !empty($_SESSION['error_localidadA'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_localidadA']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    $_SESSION['error_localidadA'] = '';
  }
  if (isset($_SESSION['error_metrosA']) && !empty($_SESSION['error_metrosA'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_metrosA']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    $_SESSION['error_metrosA'] = '';
  }
  if (isset($_SESSION['error_telefonoA']) && !empty($_SESSION['error_telefonoA'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_telefonoA']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    $_SESSION['error_telefonoA'] = '';
  }
  // En caso de éxito en la agregación del alquiler
  if (isset($_SESSION['registro']) && !empty($_SESSION['registro'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>OK! </strong> <?php echo $_SESSION['registro']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
  }
  $_SESSION['registro'] = '';
  // Inclusión del pie de página
  include("../template/pie.php");
} else {
  // En caso de no existir usuario o rol
  header('Location: ../../');
}
?>