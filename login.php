<?php
  include("template/header.php");
?>
          <div class="p-5 bg-light">
            <div class="container">
              <h1 class="display-3">Login</h1>
              <p class="lead">Inicia sesión para entrar a la zona premium</p>
              <form action="./home.php" method="post" id="form">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="email" required/>
                  <div id="erroremail"></div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" name="password" class="form-control" id="password" required/>
                  <div id="errorpassword"></div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
<?php
  if (!empty($_COOKIE['message'])) {
?>
              <div>
                <?=$_COOKIE['message']?>
              </div>
<?php
    setcookie('message', "");
  }
?>
            </div>
          </div>
          <script src="./admin/js/validacion.js"></script>
<?php
  include("template/footer.php");
?>        