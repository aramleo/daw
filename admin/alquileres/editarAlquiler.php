<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  include("../../config/funcionesAlquileres.php");
  include("../../config/funcion_generica.php");

  if (empty($_POST['actualizar'])) {
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarAlquiler.php');
  } else {
    $actualizar = new FuncionesAlquileres;
    $foto = new Generica;
    $id = $_POST['id'];
    $referencia = $_POST['referencia'];
    $localidad = $_POST['localidad'];
    $metros = $_POST['metros'];
    $imagen = $foto->subirFoto('alquileres');
    $telefono = $_POST['telefono'];
    $activa = $_POST['activa'];
    
    $datos = $actualizar->actualizar($id, $referencia, $localidad, $metros, $imagen, $telefono, $activa);
    if ($datos === false) {
      $datos = 'El registro no se ha actualizado';
      $_SESSION['error'] = $datos;
      header('Location: formEditarAlquiler.php');
    }
    if ($datos === 'Registro actualizado') {
      $_SESSION['editado'] = 'El registro ha sido actualizado';
      header('Location: ../alquileres.php');
    }
  }
}else{
  header('Location: ../../');
}
