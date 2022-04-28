<?php
// Inicio de sesión
session_start();
// Comrpobación usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
// Inclusión de los archivos necesarios
include ("../../config/funcionesServicios.php");
include ('../../config/funcion_generica.php');
// Si no se ha pulsado el botón agregar
if(empty($_POST['agregar'])){
    $envio= 'No se pueden enviar datos vacios';
    $_SESSION['error']=$envio;
    header('Location: formAgregarServicio.php');
}else{
/**
 *  Se ha pulsado el botón agregar y se procede a instanciar las clases necesarias para guardar los 
 * datos y la imagen 
 */ 

    $agregar = new FuncionesServicios;
    $foto = new Generica;
// Asignando valor a las variables
    $referencia = $_POST['referencia'];
    $servicio = $_POST['servicio'];
    $imagen= $foto->subirFoto('servicios');
    $activa= $_POST['activa'];
    //Guardado de datos en la base de datos
    $resultados = $agregar->agregar($referencia, $servicio, $imagen, $activa);
    // Error duplicado
    if($resultados == 23000){
        $envio = 'Registro duplicado';
        $_SESSION['error']= $envio;
    }else{
        // Se ha insertado correctamente
        $_SESSION['registro']='Registro insertado';
        header('Location: formAgregarServicio.php');
    }
}
}else{
    // No existe usuario o rol
    header('Location: ../../');
}