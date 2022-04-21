<?php

// Inicio de sesión
session_start();

// Comprobación de la sesión y el rol del usuario
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    // Inclusión de los archivos necesarios
    include("../../config/funcionesAlquileres.php");
    include("../../config/funcion_generica.php");
// Comprobación si see ha pulsado el botón agregar
    if (empty($_POST['agregar'])) {
        $envio = 'No se pueden enviar datos vacios';
        $_SESSION['error'] = $envio;
        // Redirección a formulario alquiler
        header('Location: formAgregarAlquiler.php');
    } else {
        // Variables
        $agregar = new FuncionesAlquileres;
        $foto = new Generica;
        $referencia = $_POST['referencia'];
        $localidad = $_POST['localidad'];
        $metros = $_POST['metros'];
        $imagen = $foto->subirFoto('alquileres');
        $telefono = $_POST['telefono'];
        $activa = $_POST['activa'];
        
        // Extracción de datos de la base de datos
        $resultados = $agregar->agregar($referencia, $localidad, $metros, $imagen, $telefono, $activa);
        // Solo se permite un alquiler con la misma referencia
        if ($resultados == 23000) {
            // En caso de registro duplicado
            $envio = 'Registro duplicado. Misma referencia';
            $_SESSION['error'] = $envio;
            header('Location: formAgregarAlquiler.php');
        } else {
            // En caso de éxito
            $_SESSION['registro'] = 'Registro insertado';
            header('Location: formAgregarAlquiler.php');
        }
    }
}else {
    header('Location: ../../');
}
