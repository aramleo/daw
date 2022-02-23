<?php    
include 'template/cabecera.php';
require_once 'config/conexion.php';
include 'config/funciones.php';

$resultados = consultar($conn);

?>
<div>
    <a href="agregar.php"><button type="text" class="btn btn-success my-3">Agregar producto</button></a>
</div>
<div class="card">
    <div class="card-title">
        <h5>Lista de productos</h5>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Estación</th>
                <th scope="col" colspan="2" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultados as $resultado){
        
            ?>
            <tr>
                <td scope='row' class="ps-4"><?php echo $resultado->nombre;?></td>
                <td class="text-center"><?php echo $resultado->estacion;?></td>
                <td class="text-center"><a href="editar.php?id=<?php echo $resultado->ID;?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
                <td class="text-center"><a href="borrar.php?id=<?php echo $resultado->ID;?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a></td>
            </tr>
            <?php
            } ?> 
        </tbody>
    </table>
</div>





<?php 

include("template/pie.php");

?>
