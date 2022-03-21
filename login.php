<?php
  include("template/header.php");

  include_once("admin/config/funcionesValidar.php");

  $retorno = validacionEmail();    

    if (!empty($retorno))            
    {
        list($errores,$datos)=$retorno;
    }
?>
  <div class="container">
  <p class="lead">Inicia sesión para entrar a la zona premium</p>
    <div class="row">
      <div class="col-md-6 py-5">
      <div class="card">
          <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
              <form action="#" method="post">
                <div class="form-group py-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="email" />
                </div>
                <div class="form-group py-3">
                  <label for="password">Contraseña:</label>
                  <input type="password" name="password" class="form-control" id="password" />
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
      if(isset($errores)){
        foreach($errores as $error){
          ?>
          <div class="text-danger">
          <?php echo $error;?>
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
      <div class="col-md-6 p-5">
        <div class="card">
          <img class="card-img-top" src="img\alimentos\fruits-vegetable-logo-fruits-vegetable-fruit-vegetable-food-nut-bowl-png-clip-art.png" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title">Ventajas de registro</h4>
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
  include("template/footer.php");
?>        