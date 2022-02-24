<?php

session_start();

include 'config/conexion.php';
include 'config/funciones.php';

if(empty($_POST['nombre']) || empty($_POST['estacion']) || empty($_POST['agregar'])){
    $resultados= 'No se pueden enviar datos vacios';
    $_SESSION['error']=$resultados;
    header('Location: formAgregar.php');
}else{
    $nombre = $_POST['nombre'];
    $estacion = $_POST['estacion'];
    $agregar = new Funciones();
    $resultados = $agregar->agregar($conn, $nombre, $estacion);
    if($resultados){
        $_SESSION['error']=$resultados;
        header('Location: formAgregar.php');
    }    
}
?>