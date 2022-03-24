<?php 
session_start();

include("../../config/funcionesAlquileres.php");

if(empty($_POST['actualizar'])){
  $_SESSION['error']= 'No se pueden enviar datos vacios';
  header('Location: formEditarAlquiler.php');
}else{
  $id=$_POST['id'];
  $referencia=$_POST['referencia'];
  $localidad=$_POST['localidad'];
  $metros=$_POST['metros'];
  $imagen = $_POST['imagen'];
  $telefono = $_POST['telefono'];
  $activa = $_POST['activa'];
  $actualizar = new FuncionesAlquileres;
  $datos = $actualizar->actualizar($id, $referencia, $localidad, $metros, $imagen, $telefono, $activa);
  if($datos === false){
    $datos = 'El registro no se ha actualizado';
    $_SESSION['error'] = $datos;
    header('Location: formEditarAlquiler.php');
  }
  if($datos === 'Registro actualizado'){
    $_SESSION['editado'] = 'El registro ha sido actualizado';
    header('Location: ../alquileres.php');
  }
}
