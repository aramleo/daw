<?php 
session_start();

include("../../config/funcionesProductos.php");


if(empty($_POST['actualizar'])){
  $_SESSION['error']='No se ha podido insertar los datos';
}else{
  $id=$_POST['id'];
  $nombre=$_POST['nombre'];
  $referencia=$_POST['referencia'];
  $precio=$_POST['precio'];
  $cantidad = $_POST['cantidad'];
  $actualizar = new Funciones;
  $datos = $actualizar->actualizar($id, $nombre, $referencia, $precio, $cantidad);
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
