<?php
  // session_start();
  include("template/header.php");

  require_once("admin/config/funciones.php");
  use admin\config\Clase;

  if (isset($_POST['email']) && isset($_POST['password'])) {
    // filtramos los campos que vienen del formulario de login.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!empty($email) && !empty($password)) {
      $registrarUsuario = new Clase\Funciones;
      $registrarUsuario->registrarUsuario($email, $password);
      $registrarUsuario->redireccion('login.php');
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
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
              <div class="form-group py-3">
                <label for="usuario">Usuario: </label>
                <input type="text" class="form-control" id=usuario name="usuario" required placeholder="Introduce usuario" />
              </div>
              <div class="form-group py-3">
                <label for="email">Correo electrónico: </label>
                <input type="text" class="form-control" id="email" name="email" required placeholder="Introduce tu correo electrónico" />
              </div>
              <div class="form-group py-3">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="Contraseña" />
              </div>
              <div class="form-group py-3">
                <label for="confirmacion">Confirmación contraseña:</label>
                <input type="password" class="form-control" name="confirmacion" required placeholder="Vuelve a introducir tu contraseña" />
              </div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary">
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

<?php
include("template/footer.php");
?>