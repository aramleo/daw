<?php

session_start();

include("../../config/funcionesServicios.php");


$id = $_GET['id'];
$borrar = new FuncionesServicios;
$elimina = $borrar->borrar($id);
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    header('Location: ../serviciosAd.php');
}

?>