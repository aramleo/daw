<?php
//Comenzamos la sesión para registrar errores y usuarios
session_start();
// Comprobamos usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  // Inclusión de los archivos necesarios
  include("../template/cabecera2.php");
  include("../../config/funcionesUsuarios.php");

  // Variables que recogemos de la función editar en funciones.php
  $actual = new FuncionesUsuarios;
  $datos = $actual->editar($_GET['id']);
  $nombre = $datos[0]['nombre'];
  $email = $datos[0]['email'];
  $rol = $datos[0]['id_rol'];
  $id = $datos[0]['id'];
?>

  <div class="col-md-5 mt-3">
    <div class="card">
      <div class="card-header">
        Datos del usuario
      </div>
      <div class="card-body">
        <form action="editarUsuario.php" method="post" enctype="multipart/form-data">
          <!-- Dato del ID oculto para actualizar en la base de datos -->
          <div>
            <input type="text" hidden id="id" name="id" value="<?php echo $id; ?>">
          </div>
          <!-- Introducción del nombre para actualizar -->
          <div class="mb-3">
            <label for="nombre" class="form-label">Usuario:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" readonly>
          </div>
          <!-- <div class="mb-3">
            <label for="rol" class="form-label">Rol:</label>
            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $rol; ?>">
            <p>Introducir 1 para administrador y 2 para usuario</p>
          </div> -->
          <?php
          if (isset($rol) && $rol == 1) { ?>
            <div class="mb-3">
              <label for="rol" class="form-label">Rol:</label>
              <select id="rol" name="rol">
                <option selected value="1">Administrador</option>
                <option value="2">Usuario</option>
              </select>
            </div>
          <?php
          }
          if (isset($rol) && $rol == 2) { ?>
            <div class="mb-3">
              <label for="rol" class="form-label">Rol:</label>
              <select id="rol" name="rol">
                <option value="1">Administrador</option>
                <option selected value="2">Usuario</option>
              </select>
            </div>

          <?php
          }
          ?>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="actualizar" value="actualizar" class="btn btn-success">Actualizar</button>
            <a class="btn btn-info mx-3" href="../usuarios.php" role="button">Volver</a>
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

  include("../template/pie.php");
} else {
  header('Location: ../../');
}
?>