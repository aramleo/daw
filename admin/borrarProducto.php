<?php

session_start();

include('template/cabecera.php');
include("config/funciones.php");

use admin\config\Clase;

$id = $_GET['id'];
$borrar = new Clase\Funciones;
$elimina = $borrar->borrar($id);
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    print_r($_SESSION);
    header('Location: productos.php');
}


include ('template/pie.php');

?>