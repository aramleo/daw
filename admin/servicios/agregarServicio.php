<?php

session_start();
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

include ("../../config/funcionesServicios.php");
print_r($_POST);

if(empty($_POST['agregar'])){
    $envio= 'No se pueden enviar datos vacios';
    $_SESSION['error']=$envio;
    header('Location: formAgregarServicio.php');
}else{
    $referencia = $_POST['referencia'];
    $servicio = $_POST['servicio'];
    $imagen= $_POST['imagen'];
    $activa= $_POST['activa'];
    $agregar = new FuncionesServicios;
    $resultados = $agregar->agregar($referencia, $servicio, $imagen, $activa);
    if($resultados == 23000){
        $envio = 'Registro duplicado';
        $_SESSION['error']= $envio;
    }else{
        $_SESSION['registro']='Registro insertado';
        header('Location: formAgregarServicio.php');
    }
}
}else{
    header('Location: ../../');
}