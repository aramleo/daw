<?php
// Inicio de sesión
session_start();
// Comrpobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  include("../template/cabecera2.php");
?>
  <!-- Formulario de datos -->
  <div class="col-md-5 mt-3">
    <div class="card">
      <div class="card-header">
        Datos del Post
      </div>
      <div class="card-body">
        <form action="agregarPost.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" minlength="4" maxlength="50" required placeholder="Título del post">
          </div>
          <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required placeholder="Fecha del post">
          </div>
          <div class="mb-3">
            <label for="texto" class="form-label">Texto:</label>
            <input type="text" class="form-control" id="texto" name="texto" minlength="5" required placeholder="Texto del cuerpo del post">
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Imagen">
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
            <a class="btn btn-info mx-3" href="../adminBlog.php" role="button">Volver</a>
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
    // Vaciando la variable después de imprimir en pantalla en caso de existir
    $_SESSION['error'] = '';
  }
  if (isset($_SESSION['error_tituloB']) && !empty($_SESSION['error_tituloB'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_tituloB']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    // Vaciando la variable después de imprimir en pantalla en caso de existir
    $_SESSION['error_tituloB'] = '';
  }
  if (isset($_SESSION['error_textoB']) && !empty($_SESSION['error_textoB'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_textoB']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    // Vaciando la variable después de imprimir en pantalla en caso de existir
    $_SESSION['error_textoB'] = '';
  }

  // Exito en el registro
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
  // Inclusión del pie de página
  include('../template/pie.php');
  // Error en la comprobación de usuario y rol
} else {
  header('Location: ../../');
}
?>