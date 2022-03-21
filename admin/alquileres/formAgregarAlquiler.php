<?php

include("../template/cabecera2.php");
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'admin') {
?>

  <div class="col-md-5 mt-3">

    <div class="card">
      <div class="card-header">
        Datos del producto
      </div>
      <div class="card-body">
        <form action="agregarAlquiler.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="nombre" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto">
          </div>
          <div class="mb-3">
            <label for="estacion" class="form-label">Localidad:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Localidad donde se encuentra">
          </div>
          <div class="mb-3">
            <label for="mes" class="form-label">Metros:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Metros de la propiedad">
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="text" class="form-control" id="imagen" name="imagen" placeholder="Imagen">
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
            <a class="btn btn-info mx-3" href="../alquileres.php" role="button">Volver</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- alerta error registro -->
  <?php
  if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }
  $_SESSION['error'] = '';
  ?>
  <?php
  if (isset($_SESSION['registro']) && !empty($_SESSION['registro'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>OK! </strong> <?php echo $_SESSION['registro']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
  }
  $_SESSION['registro'] = '';
  ?>
<?php

  include("../template/pie.php");
} else {
  header('Location: ../../');
}
?>