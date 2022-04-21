<?php
// Incio de sesión
session_start();
// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    // Inclusión de archivos necesarios
    include("../../config/funcionesDescargas.php");
    include("../../config/funcion_generica.php");

    // En caso de no apretar el botón de agregar descarga
    if (empty($_POST['agregar'])) {
        $envio = 'No se pueden enviar datos vacios';
        $_SESSION['error'] = $envio;
        header('Location: formAgregarDescarga.php');
    } else {
        // Se ha recibido la variablee POST agregar
        $agregar = new FuncionesDescargas;
        // Función con la que se guardan las fotos en un directorio
        $foto = new Generica;
        // Variables
        $referencia = $_POST['referencia'];
        $titulo = $_POST['titulo'];
        $enlace = $_POST['enlace'];
        $imagen = $foto->subirFoto('descargas');
        $activa = $_POST['activa'];
        
        // Agregación 
        $resultados = $agregar->agregar($referencia, $titulo, $enlace, $imagen, $activa);
        if ($resultados == 23000) {
            // En caso de registro duplicado por la referencia
            $envio = 'Registro duplicado. No puede tener la misma referencia';
            $_SESSION['error'] = $envio;
            header('Location: formAgregarDescarga.php');
        } else {
            // Si ha sido la agregación exitosa
            $_SESSION['registro'] = 'Registro insertado';
            header('Location: formAgregarDescarga.php');
        }
    }
}else{
    // En caso de no existir usuario y rol
    header('Location: ../../');
}
