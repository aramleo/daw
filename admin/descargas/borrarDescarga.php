<?php

session_start();

include("../../config/funcionesDescargas.php");


$id = $_GET['id'];
$borrar = new FuncionesDescargas;
$elimina = $borrar->borrar($id);
if($elimina === 'Registro eliminado'){
    $_SESSION['eliminar']= 'El registro se ha eliminado correctamente';
    header('Location: ../descargaAd.php');
}

?>