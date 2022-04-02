<?php
// Introduccion de otro encabezado con los enlaces correctos
include('../template/headerS.php');
// Archivos necesarios para las consultas y ediciones
include '../config/funcionesUsuarios.php';

// Comprueba si la sesion de usuario y rol exite. Está logueado.
if (isset($_SESSION['usuario']) && ($_SESSION['rol'])) {

    $usuario = $_SESSION['usuario'];
    $id = $_SESSION['id'];

    // comprueba si existen las variables de error de la sesion.

    // Recupera los datos de usuario
    $datos = new FuncionesUsuarios;
    $misDatos = $datos->editarUsuario($id);
    if (isset($misDatos) && !empty($misDatos)) {
        $nombre = $misDatos[0]['nombre'];
        $email = $misDatos[0]['email'];
        $id = $misDatos[0]['id'];
    }else{
        $misDatos = $datos->editarUsuario($id);
        $nombre = $misDatos[0]['nombre'];
        $email = $misDatos[0]['email'];
        $id = $misDatos[0]['id'];
    }

    // Formulario para editar los datos
?>
    <div class="col-md-5 mt-3 mx-auto">
        <div id="cambio_datos" class="card">
            <div class="card-header">
                Datos del Usuario
            </div>
            <div class="card-body">
                <form action="cambioDatos.php" method="post" enctype="multipart/form-data">
                    <!-- Dato del ID oculto para actualizar en la base de datos -->
                    <div>
                        <input type="text" hidden id="id" name="id" value="<?php if (isset($id)) {
                                                                                echo $id;
                                                                            } ?>">
                    </div>
                    <!-- Introducción del nombre para actualizar -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre " name="nombre" value="<?php if (isset($nombre)) {
                                                                                                        echo $nombre;
                                                                                                    } ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($email)) {
                                                                                                    echo $email;
                                                                                                } ?>" required>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="actualizar" value="actualizar" class="btn btn-success">Actualizar</button>
                        <a class="btn btn-info mx-3" href="../perfil.php" role="button">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</br></strong>
            <p><?php echo $_SESSION['error']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        $_SESSION['error'] = '';
    }
    if (isset($_SESSION['error_nombre']) && !empty($_SESSION['error_nombre'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</br></strong>
            <p><?php echo $_SESSION['error_nombre']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        $_SESSION['error_nombre'] = '';
    }
    if (isset($_SESSION['error_email']) && !empty($_SESSION['error_email'])) {
    ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</br></strong>
            <p><?php echo $_SESSION['error_email']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        $_SESSION['error_email'] = '';
    }

    if (isset($_SESSION['exito']) && !empty($_SESSION['exito'])) {
        // Comprueba si el registro se ha modificado correctamente
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p><?php echo $_SESSION['exito']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
        // Vacía la sesión
        $_SESSION['exito'] = '';
    }
    // Incluye template pie
    include("../template/footer.php");
} else {
    // Si no existe sesion usuario y rol vuelve a la página principal.
    header('Location: ../');
}
