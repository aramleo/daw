
<?php
// Inclusion de archivos
    include("../config/funcionesAlquileres.php");
    // Instancia de la clase
    $consulta = new FuncionesAlquileres;
    // Consulta de datos de la base de datos
    $resultados = $consulta->consultarAlquilerAdmin();

?>  
<!-- Inclusión de la tabla con los datos -->
  <div class="container">
        <div>
            <h5 class="text-center">Lista de alquileres</h5>
        </div>
        <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
            <thead class="thead-inverse|thead-default">
                <tr>
                    <th>Referencia</th>
                    <th>Localidad</th>
                    <th>Metros</th>
                    <th>Imagen</th>
                    <th>Teléfono</th>
                    <th>Activa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultados as $resultado) {
                    ?>
                        <tr>
                            <td scope="row"><?php echo $resultado->referencia; ?></td>
                            <td><?php echo $resultado->localidad; ?></td>
                            <td><?php echo $resultado->metros; ?> m2</td>
                            <td><?php echo $resultado->imagen; ?></td>
                            <td><?php echo $resultado->telefono; ?></td>
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