<?php
// Incio de sesión
session_start();
// Comprobación de usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    // Inclusión de archivos necesarios
    include("../../config/funcionesDescargas.php");
    include("../../config/funcion_generica.php");
    include("../../config/funcionesSanearValidar.php");

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
        $sanea_valida = new FuncionesSaneaValida;

        // Variables
        $error_refD = $error_tituloD = $error_enlaceD = '';

        if (!isset($_POST['referencia'])) {
            $error_refD = "El campo referencia no puede estar vacío";
        } else {
            $referencia = $sanea_valida->sanearNombre($_POST['referencia']);
            if (!empty($sanea_valida->validaLongitud($referencia, 3, 25, 'referencia'))) {
                $error_refD = $sanea_valida->validaLongitud($referencia, 3, 25, 'referencia');
            }
        }
        if (!isset($_POST['titulo'])) {
            $error_tituloD = "El campo localidad no puede estar vacío";
        } else {
            $titulo = $sanea_valida->sanearNombre($_POST['titulo']);
            if (!empty($sanea_valida->validaLongitud($titulo, 5, 50, 'titulo'))) {
                $error_tituloD = $sanea_valida->validaLongitud($titulo, 5, 50, 'titulo');
            }
        }
        if (!isset($_POST['enlace'])) {
            $error_enlaceD = "El campo localidad no puede estar vacío";
        } else {
            $enlace = $sanea_valida->limpiarURL($_POST['enlace']);
            if (!empty($sanea_valida->validaLongitud($enlace, 5, 200, 'enlace'))) {
                $error_enlaceD = $sanea_valida->validaLongitud($enlace, 5, 200, 'enlace');
            }
        }

        $imagen = $foto->subirFoto('descargas');
        $activa = $_POST['activa'];

        if ($error_refD == "" && $error_tituloD == ""  && $error_enlaceD == "") {
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
        } else {
            /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
             * página del formulario
             */
            if (isset($error_refD) && !empty($error_refD)) {
                $_SESSION['error_refD'] = $error_refD;
            }
            if (isset($error_tituloD) && !empty($error_tituloD)) {
                $_SESSION['error_tituloD'] = $error_tituloD;
            }
            if (isset($error_enlaceD) && !empty($error_enlaceD)) {
                $_SESSION['error_enlaceD'] = $error_enlaceD;
            }
            header('Location: formAgregarDescarga.php');
        }
    }
} else {
    // En caso de no existir usuario y rol
    header('Location: ../../');
}
