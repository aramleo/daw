<?php
// Inicio de sesión
session_start();
// Comrpobación si existe el usuario y el rol es igual a administrador
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

// Inclusión de los archivos necesarios
include ("../../config/funcionesProductos.php");
include ("../../config/funcion_generica.php");
include ("../../config/funcionesSanearValidar.php");

//Comprobando si están vacías las variables del array POST
if(empty($_POST['nombre']) || empty($_POST['referencia']) || empty($_POST['precio']) || empty($_POST['agregar'])){
    $envio= 'No se pueden enviar datos vacios';
    $_SESSION['error']=$envio;
    header('Location: formAgregar.php');
}else{
    // Las variables POST están con datos y se tratan
    // Llamada a la clase Funciones
    $agregar = new Funciones;
    // Instancia a la clase generica para guardar las fotos
    $foto = new Generica;
    $sanea_valida = new FuncionesSaneaValida;
    // Asignación de variables
    if(!isset($_POST['nombre'])){
        $error_nombreP = "El campo nombre no puede estar vacío";
    }else{
        $nombre = $sanea_valida->sanearNombre($_POST['nombre']);
        if (!empty($sanea_valida->validaLongitud($nombre,3,50,'nombre de producto'))) {
            $error_nombreP = $sanea_valida->validaLongitud($nombre,3,50,'nombre de producto');
        }
    }
    if(!isset($_POST['referencia'])){
        $error_refP = "El campo referencia no puede estar vacío";
    }else{
        $referencia = $sanea_valida->sanearNombre($_POST['referencia']);
        if (!empty($sanea_valida->validaLongitud($referencia,4,20,'referencia'))) {
            $error_refP = $sanea_valida->validaLongitud($referencia,4,20,'referencia');
        }
    }
    if(!isset($_POST['precio'])){
        $error_refP = "El campo precio no puede estar vacío";
    }else{
        $referencia = $sanea_valida->sanearNombre($_POST['precio']);
        if (!empty($sanea_valida->validaLongitud($referencia,4,20,'precio'))) {
            $error_refP = $sanea_valida->validaLongitud($referencia,4,20,'precio');
        }
    }

    $precio = str_replace(',','.',$_POST['precio']);
    $imagen= $foto->subirFoto('productos');
    $estado = $_POST['estado'];
    // Se agregan los datos a la base de datos
    $resultados = $agregar->agregar($nombre, $referencia, $precio, $imagen, $estado);
    // Registro duplicado
    if($resultados == 23000){
        $envio = 'Registro duplicado';
        $_SESSION['error']= $envio;
        header('Location: formAgregar.php');
    }else{
        // Registro insertado en la base de datos
        $_SESSION['registro']='Registro insertado';
        header('Location: formAgregar.php');
    }
}
}else{
    header('Location: ../../');
}
?>