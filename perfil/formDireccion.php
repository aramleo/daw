<?php
session_start();
/**
 * Aqui en este archivo introducimos los datos para el cambio de password en el formulario.
 */
// Comprueba si la sesion de usuario y rol exite. Está logueado.
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == 2)) {
    // Introduccion de otro encabezado con los enlaces correctos
    include('../template/headerS.php');
    // Archivos necesarios para las consultas y ediciones
    include '../config/funcionesDireccion.php';
    $id_usuario = $_SESSION['id'];

    $llamadaDireccion = new FuncionesDireccion;
    $direccion = $llamadaDireccion->consultarDireccion($id_usuario);
    if ($direccion) {
        print_r($direccion);
        $id_usuario = $direccion[0]['id_usuario'];
        $id = $direccion[0]['id'];
        $dni = $direccion[0]['dni'];
        $domicilio = $direccion[0]['direccion'];
        $otros = $direccion[0]['otros'];
        $localidad = $direccion[0]['localidad'];
        $provincia = $direccion[0]['provincia'];
        $cp = $direccion[0]['cp'];
        $telefono = $direccion[0]['telefono'];
?>
        <!-- Formulario para editar los datos -->
        <div class="col-md-5 mt-3 mx-auto">
            <div id="cambio_direccion" class="card">
                <div class="card-header">
                    Direccion del Usuario
                </div>
                <div class="card-body">
                    <form action="cambioDatos.php" method="post" enctype="multipart/form-data">
                        <!-- Introducción del nombre para actualizar -->
                        <div class="mb-3" hidden>
                            <label for="id" class="form-label">id:</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php if (isset($id)) {
                                                                                                    echo $id;
                                                                                                } ?>" readonly>
                        </div>
                        <div class="mb-3" hidden>
                            <label for="dni" class="form-label">Id_usuario:</label>
                            <input type="text" class="form-control" id="id_usuario" name="dni" value="<?php if (isset($id_usuario)) {
                                                                                                            echo $id_usuario;
                                                                                                        } ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">Dni:</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="<?php if (isset($dni)) {
                                                                                                    echo $dni;
                                                                                                } ?>" pattern="^[0-9]{8}[A-Z]$" required>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Direccion:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php if (isset($domicilio)) {
                                                                                                                echo $domicilio;
                                                                                                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="otros" class="form-label">Otros datos:</label>
                            <textarea class="form-control" row="2" id="otros" name="otros"><?php if (isset($otros)) {
                                                                                                echo $otros;
                                                                                            } ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="localidad" class="form-label">Localidad:</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" value="<?php if (isset($localidad)) {
                                                                                                                echo $localidad;
                                                                                                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="provincia" class="form-label">Provincia:</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" value="<?php if (isset($provincia)) {
                                                                                                                echo $provincia;
                                                                                                            } ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cp" class="form-label">Código postal:</label>
                            <input type="text" class="form-control" id="cp" name="cp" value="<?php if (isset($cp)) {
                                                                                                    echo $cp;
                                                                                                } ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php if (isset($telefono)) {
                                                                                                                echo $telefono;
                                                                                                            } ?>" pattern="[0-9]{9}" required>
                        </div>
                        <div class="btn-group" role="group" aria-label="">
                            <button type="submit" name="actualiza" value="actualiza" class="btn btn-success">Actualizar</button>
                            <a class="btn btn-info mx-3" href="../perfil.php" role="button">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <!-- Formulario para editar los datos -->
        <div class="col-md-5 mt-3 mx-auto">
            <div id="cambio_direccion" class="card">
                <div class="card-header">
                    Direccion del Usuario
                </div>
                <div class="card-body">
                    <form action="agregarDireccion.php" method="post" enctype="multipart/form-data">
                        <!-- Introducción del nombre para actualizar -->
                        <div class="mb-3" hidden>
                            <label for="dni" class="form-label">Id_usuario:</label>
                            <input type="text" class="form-control" id="id_usuario" name="dni" value="<?php if (isset($id_usuario)) {
                                                                                                            echo $id_usuario;
                                                                                                        } ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">Dni:</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="<?php if (isset($dni)) {
                                                                                                    echo $dni;
                                                                                                } ?>" pattern="^[0-9]{8}[A-Z]$" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Direccion:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="otros" class="form-label">Otros datos:</label>
                            <textarea class="form-control" row="2" id="otros" name="otros" value="hay datos"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="localidad" class="form-label">Localidad:</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="provincia" class="form-label">Provincia:</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="cp" class="form-label">Código postal:</label>
                            <input type="text" class="form-control" id="cp" name="cp" value="" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="" required>
                        </div>
                        <div class="btn-group" role="group" aria-label="">
                            <button type="submit" name="guardado" value="guardado" class="btn btn-success">Guardar</button>
                            <a class="btn btn-info mx-3" href="../perfil.php" role="button">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
    // Incluye template pie
    include("../template/footer.php");
} else {
    // Si no existe sesion usuario y rol vuelve a la página principal.
    header('Location: ../');
}
