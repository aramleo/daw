<?php

session_start();

include("../config/funciones.php");


$id = $_GET['id'];
$borrar = new Funciones;
$elimina = $borrar->borrar($id);
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    print_r($_SESSION);
    header('Location: ../productos.php');
}

?>