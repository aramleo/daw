<?php
// Inicio de sesión
session_start();
// Comrpobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
// inclusión de archivos
  include("../../config/funcionesBlog.php");
  include("../../config/funcion_generica.php");
// Si no se ha recibido la variable POST actualizar
  if (empty($_POST['actualizar'])) {
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarPost.php');
  } else {
    // Instancia de clase
    $actualizar = new FuncionesBlog;
    // Instancia de clase para la foto
    $foto = new Generica;
    // Variables
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];
    $texto = $_POST['texto'];
    $imagen = $foto->subirFoto('blog');
    // Actualizar los datos
    $datos = $actualizar->actualizarPost($id, $titulo, $fecha, $texto, $imagen);
    // No ha habido éxito en la operación
    if ($datos === false) {
      $datos = 'El registro no se ha actualizado';
      $_SESSION['error'] = $datos;
      header('Location: formEditarPost.php');
    }
    // Éxito en la ejecución
    if ($datos === 'Registro actualizado') {
      $_SESSION['editado'] = 'El registro ha sido actualizado';
      header('Location: ../adminBlog.php');
    }
  }
}else{
  // Error en la comprobación de usuario o rol
  header('Location: ../../');
}
