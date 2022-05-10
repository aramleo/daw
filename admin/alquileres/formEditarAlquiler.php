<?php
// Inicio de sesión
session_start();
// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  //Comenzamos la sesión para registrar errores y usuarios
  include("../template/cabecera2.php");
  include("../../config/funcionesAlquileres.php");

  // Variables que recogemos de la función editar en funciones.php
  $actual = new FuncionesAlquileres;
  if(isset($_SESSION['id_edicion']) && !empty($_SESSION['id_edicion'])){
    $datos = $actual->editar($_SESSION['id_edicion']);
    $_SESSION['id_edicion']='';
  }else{
    $datos = $actual->editar($_GET['id']);
  }
  $referencia = $datos[0]['referencia'];
  $localidad = $datos[0]['localidad'];
  $metros = $datos[0]['metros'];
  $imagen = $datos[0]['imagen'];
  $telefono = $datos[0]['telefono'];
  $activa = $datos[0]['activa'];
  $id = $datos[0]['id'];
?>
<!-- Formulario de edición del alquiler -->
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
          <!-- Introducción de los datos para actualizar -->
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" value="<?php if (isset($referencia)) {
                                                                                                echo $referencia;
                                                                                              } ?>" minlength="3" maxlength="25" required>
          </div>
          <div class="mb-3">
            <label for="localidad" class="form-label">Localidad:</label>
            <input type="text" class="form-control" id="localidad" name="localidad" value="<?php if (isset($localidad)) {
                                                                                              echo $localidad;
                                                                                            } ?>" minlength="3" maxlength="50" required>
          </div>
          <div class="mb-3">
            <label for="metros" class="form-label">Metros:</label>
            <input type="text" class="form-control" id="metros" name="metros" value="<?php if (isset($metros)) {
                                                                                        echo $metros;
                                                                                      } ?>" minlength="1" maxlength="10" required>
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" value="<?php if (isset($imagen)) {
                                                                                        echo $imagen;
                                                                                      } ?>">
          </div>
          <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono propietario:</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php if (isset($telefono)) {
                                                                                            echo $telefono;
                                                                                          } ?>" pattern="[0-9]{9}" required>
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
          if(isset($activa) && $activa == 0){
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
            <a class="btn btn-info mx-3" href="../alquileres.php" role="button">Volver</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- alerta error registro comprobar -->
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

  include("../template/pie.php");
} else {
  header('Location: ../../');
}
?>