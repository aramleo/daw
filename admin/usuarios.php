<?php
// Inicio de sesión
session_start();
// Comprueba si existe la session de un usuario y si tiene el rol de administrador.
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
    include 'template/cabecera.php';
    include("../config/funcionesUsuarios.php");

    $consulta = new FuncionesUsuarios;
    $resultados = $consulta->consultarUsuario();

?>
    <div>
        <h5>Lista de usuarios</h5>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="usuarios" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultados as $resultado) {

                        ?>
                            <tr>
                                <td><?php echo $resultado->nombre; ?></td>
                                <td><?php echo $resultado->email; ?></td>
                                <td><?php echo $resultado->rol; ?></td>
                                <td class='text-center'>
                                <a href="usuarios/pedidos_usuarios.php?id=<?php echo $resultado->id; ?>" class="btn btn-secondary mx-2"><i class="bi bi-receipt" title="pedidos"></i></a>
                                    <a href="usuarios/consulta_direccion.php?id=<?php echo $resultado->id; ?>" class="btn btn-info mx-2"><i class="bi bi-signpost-2-fill" title="dirección"></i></a>
                                    <a href="usuarios/formEditarUsuario.php?id=<?php echo $resultado->id; ?>" class="btn btn-primary mx-2"><i class="bi bi-pencil-square" title="editar"></i></a>
                                    <a href="usuarios/borrarUsuario.php?id=<?php echo $resultado->id; ?>" class="btn btn-danger mx-2"><i class="bi bi-trash3-fill" title="eliminar"></i></a>
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
    <div>
        <!-- Imprimir informes de los datos -->
        <a name="imprimir" id="imprimir" class="btn btn-success" href="informes.php?tipo=usuarios" role="button">Imprimir Informes</a>
    </div>
    <script type="text/javascript" src="js/usuarios.js"></script>
    <?php
    // Comprobando la variable de sesión eliminar
    if (isset($_SESSION['eliminar']) && !empty($_SESSION['eliminar'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡OK! </strong> <?php echo $_SESSION['eliminar']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        $_SESSION['eliminar'] = '';
    }
// Comprobando la variable de sesión editado
    if (isset($_SESSION['editado']) && !empty($_SESSION['editado'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡OK! </strong> <?php echo $_SESSION['editado']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php
// vaciando la variable de sesión editado una vez impresa en pantalla
        $_SESSION['editado'] = '';
    }
// Inclusión de pie de página
    include("template/pie.php");
} else {
     // Redirección en caso de no existir usuario o rol
    header('Location: ../');
}
?>