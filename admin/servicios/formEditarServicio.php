<?php
session_start();
//Comenzamos la sesión para registrar errores y usuarios

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  include("../template/cabecera2.php");
  include("../../config/funcionesServicios.php");

  // Variables que recogemos de la función editar en funciones.php
  $actual = new FuncionesServicios;

  if (isset($_SESSION['id_edicion']) && !empty($_SESSION['id_edicion'])) {
    $datos = $actual->editar($_SESSION['id_edicion']);
    $_SESSION['id_edicion'] = '';
  } else {
    $datos = $actual->editar($_GET['id']);
  }
  $referencia = $datos[0]['referencia'];
  $servicio = $datos[0]['servicio'];
  $imagen = $datos[0]['imagen'];
  $activa = $datos[0]['activa'];
  $id = $datos[0]['id'];
?>

  <div class="col-md-5 mt-3">
    <div class="card">
      <div class="card-header">
        Datos del Servicio
      </div>
      <div class="card-body">
        <form action="editarServicio.php" method="post" enctype="multipart/form-data">
          <!-- Dato del ID oculto para actualizar en la base de datos -->
          <div>
            <input type="text" hidden id="id" name="id" value="<?php echo $id; ?>">
          </div>
          <!-- Introducción del nombre para actualizar -->
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" value="<?php if (isset($referencia)) {
                                                                                                echo $referencia;
                                                                                              } ?>" minlength="3" maxlength="25" required>
          </div>
          <div class="mb-3">
            <label for="servicio" class="form-label">Servicio:</label>
            <input type="text" class="form-control" id="servicio" name="servicio" value="<?php if (isset($servicio)) {
                                                                                            echo $servicio;
                                                                                          } ?>" minlength="5" maxlength="50" required>
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
            <a class="btn btn-info mx-3" href="../serviciosAd.php" role="button">Volver</a>
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
  include("../template/pie.php");
} else {
  header('Location: ../../');
}
?>