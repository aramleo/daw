<?php

session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    include("../../config/funcionesDescargas.php");
    include("../../config/funcion_generica.php");

    if (empty($_POST['agregar'])) {
        $envio = 'No se pueden enviar datos vacios';
        $_SESSION['error'] = $envio;
        header('Location: formAgregarDescarga.php');
    } else {
        $agregar = new FuncionesDescargas;
        $foto = new Generica;

        $referencia = $_POST['referencia'];
        $titulo = $_POST['titulo'];
        $enlace = $_POST['enlace'];
        $imagen = $foto->subirFoto('descargas');
        $activa = $_POST['activa'];
        
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
