<?php
// Inicio de sesión
session_start();
// Comprobación usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  // Inclusión de los archivos necesarios en este archivo
  include("../template/cabecera2.php");
?>
  <!-- Formualario de agregar productos -->
  <div class="col-md-5 mt-3">

    <div class="card">
      <div class="card-header">
        Datos del producto
      </div>
      <div class="card-body">
        <form action="agregarProducto.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Producto:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" minlength="3" maxlength="50" placeholder="Nombre del producto">
          </div>
          <div class="mb-3">
            <label for="referencia" class="form-label">Referencia:</label>
            <input type="text" class="form-control" id="referencia" name="referencia" minlength="4" maxlength="20" placeholder="Referencia del producto">
          </div>
          <div class="mb-3">
            <label for="precio" class="form-label">Precio:</label>
            <input type="text" class="form-control" id="precio" name="precio" minlength="1" maxlength="10" placeholder="Precio del producto">
            <p>* Guardar los decimales con punto</p>
          </div>
          <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Cantidad del producto">
          </div>
          <div class="mb-3">
            <label for="estado" class="form-label">Activa:</label>
            <select id="estado" name="estado">
              <option value="1">Activo</option>
              <option value="0">No Activo</option>
            </select>
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" name="agregar" value="Agregar" class="btn btn-success">Agregar</button>
            <a class="btn btn-info mx-3" href="../productos.php" role="button">Volver</a>
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
    $_SESSION['error'] = '';
  }
  if (isset($_SESSION['error_nombreP']) && !empty($_SESSION['error_nombreP'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_nombreP']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    $_SESSION['error_nombreP'] = '';
  }
  if (isset($_SESSION['error_refP']) && !empty($_SESSION['error_refP'])) {
  ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>¡Error!</strong> <?php echo $_SESSION['error_refP']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php
    $_SESSION['error_refP'] = '';
  }
  if (isset($_SESSION['error_precioP']) && !empty($_SESSION['error_precioP'])) {
    ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Error!</strong> <?php echo $_SESSION['error_precioP']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php
      $_SESSION['error_precioP'] = '';
  }
  if (isset($_SESSION['registro']) && !empty($_SESSION['registro'])) {
  ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>OK! </strong> <?php echo $_SESSION['registro']; ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    // Vaciado de la variable
    $_SESSION['registro'] = '';
  }
  // Inclusión del pie de página
  include("../template/pie.php");
} else {
  // Redirección si no hay usuario o rol
  header('Location: ../../');
}
?>