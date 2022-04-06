<?php

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    include("../../config/funcionesBlog.php");


    $id = $_GET['id'];
    $borrar = new FuncionesBlog;
    $elimina = $borrar->borrarPost($id);
    if ($elimina === 'Registro eliminado') {
        $_SESSION['eliminar'] = 'El registro se ha eliminado correctamente';
        header('Location: ../adminPost.php');
    }
}else{
    header('Location: ../../');
}
