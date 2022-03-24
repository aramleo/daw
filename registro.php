<?php
include("template/header.php");
include_once("config/funcionesValidar.php");

if (!isset($_SESSION['usuario'])) {

  $retorno = validacion();

  if (!empty($retorno)) {
    list($errores, $datos) = $retorno;
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
              <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group py-3">
                  <label for="usuario">Nombre y apellidos: </label>
                  <input type="text" class="form-control" id=usuario name="usuario" required value="<?php if (!isset($errors['nombre']) && isset($_POST['usuario'])) echo $_POST['usuario']; ?>" placeholder="Introduce nombre y apellidos" />
                </div>
                <div class="form-group py-3">
                  <label for="email">Correo electrónico: </label>
                  <input type="text" class="form-control" id="email" name="email" required value="<?php if (!isset($errors['email']) && isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Introduce tu correo electr&oacute;nico" />
                </div>
                <div class="form-group py-3">
                  <label for="password">Contraseña:</label>
                  <input type="password" class="form-control" id="password" name="password" required placeholder="Contrase&ntilde;a" />
                </div>
                <div class="form-group py-3">
                  <label for="confirmacion">Confirmación contraseña:</label>
                  <input type="password" class="form-control" id="confirmacion" name="confirmacion" required placeholder="Vuelve a introducir tu contrase&ntilde;a" />
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
        <?php
        if (isset($errores)) {
          foreach ($errores as $error) {
        ?>
            <div class="text-danger">
              <?php echo $error; ?>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </div>

<?php
  include("template/footer.php");
} else {
  header('Location: index.php');
}
?>