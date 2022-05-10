<?php
// Inicio de sesión
session_start();
// Comrpobación usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
    // Inclusión de los archivos necesarios
    include("../../config/funcionesServicios.php");
    include('../../config/funcion_generica.php');
    include("../../config/funcionesSanearValidar.php");

    // Si no se ha pulsado el botón agregar
    if (empty($_POST['agregar'])) {
        $envio = 'No se pueden enviar datos vacios';
        $_SESSION['error'] = $envio;
        header('Location: formAgregarServicio.php');
    } else {
        /**
         *  Se ha pulsado el botón agregar y se procede a instanciar las clases necesarias para guardar los 
         * datos y la imagen 
         */

        $agregar = new FuncionesServicios;
        $foto = new Generica;
        $sanea_valida = new FuncionesSaneaValida;

        // Asignando valor a las variables
        $error_refS = $error_servicioS = '';

        if (!isset($_POST['referencia'])) {
            $error_refS = "El campo referencia no puede estar vacío";
        } else {
            $referencia = $sanea_valida->sanearNombre($_POST['referencia']);
            if (!empty($sanea_valida->validaLongitud($referencia, 3, 25, 'referencia'))) {
                $error_refS = $sanea_valida->validaLongitud($referencia, 3, 25, 'referencia');
            }
        }
        if (!isset($_POST['servicio'])) {
            $error_servicioS = "El campo localidad no puede estar vacío";
        } else {
            $servicio = $sanea_valida->sanearNombre($_POST['servicio']);
            if (!empty($sanea_valida->validaLongitud($servicio, 5, 50, 'servicio'))) {
                $error_servicioS = $sanea_valida->validaLongitud($servicio, 5, 50, 'servicio');
            }
        }
        $imagen = $foto->subirFoto('servicios');
        $activa = $_POST['activa'];

        if ($error_refS == "" && $error_servicioS == "") {
            //Guardado de datos en la base de datos
            $resultados = $agregar->agregar($referencia, $servicio, $imagen, $activa);
            // Error duplicado
            if ($resultados == 23000) {
                $envio = 'Registro duplicado';
                $_SESSION['error'] = $envio;
            } else {
                // Se ha insertado correctamente
                $_SESSION['registro'] = 'Registro insertado';
                header('Location: formAgregarServicio.php');
            }
        } else {
            /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
            * página del formulario
            */
            if (isset($error_refS) && !empty($error_refS)) {
                $_SESSION['error_refS'] = $error_refS;
            }
            if (isset($error_servicioS) && !empty($error_servicioS)) {
                $_SESSION['error_servicioS'] = $error_servicioS;
            }
            header('Location: formAgregarServicio.php');
        }
    }
} else {
    // No existe usuario o rol
    header('Location: ../../');
}
