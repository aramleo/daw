<?php

session_start();

include('template/cabecera.php');
include("config/conexion.php");
include("config/funciones.php");


$id = $_GET['id'];
$borrar = new Funciones();
$elimina = $borrar->borrar($conn, $id);
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    print_r($_SESSION);
    header('Location: productos.php');
}


include ('template/pie.php');

?>