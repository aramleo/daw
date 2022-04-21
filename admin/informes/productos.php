<?php
// Inclusión de archivos
    include("../config/funcionesProductos.php");
    // Instancia
    $consulta = new Funciones;
    // Consulta datos
    $resultados = $consulta->consultar();

?>  
<!-- Inclusión de la tabla -->
  <div class="container">
        <div>
            <h5 class="text-center">Lista de productos</h5>
        </div>
        <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
            <thead class="thead-inverse|thead-default">
                <tr>
                    <th>Nombre</th>
                    <th>Referencia</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultados as $resultado) {
                    ?>
                        <tr>
                            <td scope="row"><?php echo $resultado->nombre; ?></td>
                            <td><?php echo $resultado->referencia; ?></td>
                            <td><?php echo $resultado->precio; ?></td>
                            <td><?php echo $resultado->imagen; ?></td>
                            <td><?php if ($resultado->estado == 1) {
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