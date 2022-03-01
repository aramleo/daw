<?php    

session_start();

include 'template/cabecera.php';
include 'config/conexion.php';
include 'config/funciones.php';

$consulta = new Funciones();
$resultados = $consulta->consultar($conn);

?>
<div>
    <a href="formAgregar.php"><button type="text" class="btn btn-success my-3">Agregar producto</button></a>
</div>
<div class="card">
    <div class="card-title">
        <h5>Lista de productos</h5>
    </div>
    <table id="productos" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Estacion</th>
                <th>Imagen</th>
                <th class='text-center'>Accion</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($resultados as $resultado){
        
            ?>
            <tr>
                <td><?php echo $resultado->nombre;?></td>
                <td><?php echo $resultado->estacion;?></td>
                <td><?php echo $resultado->img;?></td>
                <td class='text-center'><a href="formEditar.php?id=<?php echo $resultado->ID;?>" class="btn btn-primary mx-2"><i class="bi bi-pencil-square"></i></a>
                <a href="borrarProducto.php?id=<?php echo $resultado->ID;?>" class="btn btn-danger mx-2"><i class="bi bi-trash3-fill"></i></a></td>
            </tr>
        <?php
            } 
        ?> 
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<?php
if(isset($_SESSION['eliminar']) && !empty($_SESSION['eliminar'])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>¡OK! </strong> <?php echo $_SESSION['eliminar'];?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    $_SESSION['eliminar']='';
}

if(isset($_SESSION['editado']) && !empty($_SESSION['editado'])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>¡OK! </strong> <?php echo $_SESSION['editado'];?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    $_SESSION['editado']='';
}
include("template/pie.php");

?>


