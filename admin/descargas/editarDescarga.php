<?php
// Inicio de sesión
session_start();
// Comrpobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  // Inclusión de los archivos necesarios
  include("../../config/funcionesDescargas.php");
  include("../../config/funcion_generica.php");
  include("../../config/funcionesSanearValidar.php");

  // En caso de no recibir la variable POST actualizar
  if (empty($_POST['actualizar'])) {
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarDescarga.php');
    // Se ha recibido la varible correctamente
  } else {
    // Instanciando
    $actualizar = new FuncionesDescargas;
    $sanea_valida = new FuncionesSaneaValida;
    // Función para guardar la imagen en una carpeta
    $foto = new Generica;
    // Variables asignación


    $id = $_POST['id'];
    $_SESSION['id_edicion'] = $id;

    $error_refD = $error_tituloD = $error_enlaceD = '';

    if (!isset($_POST['referencia'])) {
      $error_refD = "El campo referencia no puede estar vacío";
    } else {
      $referencia = $sanea_valida->sanearNombre($_POST['referencia']);
      if (!empty($sanea_valida->validaLongitud($referencia, 3, 25, 'referencia'))) {
        $error_refD = $sanea_valida->validaLongitud($referencia, 3, 25, 'referencia');
      }
    }
    if (!isset($_POST['titulo'])) {
      $error_tituloD = "El campo localidad no puede estar vacío";
    } else {
      $titulo = $sanea_valida->sanearNombre($_POST['titulo']);
      if (!empty($sanea_valida->validaLongitud($titulo, 5, 50, 'titulo'))) {
        $error_tituloD = $sanea_valida->validaLongitud($titulo, 5, 50, 'titulo');
      }
    }
    if (!isset($_POST['enlace'])) {
      $error_enlaceD = "El campo localidad no puede estar vacío";
    } else {
      $enlace = $sanea_valida->limpiarURL($_POST['enlace']);
      if (!empty($sanea_valida->validaLongitud($enlace, 5, 200, 'enlace'))) {
        $error_enlaceD = $sanea_valida->validaLongitud($enlace, 5, 200, 'enlace');
      }
    }

    $imagen = $foto->subirFoto('descargas');
    $activa = $_POST['activa'];

    if ($error_refD == "" && $error_tituloD == ""  && $error_enlaceD == "") {
      // Agregación 
      $datos = $actualizar->actualizar($id, $referencia, $titulo, $enlace, $imagen, $activa);
      if ($datos === false) {
        $datos = 'El registro no se ha actualizado';
        $_SESSION['error'] = $datos;
        header('Location: formEditarDescarga.php');
      }
      // En caso de éxito
      if ($datos === 'Registro actualizado') {
        $_SESSION['editado'] = 'El registro ha sido actualizado';
        header('Location: ../descargasAd.php');
      }
    } else {
      /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
       * página del formulario
       */
      if (isset($error_refD) && !empty($error_refD)) {
        $_SESSION['error_refD'] = $error_refD;
      }
      if (isset($error_tituloD) && !empty($error_tituloD)) {
        $_SESSION['error_tituloD'] = $error_tituloD;
      }
      if (isset($error_enlaceD) && !empty($error_enlaceD)) {
        $_SESSION['error_enlaceD'] = $error_enlaceD;
      }
      header('Location: formAgregarDescarga.php');
    }
  }
} else {
  // El usuario o rol no es correcto
  header('Location: ../../');
}
