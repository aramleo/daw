<?php
// Inclusión de archivos
    include("../config/funcionesUsuarios.php");
    // Instancia de la clase
    $consulta = new FuncionesUsuarios;
    // Obtención de datos
    $resultados = $consulta->consultarUsuario();

?>  
<!-- Tabla de datos -->
  <div class="container">
        <div>
            <h5 class="text-center">Lista de usuarios</h5>
        </div>
        <table class="table table-striped|sm|bordered|hover|inverse table-inverse table-responsive">
            <thead class="thead-inverse|thead-default">
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($resultados as $resultado) {
                    ?>
                        <tr>
                            <td scope="row"><?php echo $resultado->nombre; ?></td>
                            <td><?php echo $resultado->email; ?></td>
                            <td><?php echo $resultado->rol; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
            </tbody>
        </table>
    </div>
