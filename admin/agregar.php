<?php 

include("template/cabecera.php");

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
            <a href="productos.php"><input type="button" value="Cancelar" class="btn btn-info"></a>
        </div>
    </form>
        </div>
    </div>    
    </div>
    
<?php

include("template/pie.php");

?>


