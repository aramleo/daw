<?php

/**
 * Aqui en este archivo introducimos los datos para el cambio de password en el formulario.
 */
session_start();
// Comprueba si la sesion de usuario y rol exite. Está logueado.
if (isset($_SESSION['usuario']) && ($_SESSION['rol'])) {
    // Introduccion de otro encabezado con los enlaces correctos
    include('../template/headerS.php');

    // Asignando valores al usuario y al id
    $usuario = $_SESSION['usuario'];
    $id = $_SESSION['id'];
    // Archivos necesarios para las consultas y ediciones
    include '../config/funcionesUsuarios.php';


    // Recupera los datos de usuario por si no existiera
    $datos = new FuncionesUsuarios;
    $misDatos = $datos->editarUsuario($id);
    if (isset($misDatos) && !empty($misDatos)) {
        $id = $misDatos[0]['id'];
    }

    // Formulario para editar los datos
?>
    <div class="col-md-5 mt-3 mx-auto">
        <div id="cambio_datos" class="card">
            <div class="card-header">
                Cambio de password
            </div>
            <div class="card-body">
                <form action="cambioPassword.php" method="post" enctype="multipart/form-data">
                    <!-- Introducción del nombre para actualizar -->
                    <div>
                        <input type="text" hidden id="id" name="id" value="<?php if (isset($id)) echo $id; ?>">
                    </div>
                    <!-- Password Actual -->
                    <div class="mb-3">
                        <label for="OldPassword" class="form-label">Password Actual:</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" value="" required>
                    </div>
                    <!-- Nuevo password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Nuevo password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" required>
                    </div>
                    <!-- Confirmar el nuevo password -->
                    <div class="mb-3">
                        <label for="confirma" class="form-label">Confirmar nuevo password</label>
                        <input type="password" class="form-control" id="confirma" name="confirma" value="" required>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="guardar" value="guardar" class="btn btn-success">Guardar</button>
                        <a class="btn btn-info mx-3" href="../perfil.php" role="button">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    // comprueba si existen las variables errores de $_SESSION.
    // Comprobando si existe la variable y si no está vacia.
    if (isset($_SESSION['error_password']) && !empty($_SESSION['error_password'])) {
    ?>
        <!-- Imprime un modal con el valor de la varible SESSION -->
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</br></strong>
            <p><?php echo $_SESSION['error_password']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        // Deja vacía la variable error_password para que si se recarga la página no vuelva a aparecer.
        $_SESSION['error_password'] = '';
    }

    if (isset($_SESSION['error_old']) && !empty($_SESSION['error_old'])) {
    ?>
        <!-- Imprime un modal con el valor de la varible SESSION -->
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</br></strong>
            <p><?php echo $_SESSION['error_old']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        // Deja vacía la variable error_old para que si se recarga la página no vuelva a aparecer.
        $_SESSION['error_old'] = '';
    }
    if (isset($_SESSION['error_new']) && !empty($_SESSION['error_new'])) {
    ?>
        <!-- Imprime un modal con el valor de la varible SESSION -->
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>¡Error!</br></strong>
            <p><?php echo $_SESSION['error_new']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        // Deja vacía la variable error_new para que si se recarga la página no vuelva a aparecer.
        $_SESSION['error_new'] = '';
    }
    // Comprueba si el registro se ha modificado correctamente
    if (isset($_SESSION['exito_password']) && !empty($_SESSION['exito_password'])) {
    ?>
        <!-- Imprime un modal con el valor de la varible SESSION -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p><?php echo $_SESSION['exito_password']; ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
        // Deja vacía la variable exito_password para que si se recarga la página no vuelva a aparecer.
        $_SESSION['exito_password'] = '';
    }
    // Incluye template pie
    include("../template/footer.php");
} else {
    // Si no existe sesion usuario y rol vuelve a la página principal.
    header('Location: ../');
}
