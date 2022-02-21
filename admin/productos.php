<?php    
include 'template/cabecera.php';
require_once 'config/conexion.php';
include 'config/funciones.php';

$resultados = consultar($conn);

?>

<div class="btn-group" role="group" aria-label="">
    <a href="agregar.php"><button type="text" class="btn btn-success">Agregar producto</button></a>
</div>

<div class="col-md-7 mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
    <?php
        foreach ($resultados as $resultado){
    
        ?>
            <tr>
                <td><?php echo $resultado->id;?></td>
                <td><?php echo $resultado->nombre;?></td>
                <td><?php echo $resultado->imagen;?></td>
                <td><a href="agregar.php"><button type="text" class="btn btn-primary">Editar</button></a><button type="text" class="btn btn-danger">Borrar</button></td>
            </tr>
            <?php
        } ?> 
        </tbody>
    </table>
    
</div>

<?php 

include("template/pie.php");

?>
