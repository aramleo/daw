<?php
// Iniciamos la sesion 
session_start();
// Comrpobamos si existe el usuario y si existe el rol de usuario. Pueden entrar en esta zona tanto admiistrador 
// como el usuario.
if (isset($_SESSION['usuario']) && (isset($_SESSION['rol']))) {
    include('template/header.php');
?>
<!-- Datos del usuario -->
    <div class="container-fluid mt-5 mb-2">
        <div class="row gy-2">
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
                        <?php
                        if ($_SESSION['rol'] == 2) {
                        ?>
                            <a href="perfil/formDireccion.php" class="btn btn-primary" role="button">Direccion usuario</a>
                        <?php
                        } else {
                        ?>
                            <a href="perfil/formDireccion.php" class="btn btn-primary disabled" role="button">Dirección usuario</a>
                        <?php
                        }
                        ?>
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
            <?php
            if ($_SESSION['rol'] == 2) {
            ?>
                <div class="col-sm-4">
                    <div class="card" style="width: vw;">
                        <img src="img/pedidos.png" style="width: 18rem;" class="card-img-top mx-auto" alt="imagen de direccion del usuario">
                        <div class="card-body mx-auto">
                            <a href="perfil/pedidos.php" class="btn btn-primary" role="button">Pedidos</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

<?php
    include("template/footer.php");
} else {
    // No está logueado
    header('Location: ../../');
}
?>