<?php
session_start();
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
    include 'template/cabecera.php';
    include("../config/funcionesServicios.php");

    $consulta = new FuncionesServicios;
    $resultados = $consulta->consultarServiciosAdmin();


?>
    <div>
        <a href="servicios/formAgregarServicio.php"><button type="text" class="btn btn-success my-3">Agregar servicio</button></a>
    </div>
    <div>
        <h5>Lista de Servicios</h5>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table id="servicios" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Referencia</th>
                            <th>Servicio</th>
                            <th>Imagen</th>
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
                                <td><?php echo $resultado->servicio; ?></td>
                                <td><?php echo $resultado->imagen; ?></td>
                                <td><?php if($resultado->activa == 1){ echo 'Activo';} else{
                                    echo 'No activo';
                                } ?></td>
                                <td class='text-center'><a href="servicios/formEditarServicio.php?id=<?php echo $resultado->id; ?>" class="btn btn-primary mx-2"><i class="bi bi-pencil-square"></i></a>
                                    <a href="servicios/borrarServicio.php?id=<?php echo $resultado->id; ?>" class="btn btn-danger mx-2"><i class="bi bi-trash3-fill"></i></a>
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
        <a name="imprimir" id="imprimir" class="btn btn-success" href="informes.php?tipo=servicios" role="button">Imprimir Informes</a>
    </div>
    <script type="text/javascript" src="js/serviciosAd.js"></script>
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