<?php 
// Inicio de sesión
session_start();
// Comrpobando el usuario y el rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
// Inclusión de los archivos necesarios
include("../../config/funcionesProductos.php");
include("../../config/funcion_generica.php");

// Comprobando si se ha enviado actualizar
if(empty($_POST['actualizar'])){
  $_SESSION['error']='No se ha podido insertar los datos';
}else{
  // Se han recibido los datos pulsando sobre el botón e instancia a la clase Funciones
  $actualizar = new Funciones;
  // Instancia a la clase Generica para guardar la imagen
  $foto = new Generica;
  // Asingnación de variables
  $id=$_POST['id'];
  $nombre=$_POST['nombre'];
  $referencia=$_POST['referencia'];
  $precio= str_replace(',','.',$_POST['precio']);
  // Enviando la foto para guardar una copia en la carpeta del producto
  $imagen = $foto->subirFoto('productos');
  // Instancia a la clase Funciones
  $actualizar = new Funciones;
  // Guardando los datos en la base de datos
  $datos = $actualizar->actualizar($id, $nombre, $referencia, $precio, $imagen, $estado);
  // Comrpobando si ha sido actualizado o no
  if($datos === false){
    $datos = 'El registro no se ha actualizado';
    header('Location: formEditar.php');
    $_SESSION['error'] = $datos;
  }
  if($datos === 'Registro actualizado'){
    $_SESSION['editado'] = 'El registro ha sido actualizado';
    header('Location: ../productos.php');
  }
}
// Redirección si no existe el usuario o el rol
}else{
  header('Location: ../../');
}
