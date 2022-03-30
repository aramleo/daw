<?php

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    include("../../config/funcionesUsuarios.php");


    $id = $_GET['id'];
    $borrar = new FuncionesUsuarios;
    print_r($id);
    $elimina = $borrar->borrar($id);
    if ($elimina === 'Registro eliminado') {
        $_SESSION['eliminar'] = 'El registro se ha eliminado correctamente';
        header('Location: ../usuarios.php');
    }
}else{
    header('Location: ../../');
}
