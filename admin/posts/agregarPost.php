<?php

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    include("../../config/funcionesBlog.php");


    if (empty($_POST['agregar'])) {
        $envio = 'No se pueden enviar datos vacios';
        $_SESSION['error'] = $envio;
        header('Location: formAgregarPost.php');
    } else {
        $titulo = $_POST['titulo'];
        $fecha = $_POST['fecha'];
        $texto = $_POST['texto'];
        $imagen = $_POST['imagen'];
        $agregar = new FuncionesBlog;
        $resultados = $agregar->agregarPost($titulo, $fecha, $texto, $imagen);
        if ($resultados == 23000) {
            $envio = 'Registro duplicado';
            $_SESSION['error'] = $envio;
        } else {
            $_SESSION['registro'] = 'Registro insertado';
            header('Location: formAgregarPost.php');
        }
    }
}else {
    header('Location: ../../');
}
