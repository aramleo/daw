<?php
include('template/header.php');

if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2')) {

    $usuarioActual = $_SESSION['usuario'];

    // Archivos necesarios para las consultas y ediciones
    include 'config/funcionesUsuarios.php';
    include 'config/funcioneslogreg.php';

    // Recupera los datos de usuario
    $datos = new FuncionesUsuarios;
    $misDatos = $datos->editarUsuario($usuarioActual);
    $nombreActual = $misDatos[0]['nombre'];
    $emailActual = $misDatos[0]['email'];
    $idactual = $misDatos[0]['id'];

?>
    <div class="container">
        <h4>Bienvenido <?php echo $nombreActual; ?></h4>
        <h5 class="text-center">Página de Perfil</h5>
    </div>
    <div class="btn-group btn-group-toggle gap-2" data-toggle="buttons" aria-label="Alternar">
        <button onclick="displayDatos()" type="button" id="btn_datos" value="btn_datos" class="btn btn-success">Datos</button>
        <button onclick="displayDireccion()" type="button" id="btn_direccion" value="btn_direccion" class="btn btn-success">Dirección</button>
        <button onclick="displayPassword()" type="button" id="btn_password" value="btn_password" class="btn btn-success">Password</button>
    </div>
    <div class="col-md-5 mt-3">
        <div id="cambio_datos" class="card">
            <div class="card-header">
                Datos del Usuario
            </div>
            <div class="card-body">
                <form action="editarUsuario.php" method="post" enctype="multipart/form-data">
                    <!-- Introducción del nombre para actualizar -->
                    <div class="mb-3">
                        <label for="calle" class="form-label">Direccion:</label>
                        <input type="text" class="form-control" id="calle " name="calle" value="<?php if (isset($nombreActual)) {
                                                                                                        echo $nombreActual;
                                                                                                    } ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Direccion:</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php if (isset($emailActual)) {
                                                                                                    echo $emailActual;
                                                                                                } ?>" required>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="introducir" value="introducir" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="cambio_direccion" class="card d-none">
            <div class="card-header">
                Direccion del Usuario
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Dato del ID oculto para actualizar en la base de datos -->
                    <div>
                        <input type="text" hidden id="id" name="id" value="<?php echo $idactual; ?>">
                    </div>
                    <!-- Introducción del nombre para actualizar -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Usuario:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php if (isset($nombreActual)) {
                                                                                                        echo $nombreActual;
                                                                                                    } ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($emailActual)) {
                                                                                                    echo $emailActual;
                                                                                                } ?>" required>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="actualizar" value="actualizar" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="cambio_password" class="card d-none">
            <div class="card-header">
                Cambio de password
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Introducción del nombre para actualizar -->
                    <div class="mb-3">
                        <label for="OldPassword" class="form-label">Password Actual:</label>
                        <input type="password" class="form-control" id="oldPassword" name="OldPassword" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nuevo password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirma" class="form-label">Confirmar nuevo password</label>
                        <input type="password" class="form-control" id="confirma" name="confirma" value="" required>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="guardar" value="guardar" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- <script>
        function displayPassword() {
            document.getElementById("cambio_password").classList.remove("d-none");
        };
        </script> -->
        <script src="js/cambio.js"></script>
    </div>
    <!-- alerta error registro comprobar después -->
    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</strong> <?php echo $_SESSION['error']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    }
    $_SESSION['error'] = '';
    ?>

<?php

    include("template/footer.php");
} else {
    header('Location: ../../');
}
?>