<?php
// Inicio de sesión
session_start();
// Comrpobando el usuario y el rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
  // Inclusión de los archivos necesarios
  include("../../config/funcionesProductos.php");
  include("../../config/funcion_generica.php");
  include("../../config/funcionesSanearValidar.php");

  // Comprobando si se ha enviado actualizar
  if (empty($_POST['actualizar'])) {
    $_SESSION['error'] = 'No se ha podido insertar los datos';
  } else {
    // Se han recibido los datos pulsando sobre el botón e instancia a la clase Funciones
    $actualizar = new Funciones;
    // Instancia a la clase Generica para guardar la imagen
    $foto = new Generica;
    $sanea_valida = new FuncionesSaneaValida;
    // Asingnación de variables
    $error_nombreP = $error_precioP = $error_refP = '';
    $id = $_POST['id'];
    $_SESSION['id_edicion'] = $id;
    if (!isset($_POST['nombre'])) {
      $error_nombreP = "El campo nombre no puede estar vacío";
      header('Location: formEditar.php');
    } else {
      $nombre = $sanea_valida->sanearNombre($_POST['nombre']);
      if (!empty($sanea_valida->validaLongitud($nombre, 3, 50, 'nombre de producto'))) {
        $error_nombreP = $sanea_valida->validaLongitud($nombre, 3, 50, 'nombre de producto');
      }
    }
    if (!isset($_POST['referencia'])) {
      $error_refP = "El campo referencia no puede estar vacío";
    } else {
      $referencia = $sanea_valida->sanearNombre($_POST['referencia']);
      if (!empty($sanea_valida->validaLongitud($referencia, 4, 20, 'referencia'))) {
        $error_refP = $sanea_valida->validaLongitud($referencia, 4, 20, 'referencia');
      }
    }
    if (!isset($_POST['precio'])) {
      $error_precioP = "El campo precio no puede estar vacío";
    } else {
      if (!empty($sanea_valida->validaNumero($_POST['precio']))) {
        $error_precioP = $sanea_valida->validaNumero($_POST['precio']);
      }
    }
    $precio = str_replace(',', '.', $_POST['precio']);
    // Enviando la foto para guardar una copia en la carpeta del producto
    $imagen = $foto->subirFoto('productos');
    $estado = $_POST['estado'];
    // Instancia a la clase Funciones
    $actualizar = new Funciones;
    // Guardando los datos en la base de datos
    if ($error_nombreP == "" && $error_refP == "" && $error_precioP == "") {
      $datos = $actualizar->actualizar($id, $nombre, $referencia, $precio, $imagen, $estado);
      // Comrpobando si ha sido actualizado o no
      if ($datos === false) {
        $datos = 'El registro no se ha actualizado';
        $_SESSION['error'] = $datos;
        header('Location: formEditar.php');
        
      }
      if ($datos === 'Registro actualizado') {
        $_SESSION['editado'] = 'El registro ha sido actualizado';
        header('Location: ../productos.php');
      }
    } else {
      /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
       * página del formulario
       */
      if (isset($error_nombreP) && !empty($error_nombreP)) {
        $_SESSION['error_nombreP'] = $error_nombreP;
      }
      if (isset($error_refP) && !empty($error_refP)) {
        $_SESSION['error_refP'] = $error_refP;
      }
      if (isset($error_precioP) && !empty($error_precioP)) {
        $_SESSION['error_precioP'] = $error_precioP;
      }
      header('Location: formEditar.php');
    }
  }
  // Redirección si no existe el usuario o el rol
} else {
  header('Location: ../../');
}
