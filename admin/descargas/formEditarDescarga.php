<?php
// Inicio de sesión
session_start();
//Comenzamos la sesión para registrar errores y usuarios

// omprobamos si existe usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  // Inclusión de archivos
  include("../template/cabecera2.php");
  include("../../config/funcionesDescargas.php");

  // Variables que recogemos de la función editar en funciones.php
  $actual = new FuncionesDescargas;

  if (isset($_SESSION['id_edicion']) && !empty($_SESSION['id_edicion'])) {
    $datos = $actual->editar($_SESSION['id_edicion']);
    $_SESSION['id_edicion'] = '';
  } else {
    $datos = $actual->editar($_GET['id']);
  }
  $referencia = $datos[0]['referencia'];
  $titulo = $datos[0]['titulo'];
  $enlace = $datos[0]['enlace'];
  $imagen = $datos[0]['imagen'];
  $activa = $datos[0]['activa'];
  $id = $datos[0]['id'];
?>
  <!-- Formulario -->
  <div class="col-md-5 mt-3">
    <div class="card">
      <div class="card-header">
        Datos de la descarga
      </div>
      <div class="card-body">
        <form action="editarDescarga.php" method="post" enctype="multipart/form-data">
          <!-- Dato del ID oculto para actualizar en la base de datos -->
          <div>
            <input type="text" hidden id="id" name="id" value="<?php echo $id; ?>">
          </div>
          <!-- Introducción de los datos para actualizar -->
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" value="<?php if (isset($referencia)) {
                                                                                                echo $referencia;
                                                                                              } ?>" minlength="3" maxlength="25" required>
          </div>
          <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php if (isset($titulo)) {
                                                                                        echo $titulo;
                                                                                      } ?>" minlength="5" maxlength="50" required>
          </div>
          <div class="mb-3">
            <label for="enlace" class="form-label">Enlace:</label>
            <input type="text" class="form-control" id="enlace" name="enlace" value="<?php if (isset($enlace)) {
                                                                                        echo $enlace;
                                                                                      } ?>" minlength="5" maxlength="200" required>
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" value="<?php if (isset($imagen)) {
                                                                                        echo $imagen;
                                                                                      } ?>">
          </div>
          <?php
          if (isset($activa) && $activa == 1) {
          ?>
            <div class="mb-3">
              <label for="activa" class="form-label">Activa:</label>
              <select id="activa" name="activa">
                <option selected value="1">Activo</option>
                <option value="0">No Activo</option>
              </select>
            </div>
          <?php
          }
          if (isset($activa) && $activa == 0) {
          ?>
            <div class="mb-3">
              <label for="activa" class="form-label">Activa:</label>
              <select id="activa" name="activa">
                <option value="1">Activo</option>
                <option selected value="0">No Activo</option>
              </select>
            </div>
          <?php
          }
          ?>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="actualizar" value="actualizar" class="btn btn-success">Actualizar</button>
            <a class="btn btn-info mx-3" href="../descargasAd.php" role="button">Volver</a>
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
  // Inclusión de pie de página
  include("../template/pie.php");
} else {
  // No es correcto usuario o rol
  header('Location: ../../');
}
?>