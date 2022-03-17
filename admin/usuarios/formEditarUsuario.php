<?php
//Comenzamos la sesión para registrar errores y usuarios
session_start();
include("../template/cabecera.php");
include("../config/funcionesUsuarios.php");


// Variables que recogemos de la función editar en funciones.php
$actual = new FuncionesUsuarios;
$datos = $actual->editar($_GET['id']);
$nombre = $datos[0]['nombre'];
$email = $datos[0]['email'];
$password = $datos[0]['password'];
$rol = $datos[0]['clave_rol'];
$id = $datos[0]['id_usuario'];
?>

<div class="col-md-5 mt-3">
  <div class="card">
    <div class="card-header">
      Datos del producto
    </div>
    <div class="card-body">
      <form action="editarUsuario.php" method="post" enctype="multipart/form-data">
        <!-- Dato del ID oculto para actualizar en la base de datos -->
        <div>
          <input type="text" hidden id="id" name="id" value="<?php echo $id; ?>">
        </div>
        <!-- Introducción del nombre para actualizar -->
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="text" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="mb-3">
          <label for="rol" class="form-label">Rol:</label>
          <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $rol; ?>">
        </div>
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

?>