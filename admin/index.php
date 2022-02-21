<?php
    if($_POST){
        header('location: inicio.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
