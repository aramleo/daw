<?php

//Carga los archivos necesarios para el saneamiento y validación y el header común de las páginas
include("template/header.php");
include_once("config/funcionesSanearValidar.php");
include_once("config/funcioneslogreg.php");

/* Comprobamos que no existe sesión de usuario o rol. En caso de existir no redirige a la página
principal de la página web*/

if (!isset($_SESSION['usuario']) || (!isset($_SESSION['rol']))) {

  // Llamamos al constructor de la clase
  $llamada = new FuncionesSaneaValida;

  // Iniciamos la variables a vacío
  $error_usuario = $error_password = $error_registro = '';

  /* Comprobamos el usuario saneando y validando el valor introducido. En caso de error en la 
     validación completa la variable error_nombre */
  if (!isset($_POST['usuario'])) {
    $error_nombre = "El campo usuario no puede estar vacío";
  } else {
    $nombre = $llamada->sanearNombre($_POST['usuario']);
    if (!empty($llamada->validaNombre($nombre))) {
      $error_nombre = $llamada->validaNombre($nombre);
    }
  }
?>
  <div class="container">
    <p class="lead">Inicia sesión para entrar a la zona premium</p>
<!--Código por el que abrimos un aviso modal para indicarnos que hemos registrado al usuario
    éxito y al cerrar lo borramos. Viene redirigido desde registro.php  -->
    <?php
    if (isset($_SESSION['datos']) && !empty($_SESSION['datos'])) {
    ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p><?php echo $_SESSION['datos']; ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
    }
    $_SESSION['datos'] = '';
    ?>
<!-- Formulario de Login -->
    <div class="row">
      <div class="col-md-6 py-5">
        <div class="card">
          <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
              <form action="" method="post">
                <div class="form-group py-3">
                  <label for="email" class="form-label">Usuario</label>
                  <input type="email" name="usuario" class="form-control" id="usuario" value="<?php if (!isset($errors['email']) && isset($_POST['email'])) echo $_POST['email']; ?>" required placeholder="Introduzca su correo electr&oacute;nico" />
                </div>
                <div class="form-group py-3">
                  <label for="password">Contraseña:</label>
                  <input type="password" name="password" class="form-control" id="password" required placeholder="Introduzca la contrase&ntilde;a" />
                </div>
                <div class="py-3">
                  <button type="submit" class="btn btn-primary">
                    Iniciar sesión
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
        <div class="mt-5">
          ¿No eres usuario?
          <a href="registro.php"><button type="button" class="btn btn-info">Regístrate</button></a>
        </div>
      </div>
      <!-- Columna derecha de la página -->
      <div class="col-md-6 p-5">
        <div class="card">
          <img class="card-img-top w-50 m-auto" src="img/alimentos/vegetales.png" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title text-center">Ventajas de registro</h4>
            <p class="card-text"></p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="bi bi-basket success" style="font-size: 2rem; color:blue;"></i> Ahorra tiempo en tus pedidos</li>
            <li class="list-group-item"><i class="bi bi-percent" style="font-size: 2rem; color:blue;"></i> Descuentos exclusivos para tí</li>
            <li class="list-group-item"><i class="bi bi-file-earmark-spreadsheet" style="font-size: 2rem; color:blue;"></i> Consulta tus pedidos cuando quieras</li>
            <li class="list-group-item"><i class="bi bi-info-circle" style="font-size: 2rem; color:blue;"></i> Accede a información exclusiva</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

<?php
// Carga del pie común de las páginas
  include("template/footer.php");
} else {
  // Redirige a la principal en caso de existir usuario y rol
  header('Location: ./');
}

?>