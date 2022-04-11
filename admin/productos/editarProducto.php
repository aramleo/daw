<?php 
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

include("../../config/funcionesProductos.php");
include("../../config/funcion_generica.php");


if(empty($_POST['actualizar'])){
  $_SESSION['error']='No se ha podido insertar los datos';
}else{
  $actualizar = new Funciones;
  $foto = new Generica;
  $id=$_POST['id'];
  $nombre=$_POST['nombre'];
  $referencia=$_POST['referencia'];
  $precio=$_POST['precio'];
  $cantidad = $_POST['cantidad'];
  $imagen = $foto->subirFoto('productos');
  $actualizar = new Funciones;
  $datos = $actualizar->actualizar($id, $nombre, $referencia, $precio, $cantidad, $imagen);
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

}else{
  header('Location: ../../');
}
