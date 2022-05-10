<?php
// Inicio de sesión
session_start();
// Comprobando el usuario y el rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    // Inclusión de archivos necesarios
    include("../../config/funcionesBlog.php");
    include("../../config/funcion_generica.php");
    include("../../config/funcionesSanearValidar.php");
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
        $sanea_valida = new FuncionesSaneaValida;

        // Variables
        $error_tituloB = $error_textoB = '';

        if (!isset($_POST['titulo'])) {
            $error_tituloB = "El campo titulo no puede estar vacío";
        } else {
            $titulo = $sanea_valida->espaciosBlanco($_POST['titulo']);
            $titulol = $sanea_valida->caracterEspecial($titulo);
            if (!empty($sanea_valida->validaLongitud($titulol, 3, 25, 'titulo'))) {
                $error_tituloB = $sanea_valida->validaLongitud($titulol, 3, 25, 'titulo');
            }
        }
        if (!isset($_POST['texto'])) {
            $error_tituloB = "El campo texto no puede estar vacío";
        } else {
            $texto = $sanea_valida->espaciosBlanco($_POST['texto']);
            $textol = $sanea_valida->caracterEspecial($texto);
            if (!empty($sanea_valida->validaLongitud($textol, 3, 10000, 'texto'))) {
                $error_tituloB = $sanea_valida->validaLongitud($textol, 3, 10000, 'texto');
            }
        }
        $fecha = $_POST['fecha'];
        $imagen = $generica->subirFoto('blog');
        // Agregando post
        if ($error_tituloB == "" && $error_textoB == "") {
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
        } else {
            /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
            * página del formulario
            */
            if (isset($error_tituloB) && !empty($error_tituloB)) {
                $_SESSION['error_tituloB'] = $error_tituloB;
            }
            if (isset($error_textoB) && !empty($error_textoB)) {
                $_SESSION['error_textoB'] = $error_textoB;
            }
            header('Location: formAgregarPost.php');
        }
    }
} else {
    header('Location: ../../');
}
