<?php 
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

include("../../config/funcionesUsuarios.php");


if(empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['rol']) || empty($_POST['actualizar'])){
  $envio= 'No se pueden enviar datos vacios';
  $_SESSION['error']=$envio;
  header('Location: formEditarUsuario.php');
}
else{
  $id=$_POST['id'];
  $nombre=$_POST['nombre'];
  $email=$_POST['email'];
  $rol=$_POST['rol'];
  $actualizar = new FuncionesUsuarios;
  $datos = $actualizar->actualizar($id, $nombre, $email, $rol);
  }
  if($datos === 'Registro actualizado'){
    $_SESSION['editado'] = 'El registro ha sido actualizado';
    header('Location: ../usuarios.php');
  }else{
    $_SESSION['error'] = $datos;
    header('Location: formEditarUsuario.php');
  }
}else{
  header('Location: ../../');
}
