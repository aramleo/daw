<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  include("../../config/funcionesDescargas.php");
  include("../../config/funcion_generica.php");

  if (empty($_POST['actualizar'])) {
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarDescarga.php');
  } else {
    $actualizar = new FuncionesDescargas;
    $foto = new Generica;

    $id = $_POST['id'];
    $referencia = $_POST['referencia'];
    $titulo = $_POST['titulo'];
    $enlace = $_POST['enlace'];
    if(isset($_POST['imagen'])){
      $imagen = $_POST['imagen'];
    }else{ $imagen = $foto->subirFoto('descargas');}
    $activa = $_POST['activa'];
    
    $datos = $actualizar->actualizar($id, $referencia, $titulo, $enlace, $imagen, $activa);
    if ($datos === false) {
      $datos = 'El registro no se ha actualizado';
      $_SESSION['error'] = $datos;
      header('Location: formEditarDescarga.php');
    }
    if ($datos === 'Registro actualizado') {
      $_SESSION['editado'] = 'El registro ha sido actualizado';
      header('Location: ../descargasAd.php');
    }
  }
}else{
  header('Location: ../../');
}
