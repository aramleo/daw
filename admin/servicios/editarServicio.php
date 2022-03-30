<?php 
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

include("../../config/funcionesServicios.php");

if(empty($_POST['actualizar'])){
  $_SESSION['error']= 'No se pueden enviar datos vacios';
  header('Location: formEditarServicio.php');
}else{
  $id=$_POST['id'];
  $referencia=$_POST['referencia'];
  $servicio=$_POST['servicio'];
  $imagen = $_POST['imagen'];
  $activa = $_POST['activa'];
  $actualizar = new FuncionesServicios;
  $datos = $actualizar->actualizar($id, $referencia, $servicio, $imagen, $activa);
  if($datos === false){
    $datos = 'El registro no se ha actualizado';
    $_SESSION['error'] = $datos;
    header('Location: formEditarServicio.php');
  }
  if($datos === 'Registro actualizado'){
    $_SESSION['editado'] = 'El registro ha sido actualizado';
    header('Location: ../serviciosAd.php');
  }
}
}else{
  header('Location: ../../');
}
