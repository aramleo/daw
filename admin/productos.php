<?php
// Inicio de sesión
session_start();
// Comprueba si existe la session de un usuario y si tiene el rol de administrador.
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
    include './template/cabecera.php';
    include("../config/funcionesProductos.php");
    $consulta = new Funciones;
    $resultados = $consulta->consultar();

?>
<!-- Tabla de datos de los productos -->
    <div>
        <a href="productos/formAgregar.php"><button type="text" class="btn btn-success my-3">Agregar producto</button></a>
    </div>
    <div>
        <div>
            <h5>Lista de productos</h5>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="productos" class="table display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Referencia</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultados as $resultado) {

                        ?>
                            <tr>
                                <td><?php echo $resultado->nombre; ?></td>
                                <td><?php echo $resultado->referencia; ?></td>
                                <td><?php echo $resultado->precio; ?></td>
                                <td><?php echo $resultado->imagen; ?></td>
                                <td><?php if ($resultado->estado == 1) {
                                        echo 'Activo';
                                    } else {
                                        echo 'No activo';
                                    } ?></td>
                                <td class='text-center'><a href="productos/formEditar.php?id=<?php echo $resultado->id; ?>" class="btn btn-primary mx-2"><i class="bi bi-pencil-square"></i></a>
                                    <a href="productos/borrarProducto.php?id=<?php echo $resultado->id; ?>" class="btn btn-danger mx-2"><i class="bi bi-trash3-fill"></i></a>
                                </td>
                            </tr>
                        <?php
                        }
                        $_SESSION['editado'] = '';
                        ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div>
        <a name="imprimir" id="imprimir" class="btn btn-success" href="informes.php?tipo=productos" role="button">Imprimir Informes</a>
    </div>
    <!-- Llamada a archivos -->
    <script type="text/javascript" src="js/productos.js"></script>
    <?php
// Comprobación si existe la variable eliminar
    if (isset($_SESSION['eliminar']) && !empty($_SESSION['eliminar'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡OK! </strong> <?php echo $_SESSION['eliminar']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
    // Vaciado de la variable
        $_SESSION['eliminar'] = '';
    }
// Comprobación si existe la variable editado
    if (isset($_SESSION['editado']) && !empty($_SESSION['editado'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡OK! </strong> <?php echo $_SESSION['editado']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php

    }
    // Inclusión de pie de página
    require_once("./template/pie.php");
} else {
    // redirección 
    header('Location: ../');
}
?>