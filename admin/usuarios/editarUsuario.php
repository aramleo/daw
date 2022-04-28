<?php
// Inicio de sesión
session_start();
// Comprobamos usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
// Inclusión de los archivos necesarios
include("../../config/funcionesUsuarios.php");

// Comrpobación del array POST
if(empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['rol']) || empty($_POST['actualizar'])){
  $envio= 'No se pueden enviar datos vacios';
  $_SESSION['error']=$envio;
  header('Location: formEditarUsuario.php');
}
else{
  // Asignación de variables
  $id=$_POST['id'];
  $nombre=$_POST['nombre'];
  $email=$_POST['email'];
  $rol=$_POST['rol'];
  // Instancia de la clase
  $actualizar = new FuncionesUsuarios;
  // Actualizar datos
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
