<?php
// Inclusion de archivos
    include("../config/funcionesDescargas.php");
// Instancia
    $consulta = new FuncionesDescargas;
// Consultar datos con la función
    $resultados = $consulta->consultarDescargasAdmin();

?> 
<!-- Inclusión de la tabla con los datos -->
  <div class="container">
        <div>
            <h5 class="text-center">Lista de descargas</h5>
        </div>
        <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
            <thead class="thead-inverse|thead-default">
                <tr>
                    <th>Referencia</th>
                    <th>T´tulo</th>
                    <th>Enlace</th>
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
                            <td><?php echo $resultado->titulo; ?></td>
                            <td><?php echo $resultado->enlace; ?></td>
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
