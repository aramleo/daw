<?php

include './template/cabecera.php';
include("./config/funciones.php");
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'admin') {
    $consulta = new Funciones;
    $resultados = $consulta->consultar();

?>
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
                            <th>Estacion</th>
                            <th>Mes</th>
                            <th>Imagen</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultados as $resultado) {

                        ?>
                            <tr>
                                <td><?php echo $resultado->nombre; ?></td>
                                <td><?php echo $resultado->estacion; ?></td>
                                <td><?php echo $resultado->mes; ?></td>
                                <td><?php echo $resultado->img; ?></td>
                                <td class='text-center'><a href="productos/formEditar.php?id=<?php echo $resultado->ID; ?>" class="btn btn-primary mx-2"><i class="bi bi-pencil-square"></i></a>
                                    <a href="productos/borrarProducto.php?id=<?php echo $resultado->ID; ?>" class="btn btn-danger mx-2"><i class="bi bi-trash3-fill"></i></a>
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
    <!-- Llamada a archivos -->
    <script type="text/javascript" src="js/productos.js"></script>
    <?php

    if (isset($_SESSION['eliminar']) && !empty($_SESSION['eliminar'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡OK! </strong> <?php echo $_SESSION['eliminar']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        $_SESSION['eliminar'] = '';
    }

    if (isset($_SESSION['editado']) && !empty($_SESSION['editado'])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡OK! </strong> <?php echo $_SESSION['editado']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php

    }
    require_once("./template/pie.php");
} else {
    header('Location: ../');
}
?>