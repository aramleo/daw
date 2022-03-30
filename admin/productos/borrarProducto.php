<?php

session_start();
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

include("../../config/funcionesProductos.php");


$id = $_GET['id'];
$borrar = new Funciones;
$elimina = $borrar->borrar($id);
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    header('Location: ../productos.php');
}
}else{
    header('Location: ../../');
}

?>