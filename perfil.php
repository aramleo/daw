<?php
include('template/header.php');

if (isset($_SESSION['usuario']) && (isset($_SESSION['rol']))) {

?>  
    <div class="container-fluid mt-5">
    <div class="row">
        <div class="col-sm-4">
            <div class="card" style="width: vw;">
                <img src="img/datos.svg" style="width: 18rem;" class="card-img-top mx-auto" alt="imagen de datos personales">
                <div class="card-body mx-auto">
                    <a href="perfil/formCambioDatos.php" class="btn btn-primary">Datos personales</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card" style="width: vw;">
                <img src="img/direccion.svg" style="width: 18rem;" class="card-img-top mx-auto" alt="imagen de direccion del usuario">
                <div class="card-body mx-auto">
                    <a href="perfil/formDireccion.php" class="btn btn-primary">Direccion usuario</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card" style="width: vw;">
                <img src="img/password.svg" style="width: 18rem;" class="card-img-top mx-auto" alt="imagen de password">
                <div class="card-body mx-auto">
                    <a href="perfil/formCambioPassword.php" class="btn btn-primary">Cambio password</a>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php
    include("template/footer.php");
} else {
    header('Location: ../../');
}
?>