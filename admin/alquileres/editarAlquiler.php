<?php 
session_start();

include("../config/funciones.php");

use admin\config\Clase;


if(empty($_POST['ID']) || empty($_POST['nombre']) || empty($_POST['estacion']) || empty($_POST['mes']) || empty($_POST['actualizar'])){
  $envio= 'No se pueden enviar datos vacios';
  $_SESSION['error']=$envio;
  header('Location: formEditar.php');
}else{
  $id=$_POST['ID'];
  $nombre=$_POST['nombre'];
  $estacion=$_POST['estacion'];
  $mes=$_POST['mes'];
  $imagen = $_POST['imagen'];
  $actualizar = new Clase\Funciones;
  $datos = $actualizar->actualizar($id, $nombre, $estacion, $mes, $imagen);
  if($datos === false){
    $datos = 'El registro no se ha actualizado';
    header('Location: formEditar.php');
    $_SESSION['error'] = $datos;
    header('Location: formAgregar.php');
  }
  if($datos === 'Registro actualizado'){
    $_SESSION['editado'] = 'El registro ha sido actualizado';
    header('Location: ../productos.php');
  }
}
