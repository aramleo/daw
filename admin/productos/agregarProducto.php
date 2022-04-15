<?php

session_start();
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

include ("../../config/funcionesProductos.php");
include ("../../config/funcion_generica.php");


if(empty($_POST['nombre']) || empty($_POST['referencia']) || empty($_POST['precio']) || empty($_POST['agregar'])){
    $envio= 'No se pueden enviar datos vacios';
    $_SESSION['error']=$envio;
    header('Location: formAgregar.php');
}else{
    $agregar = new Funciones;
    $foto = new Generica;
    $nombre = $_POST['nombre'];
    $referencia = $_POST['referencia'];
    $precio = str_replace(',','.',$_POST['precio']);
    $imagen= $foto->subirFoto('productos');
    $resultados = $agregar->agregar($nombre, $referencia, $precio, $imagen);
    if($resultados == 23000){
        $envio = 'Registro duplicado';
        $_SESSION['error']= $envio;
        // header('Location: formAgregar.php');
    }else{
        $_SESSION['registro']='Registro insertado';
        header('Location: formAgregar.php');
    }
}
}else{
    header('Location: ../../');
}
?>