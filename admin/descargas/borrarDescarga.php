<?php

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    include("../../config/funcionesDescargas.php");


    $id = $_GET['id'];
    $borrar = new FuncionesDescargas;
    $elimina = $borrar->borrar($id);
    if ($elimina === 'Registro eliminado') {
        $_SESSION['eliminar'] = 'El registro se ha eliminado correctamente';
        header('Location: ../descargaAd.php');
    }
}else{
    header('Location: ../../');
}
