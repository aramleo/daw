<?php

session_start();

include("../../config/funcionesProductos.php");


$id = $_GET['id'];
$borrar = new Funciones;
$elimina = $borrar->borrar($id);
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    header('Location: ../productos.php');
}

?>