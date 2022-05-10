<?php
// Inicio de sesión
session_start();

// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

  // Carga de archivos necesarios
  include("../../config/funcionesAlquileres.php");
  include("../../config/funcion_generica.php");
  include("../../config/funcionesSanearValidar.php");

  // Se ha apretado el botón de actualizar
  if (empty($_POST['actualizar'])) {
    // Si error de campos vacíos, reenvío al formulario
    $_SESSION['error'] = 'No se pueden enviar datos vacios';
    header('Location: formEditarAlquiler.php');
  } else {
    // En caso de apretar el botón de actualizar creación de variables
    $actualizar = new FuncionesAlquileres;
    $foto = new Generica;
    $sanea_valida = new FuncionesSaneaValida;

    $id = $_POST['id'];
    $_SESSION['id_edicion'] = $id;

    $error_refA = $error_localidadA = $error_metrosA = $error_telefonoA = '';
    if (!isset($_POST['referencia'])) {
      $error_refA = "El campo referencia no puede estar vacío";
    } else {
      $referencia = $sanea_valida->sanearNombre($_POST['referencia']);
      if (!empty($sanea_valida->validaLongitud($referencia, 3, 25, 'referencia'))) {
        $error_refA = $sanea_valida->validaLongitud($referencia, 3, 25, 'referencia');
      }
    }
    if (!isset($_POST['localidad'])) {
      $error_localidadA = "El campo localidad no puede estar vacío";
    } else {
      $localidad = $sanea_valida->sanearNombre($_POST['localidad']);
      if (!empty($sanea_valida->validaLongitud($localidad, 3, 50, 'localidad'))) {
        $error_localidadA = $sanea_valida->validaLongitud($localidad, 3, 50, 'localidad');
      }
    }
    if (!isset($_POST['metros'])) {
      $error_metrosA = "El campo metros no puede estar vacío";
    } else {
      if (!empty($sanea_valida->validaNumero($_POST['metros']))) {
        $error_metrosA = 'Metros. ' . $sanea_valida->validaNumero($_POST['metros']);
      }
    }
    if (!isset($_POST['telefono'])) {
      $error_telefonoA = "El campo teléfono no puede estar vacío";
    } else {
      if (!empty($sanea_valida->validaTfn($_POST['telefono']))) {
        $error_telefonoA = $sanea_valida->validaTfn($_POST['telefono']);
      }
    }
   
    $metros = $_POST['metros'];
    $imagen = $foto->subirFoto('alquileres');
    $telefono = $_POST['telefono'];
    $activa = $_POST['activa'];

    if ($error_refA == "" && $error_localidadA == "" && $error_metrosA == "" && $error_telefonoA == "") {
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
    } else {
      /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
            * página del formulario
            */
            if (isset($error_refA) && !empty($error_refA)) {
              $_SESSION['error_refA'] = $error_refA;
          }
          if (isset($error_localidadA) && !empty($error_localidadA)) {
              $_SESSION['error_localidadA'] = $error_localidadA;
          }
          if (isset($error_metrosA) && !empty($error_metrosA)) {
              $_SESSION['error_metrosA'] = $error_metrosA;
          }
          if (isset($error_telefonoA) && !empty($error_telefonoA)) {
              $_SESSION['error_telefonoA'] = $error_telefonoA;
          }
          header('Location: formEditarAlquiler.php');
    }
  }
  // Si no existe usuario o rol
} else {
  header('Location: ../../');
}
