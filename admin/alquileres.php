<?php
include 'template/cabecera.php';
include("../config/funcionesAlquileres.php");
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'admin') {

    $consulta = new FuncionesAlquileres;
    $resultados = $consulta->consultarAlquiler();


?>
    <div>
        <a href="alquileres/formAgregarAlquiler.php"><button type="text" class="btn btn-success my-3">Agregar alquiler</button></a>
    </div>
    <div>
        <h5>Lista de alquileres</h5>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="alquileres" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Referencia</th>
                            <th>Localidad</th>
                            <th>metros</th>
                            <th>Imagen</th>
                            <th>Teléfono</th>
                            <th>Activa</th>
                            <th class='text-center'>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultados as $resultado) {

                        ?>
                            <tr>
                                <td><?php echo $resultado->referencia; ?></td>
                                <td><?php echo $resultado->localidad; ?></td>
                                <td><?php echo $resultado->metros; ?></td>
                                <td><?php echo $resultado->imagen; ?></td>
                                <td><?php echo $resultado->telefono; ?></td>
                                <td><?php echo $resultado->activa; ?></td>
                                <td class='text-center'><a href="alquileres/formEditarAlquiler.php?id=<?php echo $resultado->id; ?>" class="btn btn-primary mx-2"><i class="bi bi-pencil-square"></i></a>
                                    <a href="alquileres/borrarAlquiler.php?id=<?php echo $resultado->id;?>" class="btn btn-danger mx-2"><i class="bi bi-trash3-fill"></i></a>
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

    <script type="text/javascript" src="js/alquileres.js"></script>
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
        $_SESSION['editado'] = '';
    }
    include("template/pie.php");
} else {
    header('Location: ../');
}
?>