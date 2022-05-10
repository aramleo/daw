<?php
// Inicio de sesión
session_start();
// Comrpobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  // inclusión de archivos
  include("../../config/funcionesBlog.php");
  include("../../config/funcion_generica.php");
  include("../../config/funcionesSanearValidar.php");

  // Si no se ha recibido la variable POST actualizar
  if (empty($_POST['actualizar'])) {
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarPost.php');
  } else {
    // Instancia de clase
    $actualizar = new FuncionesBlog;
    // Instancia de clase para la foto
    $foto = new Generica;
    $sanea_valida = new FuncionesSaneaValida;

    // Variables
    $id = $_POST['id'];
    $_SESSION['id_edicion'] = $id;

    $error_tituloB = $error_textoB = '';

    if (!isset($_POST['titulo'])) {
      $error_tituloB = "El campo titulo no puede estar vacío";
    } else {
      $titulo = $sanea_valida->espaciosBlanco($_POST['titulo']);
      $titulol = $sanea_valida->caracterEspecial($titulo);
      if (!empty($sanea_valida->validaLongitud($titulol, 3, 25, 'titulo'))) {
        $error_tituloB = $sanea_valida->validaLongitud($titulol, 3, 25, 'titulo');
      }
    }
    if (!isset($_POST['texto'])) {
      $error_tituloB = "El campo texto no puede estar vacío";
    } else {
      $texto = $sanea_valida->espaciosBlanco($_POST['texto']);
      $textol = $sanea_valida->caracterEspecial($texto);
      if (!empty($sanea_valida->validaLongitud($textol, 3, 10000, 'texto'))) {
        $error_tituloB = $sanea_valida->validaLongitud($textol, 3, 10000, 'texto');
      }
    }
    $fecha = $_POST['fecha'];
    $imagen = $foto->subirFoto('blog');

    if ($error_tituloB == "" && $error_textoB == "") {
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
    } else {
      /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
            * página del formulario
            */
            if (isset($error_tituloB) && !empty($error_tituloB)) {
              $_SESSION['error_tituloB'] = $error_tituloB;
          }
          if (isset($error_textoB) && !empty($error_textoB)) {
              $_SESSION['error_textoB'] = $error_textoB;
          }
          header('Location: formEditarPost.php');
    }
  }
} else {
  // Error en la comprobación de usuario o rol
  header('Location: ../../');
}
