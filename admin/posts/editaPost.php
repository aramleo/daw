<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  include("../../config/funcionesBlog.php");
  include("../../config/funcion_generica.php");

  if (empty($_POST['actualizar'])) {
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarPost.php');
  } else {
    $actualizar = new FuncionesBlog;
    $foto = new Generica;
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];
    $texto = $_POST['texto'];
    $imagen = $foto->subirFoto('blog');
    
    $datos = $actualizar->actualizarPost($id, $titulo, $fecha, $texto, $imagen);
    if ($datos === false) {
      $datos = 'El registro no se ha actualizado';
      $_SESSION['error'] = $datos;
      header('Location: formEditarPost.php');
    }
    if ($datos === 'Registro actualizado') {
      $_SESSION['editado'] = 'El registro ha sido actualizado';
      header('Location: ../adminBlog.php');
    }
  }
}else{
  header('Location: ../../');
}
