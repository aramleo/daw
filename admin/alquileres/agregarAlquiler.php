<?php

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    include("../../config/funcionesAlquileres.php");
    include("../../config/funcion_generica.php");

    if (empty($_POST['agregar'])) {
        $envio = 'No se pueden enviar datos vacios';
        $_SESSION['error'] = $envio;
        header('Location: formAgregarAlquiler.php');
    } else {
        $agregar = new FuncionesAlquileres;
        $foto = new Generica;
        $referencia = $_POST['referencia'];
        $localidad = $_POST['localidad'];
        $metros = $_POST['metros'];
        $imagen = $foto->subirFoto('alquileres');
        $telefono = $_POST['telefono'];
        $activa = $_POST['activa'];
        
        $resultados = $agregar->agregar($referencia, $localidad, $metros, $imagen, $telefono, $activa);
        if ($resultados == 23000) {
            $envio = 'Registro duplicado';
            $_SESSION['error'] = $envio;
            // header('Location: formAgregar.php');
        } else {
            $_SESSION['registro'] = 'Registro insertado';
            header('Location: formAgregarAlquiler.php');
        }
    }
}else {
    header('Location: ../../');
}
