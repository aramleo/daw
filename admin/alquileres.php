<?php    

// session_start();
include ("config/funcionesAlquileres.php");


$consulta = new FuncionesAlquileres;
$resultados = $consulta->consultarAlquiler();

include 'template/cabecera.php';
?>
<div>
    <a href="alquileres/formAgregarAlquiler.php"><button type="text" class="btn btn-success my-3">Agregar alquiler</button></a>
</div>
<div class="card">
    <div class="card-title">
        <h5>Lista de alquileres</h5>
    </div>
    <table id="productos" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Referencia</th>
                <th>Localidad</th>
                <th>metros</th>
                <th>Imagen</th>
                <th class='text-center'>Accion</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($resultados as $resultado){
        
            ?>
            <tr>
                <td><?php echo $resultado->referencia;?></td>
                <td><?php echo $resultado->localidad;?></td>
                <td><?php echo $resultado->metros;?></td>
                <td><?php echo $resultado->imagen;?></td>
                <td class='text-center'><a href="alquileres/formEditarAlquiler.php?id=<?php echo $resultado->id;?>" class="btn btn-primary mx-2"><i class="bi bi-pencil-square"></i></a>
                <a href="alquileres/borrarAlquiler.php?php echo $resultado->id;?>" class="btn btn-danger mx-2"><i class="bi bi-trash3-fill"></i></a></td>
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


