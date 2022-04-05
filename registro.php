<?php
session_start();

if (!isset($_SESSION['usuario']) || (!isset($_SESSION['rol']))) {

  include("template/header.php");
  include_once("config/funcionesSanearValidar.php");
  include_once("config/funcioneslogreg.php");

  $llamada = new FuncionesSaneaValida;
  $error_nombre = $error_email = $error_password = $error_confirma = $error_registro = '';
  if (!isset($_POST['usuario'])) {
    $error_nombre = "El campo usuario no puede estar vacío";
  } else {
    $nombre = $llamada->sanearNombre($_POST['usuario']);
    if (!empty($llamada->validaNombre($nombre))) {
      $error_nombre = $llamada->validaNombre($nombre);
    }
  }

  if (!isset($_POST['email'])) {
    $error_nombre = "El campo email no puede estar vacío";
  } else {
    $email = $llamada->sanearEmail($_POST['email']);
    if (!empty($llamada->validaEmail($email))) {
      $error_email = $llamada->validaEmail($email);
    }
  }
  if (!isset($_POST['password'])) {
    $error_password = "No se ha indicado el password";
  } else {
    $password = $llamada->sanearPassword($_POST['password']);
    if (!empty($llamada->validaPassword($password, $_POST['confirmacion']))) {
      $error_password = $llamada->validaPassword($password, $_POST['confirmacion']);
    }
  }
  if (!isset($_POST['confirmacion'])) {
    $error_confirma = "El campo confirmacion de password no puede estar vacío";
  }

  if ($error_nombre == "" && $error_email == "" && $error_password == "" && $error_confirma == "") {
    $envio = new FuncionesLogReg;
    $datos = $envio->registrarUsuario($nombre, $email, $password);
    if ($datos == 2) {
      $_SESSION['datos'] = 'Registrado con éxito';
      header("Location:login.php");
    }
    if ($datos == 3) {
      $error_registro = 'El usuario ya existe';
    }
  }
?>
  <div class="container">
    <div class="row">
      <div class="col-md-6 p-4">
        <p class="lead">Regístrate para acceder a la zona premium</p>
        <div class="card">
          <div class="card">
            <div class="card-header">Registro de usuarios</div>
            <div class="card-body">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group py-3">
                  <label for="usuario">Nombre y apellidos: </label>
                  <input type="text" class="form-control" id=usuario name="usuario" required value="<?php if (isset($nombre)) echo $nombre; ?>" placeholder="Introduce nombre y apellidos" />
                </div>
                <div class="form-group py-3">
                  <label for="email">Correo electrónico: </label>
                  <input type="text" class="form-control" id="email" name="email" required value="<?php if (isset($email)) echo $email; ?>" placeholder="Introduce tu correo electr&oacute;nico" />
                </div>
                <div class="form-group py-3">
                  <label for="password">Contraseña:</label>
                  <input type="password" class="form-control" id="password" name="password" required placeholder="La contrase&ntilde;a no puede ser menor de 8 car&aacute;cteres" />
                </div>
                <div class="form-group py-3">
                  <label for="confirmacion">Confirmación contraseña:</label>
                  <input type="password" class="form-control" id="confirmacion" name="confirmacion" required placeholder="Vuelve a introducir tu contrase&ntilde;a" />
                </div>
                <div class="py-3">
                  <button type="submit" name="registrar" value="registrar" class="btn btn-primary">
                    Registro
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- alerta error registro -->
  <?php
  if (isset($_POST['registrar'])) {
    if (!empty($error_nombre)) {
  ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Error!</br></strong>
        <p><?php echo $error_nombre; ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }
    if (!empty($error_email)) {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Error!</br></strong>
        <p><?php echo $error_email; ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }
    if (!empty($error_password)) {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Error!</br></strong>
        <p><?php echo $error_password; ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }
    if (!empty($error_confirma)) {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Error!</br></strong>
        <p><?php echo $error_confirma; ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }
    if (!empty($error_registro)) {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Error!</br></strong>
        <p><?php echo $error_registro; ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  <?php
    }
  }
  ?>

<?php
  include("template/footer.php");
} else {
  header('Location: ./');
}
?>