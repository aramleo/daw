<?php

session_start();

include("../../config/funcionesAlquileres.php");


$id = $_GET['id'];
$borrar = new FuncionesAlquileres;
$elimina = $borrar->borrar($id);
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    header('Location: ../alquileres.php');
}

?>