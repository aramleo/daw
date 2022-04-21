<?php
// Inicio de sesión
session_start();

// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  // Carga de archivos necesarios
  include("../../config/funcionesAlquileres.php");
  include("../../config/funcion_generica.php");

  // Se ha apretado el botón de actualizar
  if (empty($_POST['actualizar'])) {
    // Si error de campos vacíos, reenvío al formulario
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarAlquiler.php');
  } else {
    // En caso de apretar el botón de actualizar creación de variables
    $actualizar = new FuncionesAlquileres;
    $foto = new Generica;
    $id = $_POST['id'];
    $referencia = $_POST['referencia'];
    $localidad = $_POST['localidad'];
    $metros = $_POST['metros'];
    $imagen = $foto->subirFoto('alquileres');
    $telefono = $_POST['telefono'];
    $activa = $_POST['activa'];
    // Llamada a la base de datos para extracción desde funcionesAlquileres.php
    $datos = $actualizar->actualizar($id, $referencia, $localidad, $metros, $imagen, $telefono, $activa);
    if ($datos === false) {
      // No see ha podido terminar correctamente la ejecución
      $datos = 'El registro no se ha actualizado';
      $_SESSION['error'] = $datos;
      header('Location: formEditarAlquiler.php');
    }
    // En caso de éxito en la ejecución
    if ($datos === 'Registro actualizado') {
      $_SESSION['editado'] = 'El registro ha sido actualizado';
      header('Location: ../alquileres.php');
    }
  }
  // Si no existe usuario o rol
}else{
  header('Location: ../../');
}
