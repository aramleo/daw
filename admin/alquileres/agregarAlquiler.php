<?php

session_start();

include ("../../config/funcionesAlquileres.php");
print_r($_POST);

if(empty($_POST['agregar'])){
    $envio= 'No se pueden enviar datos vacios';
    $_SESSION['error']=$envio;
    header('Location: formAgregarAlquiler.php');
}else{
    $referencia = $_POST['referencia'];
    $localidad = $_POST['localidad'];
    $metros = $_POST['metros'];
    $imagen= $_POST['imagen'];
    $telefono= $_POST['telefono'];
    $activa= $_POST['activa'];
    $agregar = new FuncionesAlquileres;
    $resultados = $agregar->agregar($referencia, $localidad, $metros, $imagen, $telefono, $activa);
    if($resultados == 23000){
        $envio = 'Registro duplicado';
        $_SESSION['error']= $envio;
        // header('Location: formAgregar.php');
    }else{
        $_SESSION['registro']='Registro insertado';
        header('Location: formAgregarAlquiler.php');
    }
}