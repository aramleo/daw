<?php
// Inicio de sesión
session_start();
// Comprobando el usuario y el rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    // Inclusión de archivos necesarios
    include("../../config/funcionesBlog.php");
    include("../../config/funcion_generica.php");
    // En caso de no haber realizado los pasos correctamente
    if (empty($_POST['agregar'])) {
        $envio = 'No se pueden enviar datos vacios';
        $_SESSION['error'] = $envio;
        header('Location: formAgregarPost.php');
    } else {
        // Se ha recibido la variable POST agregar
        // Instancia
        $agregar = new FuncionesBlog;
        // Instancia para agregar imágenes
        $generica = new Generica;
        // Variables
        $titulo = $_POST['titulo'];
        $fecha = $_POST['fecha'];
        $texto = $_POST['texto'];
        $imagen = $generica->subirFoto('blog');
        // Agregando post
        $resultados = $agregar->agregarPost($titulo, $fecha, $texto, $imagen);
        // En caso de duplicación de registros
        if ($resultados == 23000) {
            $envio = 'Registro duplicado';
            $_SESSION['error'] = $envio;
            // Redirección a el formulario post
            header('Location: formAgregarPost.php');
        } else {
            // Si el registro es insertado la variable de sesión se rellena y redirecciona al formulario
            $_SESSION['registro'] = 'Registro insertado';
            header('Location: formAgregarPost.php');
        }
    }
}else {
    header('Location: ../../');
}
