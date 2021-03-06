<?php
// iniciamos sesión
session_start();
/* Comprobamos que no existe sesión de usuario o rol. En caso de existir no redirige a la página
principal de la página web*/

if (!isset($_SESSION['usuario']) || (!isset($_SESSION['rol']))) {
  //Carga los archivos necesarios para el saneamiento y validación y el header común de las páginas
  include("template/header.php");
  include_once("config/funcionesSanearValidar.php");
  include_once("config/funcioneslogreg.php");

  // Llamamos al constructor de la clase
  $llamada = new FuncionesSaneaValida;

  // Iniciamos la variables a vacío
  $error_email = $error_password = $error_registro = '';

  /* Comprobamos el usuario saneando y validando el valor introducido. En caso de error en la 
     validación completa la variable error_nombre */
  if (!isset($_POST['email'])) {
    $error_email = "El campo email no puede estar vacío";
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
    if (!empty($llamada->soloPassword($password))) {
      $error_password = $llamada->soloPassword($password);
    }
  }
  if ($error_email == "" && $error_password == "") {
    $login = new FuncionesLogReg;
    $datos = $login->comprobarUsuario($email, $password);
    if ($datos) {
      $_SESSION['usuario'] = $datos[0]['email'];
      $_SESSION['rol'] = $datos[0]['id_rol'];
      $_SESSION['id'] = $datos[0]['id'];
      echo "<script>location.href='./';</script>";
    } else {
      $_SESSION['noexiste'] = 'El usuario no existe o los datos introducidos no son correctos';
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
    if (isset($_SESSION['noexiste']) && !empty($_SESSION['noexiste'])) {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p><?php echo $_SESSION['noexiste']; ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php
    }
    if (isset($_POST['inicio'])) {
      // Imprime el error del correo electrónico si no es correcto
      if (isset($error_email) && !empty($error_email)) {
      ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <p><?php echo $error_email; ?></p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php
      }
      // Imprime el error del password si no es correcto
      if (isset($error_password) && !empty($error_password)) {
      ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <p><?php echo $error_password; ?></p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        $error_password = "";
        $_POST['password'] = '';
      }
    }

    $_SESSION['datos'] = '';
    $_SESSION['noexiste'] = '';
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
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="email" value="<?php if (!isset($errors['email']) && isset($_POST['email'])) echo $_POST['email']; ?>" required placeholder="Introduzca su correo electr&oacute;nico" />
                </div>
                <div class="form-group py-3">
                  <label for="password">Contraseña:</label>
                  <input type="password" name="password" class="form-control" id="password" required placeholder="Introduzca la contrase&ntilde;a" />
                </div>
                <div class="py-3">
                  <button type="submit" id="inicio" name="inicio" class="btn btn-primary">
                    Iniciar sesión
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Button trigger modal -->
        <a type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
          ¿Has olvidado tu password?
        </a>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Recibirás un correo electrónico con una contraseña que estará vigente durante 24 horas.</p>
                <form action="reset_password.php" method="post">
                  Introduce tu email
                  <input type="email_reset" name="email_reset" id="email_reset" required>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                  <button type="submit" id="envio" name="envio" class="btn btn-primary" value="enviar">
                    Enviar
                  </button>
              </div>
              </form>
            </div>
          </div>
        </div>
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