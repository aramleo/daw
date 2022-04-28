<?php
// Inicio de sesión
session_start();
// Comrpobación usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

// Inclusión de los archivos necesarios
include("../../config/funcionesServicios.php");

// Se recibe el parámetro via get
$id = $_GET['id'];
// Instancia de clase
$borrar = new FuncionesServicios;
// Borrado de datos
$elimina = $borrar->borrar($id);
// Registro eliminado
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    header('Location: ../serviciosAd.php');
}
}else{
    // No existe usuario o rol
    header('Location: ../../');
}

?>