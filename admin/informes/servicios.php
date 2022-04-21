<?php
// Inclusión de archivos necesarios
    include("../config/funcionesServicios.php");
    // Instancia de la clase
    $consulta = new FuncionesServicios;
    // Obtención de datos
    $resultados = $consulta->consultarServiciosAdmin();

?>  
<!-- Tabla de datos -->
  <div class="container">
        <div>
            <h5 class="text-center">Lista de servicios</h5>
        </div>
        <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
            <thead class="thead-inverse|thead-default">
                <tr>
                    <th>Referencia</th>
                    <th>Servicio</th>
                    <th>Imagen</th>
                    <th>Activa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultados as $resultado) {
                    ?>
                        <tr>
                            <td scope="row"><?php echo $resultado->referencia; ?></td>
                            <td><?php echo $resultado->servicio; ?></td>
                            <td><?php echo $resultado->imagen; ?></td>
                            <td><?php if ($resultado->activa == 1) {
                                    echo 'Activo';
                                } else {
                                    echo 'No activo';
                                } ?></td>
                            </tr>
                        <?php
                        }
                        ?>
            </tbody>
        </table>
    </div>
