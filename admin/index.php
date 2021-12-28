<?php
    if($_POST){
        header('location: admin/inicio.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="./css/bootstrap.min.css" rel="stylesheet"/>
    <script src="./js/bootstrap.bundle.min.js"></script>
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 py-5">
        </div>
        <div class="col-md-4 p-5">
          <div class="card">
            <div class="card">
              <div class="card-header">Login Administrador</div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-group py-3">
                    <label for="usuarioAdmin">Usuario: </label>
                    <input
                      type="text"
                      class="form-control"
                      name="usuario"
                      placeholder="Introduce usuario"
                    />
                  </div>
                  <div class="form-group py-3">
                    <label for="password">Contraseña:</label>
                    <input
                      type="password"
                      class="form-control"
                      name="password"
                      placeholder="Contraseña"
                    />
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
        </div>
      </div>
    </div>
  </body>
</html>
