<?php
// Inicio de sesión
session_start();
// Comprobar usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

// Inclusión de archivos necesarios
include("../../config/funcionesProductos.php");

// Recoge el valor pasado por get 
$id = $_GET['id'];
// Instancia a la clase Funciones
$borrar = new Funciones;
// Elimina el registro
$elimina = $borrar->borrar($id);
// Si es correcta la eliminación
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    header('Location: ../productos.php');
}
}else{
    header('Location: ../../');
}

?>