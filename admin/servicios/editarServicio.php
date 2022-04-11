<?php 
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

include("../../config/funcionesServicios.php");
include ('../../config/funcion_generica.php');

if(empty($_POST['actualizar'])){
  $_SESSION['error']= 'No se pueden enviar datos vacios';
  header('Location: formEditarServicio.php');
}else{
  $agregar = new FuncionesServicios;
  $foto = new Generica;

  $id=$_POST['id'];
  $referencia=$_POST['referencia'];
  $servicio=$_POST['servicio'];
  $imagen= $foto->subirFoto('servicios');
  $activa = $_POST['activa'];
  
  $datos = $agregar->actualizar($id, $referencia, $servicio, $imagen, $activa);
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
