<?php
  include("template/header.php");
?>
          <div class="p-5 bg-light">
            <div class="container">
              <h1 class="display-3">Login</h1>
              <p class="lead">Inicia sesión para entrar a la zona premium</p>
              <form action="./home.php" method="post">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="email" />
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Contraseña</label>
                  <input type="password" name="password" class="form-control" id="password" />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
<?php
  include("template/footer.php");
?>        