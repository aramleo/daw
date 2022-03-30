<?php

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    include("../../config/funcionesDescargas.php");
    print_r($_POST);

    if (empty($_POST['agregar'])) {
        $envio = 'No se pueden enviar datos vacios';
        $_SESSION['error'] = $envio;
        header('Location: formAgregarDescarga.php');
    } else {
        $referencia = $_POST['referencia'];
        $titulo = $_POST['titulo'];
        $enlace = $_POST['enlace'];
        $imagen = $_POST['imagen'];
        $activa = $_POST['activa'];
        $agregar = new FuncionesDescargas;
        $resultados = $agregar->agregar($referencia, $titulo, $enlace, $imagen, $activa);
        if ($resultados == 23000) {
            $envio = 'Registro duplicado';
            $_SESSION['error'] = $envio;
        } else {
            $_SESSION['registro'] = 'Registro insertado';
            header('Location: formAgregarDescarga.php');
        }
    }
}else{
    header('Location: ../../');
}
