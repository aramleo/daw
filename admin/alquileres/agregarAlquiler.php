<?php

// Inicio de sesión
session_start();

// Comprobación de la sesión y el rol del usuario
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {

    // Inclusión de los archivos necesarios
    include("../../config/funcionesAlquileres.php");
    include("../../config/funcion_generica.php");
    include("../../config/funcionesSanearValidar.php");

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
        $sanea_valida = new FuncionesSaneaValida;

        $error_refA = $error_localidadA = $error_metrosA = $error_telefonoA = '';
        if (!isset($_POST['referencia'])) {
            $error_refA = "El campo referencia no puede estar vacío";
        } else {
            $referencia = $sanea_valida->sanearNombre($_POST['referencia']);
            if (!empty($sanea_valida->validaLongitud($referencia, 3, 25, 'referencia'))) {
                $error_refA = $sanea_valida->validaLongitud($referencia, 3, 25, 'referencia');
            }
        }
        if (!isset($_POST['localidad'])) {
            $error_localidadA = "El campo localidad no puede estar vacío";
        } else {
            $localidad = $sanea_valida->sanearNombre($_POST['localidad']);
            if (!empty($sanea_valida->validaLongitud($localidad, 3, 50, 'localidad'))) {
                $error_localidadA = $sanea_valida->validaLongitud($localidad, 3, 50, 'localidad');
            }
        }
        if (!isset($_POST['metros'])) {
            $error_metrosA = "El campo metros no puede estar vacío";
        } else {
            if (!empty($sanea_valida->validaNumero($_POST['metros']))) {
                $error_metrosA = 'Metros. ' . $sanea_valida->validaNumero($_POST['metros']);
            }
        }
        if (!isset($_POST['telefono'])) {
            $error_telefonoA = "El campo teléfono no puede estar vacío";
        } else {
            if (!empty($sanea_valida->validaTfn($_POST['telefono']))) {
                $error_telefonoA = $sanea_valida->validaTfn($_POST['telefono']);
            }
        }
        $metros = $_POST['metros'];
        $telefono = $_POST['telefono'];
        $imagen = $foto->subirFoto('alquileres');
        $activa = $_POST['activa'];

        if ($error_refA == "" && $error_localidadA == "" && $error_metrosA == "" && $error_telefonoA == "") {
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
        } else {
            /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
            * página del formulario
            */
            if (isset($error_refA) && !empty($error_refA)) {
                $_SESSION['error_refA'] = $error_refA;
            }
            if (isset($error_localidadA) && !empty($error_localidadA)) {
                $_SESSION['error_localidadA'] = $error_localidadA;
            }
            if (isset($error_metrosA) && !empty($error_metrosA)) {
                $_SESSION['error_metrosA'] = $error_metrosA;
            }
            if (isset($error_telefonoA) && !empty($error_telefonoA)) {
                $_SESSION['error_telefonoA'] = $error_telefonoA;
            }
            header('Location: formAgregarAlquiler.php');
        }
    }
} else {
    header('Location: ../../');
}
