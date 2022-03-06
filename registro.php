<?php
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
          <div class="p-5 bg-light">
            <div class="container">
              <h1 class="display-3"> Registro</h1>
              <p class="lead">Regístrate para acceder a la zona premium</p>
              <form action="<?=$_SERVER['PHP_SELF']?>" method="post" >
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required />
                </div>
                <div class="mb-3">
                  <label for="confirmacion" class="form-label">Password</label>
                  <input type="password" class="form-control" id="confirmacion" name="confirmacion" required />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
          <script src="./admin/js/validacion.js"></script>
<?php
  include("template/footer.php");
?>        