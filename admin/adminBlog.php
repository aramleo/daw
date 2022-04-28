<?php
// Inicio de sesión
session_start();
/**
 * En este archivo se presentan todos los alquileres introducidos en la base de datos por el administrador
 * de la página web.
 */

// Comprueba si existe la session de un usuario y si tiene el rol de administrador.
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
    include 'template/cabecera.php';
    include("../config/funcionesBlog.php");
    // llama a la clase Funciones Blog.
    $consulta = new FuncionesBlog;
    // Extrae los datos.
    $resultados = $consulta->consultarPost();
?>
    <!-- Tabla donde se muestran los alquileres instroducidos por el administrador -->
    <div>
        <a href="posts/formAgregarPost.php"><button type="text" class="btn btn-success my-3">Agregar post</button></a>
    </div>
    <div>
        <h5>Lista de posts</h5>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="posts" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Fecha</th>
                            <th>Imagen</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultados as $resultado) {

                        ?>
                            <tr>
                                <td><?php echo $resultado->titulo; ?></td>
                                <td><?php echo $resultado->fecha; ?></td>
                                <td><?php echo $resultado->imagen; ?></td>
                                <td class='text-center'><a href="posts/formEditarPost.php?id=<?php echo $resultado->id; ?>" class="btn btn-primary mx-2"><i class="bi bi-pencil-square"></i></a>
                                    <a href="posts/borrarPost.php?id=<?php echo $resultado->id; ?>" class="btn btn-danger mx-2"><i class="bi bi-trash3-fill"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- Función javascript de datatables -->
    <script type="text/javascript" src="js/posts.js"></script>
    <?php
    // Comrpobando si existe la varible sesion eliminar.
    if (isset($_SESSION['eliminar']) && !empty($_SESSION['eliminar'])) {
    ?>
        <!-- Modal que nos muestra si se ha realizado la eliminación del registro -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡OK! </strong> <?php echo $_SESSION['eliminar']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        $_SESSION['eliminar'] = '';
    }
    // Nos informa del resultado de la edición.
    if (isset($_SESSION['editado']) && !empty($_SESSION['editado'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡OK! </strong> <?php echo $_SESSION['editado']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
        $_SESSION['editado'] = '';
    }
    include('template/pie.php');
} else {
    // Si no ha iniciado sesión, te redirige a la página principal
    header('Location: ../');
}
?>