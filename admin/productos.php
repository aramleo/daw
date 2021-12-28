<?php include("template/cabecera.php");?>

<?php    

$id = (isset($_POST['id']))?$_POST['id']:"";
$nombre = (isset($_POST['nombre']))?$_POST['nombre']:"";
$imagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

echo $id."<br/>";
echo $nombre."<br/>";
echo $imagen."<br/>";
echo $accion."<br/>";


?>

<div class="col-md-5 mt-3">

<div class="card">
    <div class="card-header">
        Datos del producto
    </div>
    
    <div class="card-body">
    <form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="id" class="form-label">ID:</label>
    <input type="text" class="form-control" name="id" id="id" placeholder="ID">
  </div>
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre Producto:</label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto">
  </div>
  <div class="mb-3">
    <label for="txtImagen" class="form-label">Imagen:</label>
    <input type="file" class="form-control" id="txtImagen" name="txtImagen" placeholder="Nombre del producto">
  </div>
    <div class="btn-group" role="group" aria-label="">
        <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
        <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
        <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
    </div>
</form>
    </div>
</div>    
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
            <tr>
                <td>2</td>
                <td>Semillas de zanahoria</td>
                <td>imagen.jpg</td>
                <td>Seleccionar | Borrar</td>
            </tr>
        </tbody>
    </table>
    
</div>

<?php 

include("template/pie.php");

?>
