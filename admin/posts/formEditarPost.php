<?php
session_start();
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  //Comenzamos la sesión para registrar errores y usuarios
  include("../template/cabecera2.php");
  include("../../config/funcionesBlog.php");

  // Variables que recogemos de la función editar en funciones.php
  $actual = new FuncionesBlog;
  $datos = $actual->editarPost($_GET['id']);
  $titulo = $datos[0]['titulo'];
  $fecha = $datos[0]['fecha'];
  $texto = $datos[0]['texto'];
  $imagen = $datos[0]['imagen'];
  $id = $datos[0]['id'];
?>

  <div class="col-md-5 mt-3">
    <div class="card">
      <div class="card-header">
        Datos del Post
      </div>
      <div class="card-body">
        <form action="editaPost.php" method="post" enctype="multipart/form-data">
          <!-- Dato del ID oculto para actualizar en la base de datos -->
          <div>
            <input type="text" hidden id="id" name="id" value="<?php echo $id; ?>">
          </div>
          <!-- Introducción del nombre para actualizar -->
          <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php if (isset($titulo)) {
                                                                                                echo $titulo;
                                                                                              } ?>" required>
          </div>
          <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php if (isset($fecha)) {
                                                                                              echo $fecha;
                                                                                            } ?>" required>
          </div>
          <div class="mb-3">
            <label for="texto" class="form-label">Texto:</label>
            <input type="text" class="form-control" id="texto" name="texto" value="<?php if (isset($texto)) {
                                                                                        echo $texto;
                                                                                      } ?>" required>
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="text" class="form-control" id="imagen" name="imagen" value="<?php if (isset($imagen)) {
                                                                                        echo $imagen;
                                                                                      } ?>">
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="actualizar" value="actualizar" class="btn btn-success">Actualizar</button>
            <a class="btn btn-info mx-3" href="../adminBlog.php" role="button">Volver</a>
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
include('../template/pie.php');
} else {
  header('Location: ../../');
}
?>