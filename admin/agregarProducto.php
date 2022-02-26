<?php

session_start();

include 'config/conexion.php';
include 'config/funciones.php';

if(empty($_POST['nombre']) || empty($_POST['estacion']) || empty($_POST['agregar'])){
    $envio= 'No se pueden enviar datos vacios';
    $_SESSION['error']=$envio;
    header('Location: formAgregar.php');
}else{
    $nombre = $_POST['nombre'];
    $estacion = $_POST['estacion'];
    $agregar = new Funciones();
    $resultados = $agregar->agregar($conn, $nombre, $estacion);
    if($resultados == 23000){
        $envio = 'Registro duplicado';
        $_SESSION['error']=$envio;
        header('Location: formAgregar.php');
    }else{
        $_SESSION['registro']='Registro insertado';
        header('Location: formAgregar.php');
    }
}
?>