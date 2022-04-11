<?php
//Comenzamos la sesión para registrar errores y usuarios
session_start();
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
    include("../template/cabecera2.php");
    include("../../config/funcionesUsuarios.php");

    // Variables que recogemos de la función editar en funciones.php
    $actual = new FuncionesUsuarios;
    $datos = $actual->consulta_direccion($_GET['id']);
    $usuario = $actual->consultarUsuarioRol($_GET['id']);
    if (isset($datos) && !empty($datos)) {
?>
        <div class="col-md-5 mt-3">
            <div class="card">
                <div class="card-header">
                    Dirección del usuario
                </div>
                <div class="card-body">
                    <form action="editarUsuario.php" method="post" enctype="multipart/form-data">
                        <!-- Introducción del nombre para actualizar -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos[0]['nombre']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $datos[0]['email']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Direccion:</label>
                            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $datos[0]['direccion']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Otros datos:</label>
                            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $datos[0]['otros']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Localidad:</label>
                            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $datos[0]['localidad']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Provincia:</label>
                            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $datos[0]['provincia']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Código postal:</label>
                            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $datos[0]['cp']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="rol" name="rol" value="<?php echo $datos[0]['telefono']; ?>" readonly>
                        </div>
                        <div class="btn-group" role="group" aria-label="">
                            <a class="btn btn-info mx-3" href="../usuarios.php" role="button">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php
    } else {
    ?>
        <div class="container m-auto pt-5">
            <h5>El usuario <?php echo $usuario[0]['nombre']; ?> con email <?php echo $usuario[0]['email']; ?> no tiene datos de dirección</h5>
            <div class="btn-group mt-5" role="group" aria-label="">
                <a class="btn btn-info mx-3" href="../usuarios.php" role="button">Volver</a>
            </div>

        </div>

<?php
    }
}
?>