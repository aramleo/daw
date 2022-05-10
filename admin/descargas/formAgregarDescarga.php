<?php
// Inicio de sesión
session_start();
// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  // Inclusión de archivos
  include("../template/cabecera2.php");
?>
  <!-- Formulario -->
  <div class="col-md-5 mt-3">

    <div class="card">
      <div class="card-header">
        Datos de las descargas
      </div>
      <div class="card-body">
        <form action="agregarDescarga.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" minlength="3" maxlength="25" required placeholder="Referencia de la descarga">
          </div>
          <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" minlength="5" maxlength="50" required placeholder="Título de la descarga">
          </div>
          <div class="mb-3">
            <label for="enlace" class="form-label">Enlace:</label>
            <input type="text" class="form-control" id="enlace" name="enlace" minlength="5" maxlength="200" required placeholder="Enlace de la descarga">
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
            <a class="btn btn-info mx-3" href="../descargasAd.php" role="button">Volver</a>
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
    // Vaciando la variable después de imprimir en pantalla
    $_SESSION['error'] = '';
  }
  if (isset($_SESSION['error_refD']) && !empty($_SESSION['error_refD'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_refD']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    // Vaciando la variable después de imprimir en pantalla
    $_SESSION['error_refD'] = '';
  }
  if (isset($_SESSION['error_tituloD']) && !empty($_SESSION['error_tituloD'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_tituloD']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    // Vaciando la variable después de imprimir en pantalla
    $_SESSION['error_tituloD'] = '';
  }
  if (isset($_SESSION['error_enlaceD']) && !empty($_SESSION['error_enlaceD'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_enlaceD']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    // Vaciando la variable después de imprimir en pantalla
    $_SESSION['error_enlaceD'] = '';
  }

  // En caso de éxito
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
  // Inclusión de pie de página
  include("../template/pie.php");
  // problemas con el usuario o el rol
} else {
  header('Location: ../../');
}
?>