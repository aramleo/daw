      </nav>
      <nav class="navbar navbar-expand-sm navbar-dark bg-success">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuID" aria-controls="menuID" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="container-fluid">
              <div class="collapse navbar-collapse" id="menuID">
                  <div class="navbar-nav">
                      <a class="nav-link active" aria-current="page" href="./">Inicio</a>
                      <a class="nav-link active" aria-current="page" href="productos.php">Productos</a>
                      <a class="nav-link active" aria-current="page" href="alquileres.php">Alquileres</a>
                      <a class="nav-link active" aria-current="page" href="usuarios.php">Usuarios</a>
                      <a class="nav-link active" aria-current="page" href="../">Vista página</a>
                      <div class="navbar-nav" style="border-top:1px solid white">
                          <?php
                            if (isset($_SESSION['usuario'])) {
                            ?>
                              <a class="nav-link active d-sm-none" aria-current="page" href="../cerrarSesion.php">Cerrar sesión</a>
                          <?php
                            }
                            ?>
                      </div>
                  </div>
              </div>
              <div class="navbar-nav" style="float:left; border-left:1px solid white">
                  <?php
                    if (isset($_SESSION['usuario'])) {
                    ?>
                      <a class="nav-link active d-none d-md-inline" aria-current="page" href="../cerrarSesion.php">Cerrar sesión</a>
                  <?php
                    }
                    ?>
              </div>
          </div>
      </nav>