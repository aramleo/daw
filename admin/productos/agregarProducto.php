<?php

session_start();

include ("../../config/funcionesProductos.php");


if(empty($_POST['nombre']) || empty($_POST['referencia']) || empty($_POST['precio']) || empty($_POST['cantidad']) || empty($_POST['agregar'])){
    $envio= 'No se pueden enviar datos vacios';
    $_SESSION['error']=$envio;
    header('Location: formAgregar.php');
}else{
    $nombre = $_POST['nombre'];
    $referencia = $_POST['referencia'];
    $precio = $_POST['precio'];
    $cantidad= $_POST['cantidad'];
    $agregar = new Funciones;
    $resultados = $agregar->agregar($nombre, $referencia, $precio, $cantidad);
    if($resultados == 23000){
        $envio = 'Registro duplicado';
        $_SESSION['error']= $envio;
        // header('Location: formAgregar.php');
    }else{
        $_SESSION['registro']='Registro insertado';
        header('Location: formAgregar.php');
    }
}
?>