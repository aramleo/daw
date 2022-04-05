<?php

/**
 * Archivo donde se reciben los datos del formulario de cambio de password y se realizan las
 * operaciones de validación y saneamiento, devolviendo los errores o el acierto de la 
 * operación. 
 */
// Inicia session
session_start();

// Comprobamos si existe session de usuario y rol
if (isset($_SESSION['usuario']) && ($_SESSION['rol'])) {
    // Cargamos los archivos necesarios 
    include '../config/funcionesPerfil.php';
    include '../config/funcionesSanearValidar.php';
    // Si hemos pulsado el botón guardar
    if (isset($_POST['guardar'])) {
        $id = $_SESSION['id'];
        // Llamando a la clase FuncionesSaneaValida
        $llamada = new FuncionesSaneaValida;
        // Vaciando las variables
        $error_old_password = $error_password = '';

        $old_password = $llamada->sanearPassword($_POST['old_password']);
        // Validar el password actual
        if (!empty($llamada->soloPassword($old_password))) {
            $error_old_password = $llamada->soloPassword($old_password);
        } else {
            // Comprobar si es correcto el password actual
            $comprobar = new FuncionesPerfil;
            $comprobado = $comprobar->comprobarOldPassword($id, $old_password);
            if ($comprobado != 1) {
                $error_old_password = 'El password actual no coincide';
            } else {
                // Sanear el password
                $nuevo_password = $llamada->sanearPassword($_POST['password']);
                $confirma = $llamada->sanearPassword($_POST['confirma']);
                // Validar el password
                if (!empty($llamada->validaPassword($nuevo_password, $confirma))) {
                    $error_password = $llamada->validaPassword($nuevo_password, $confirma);
                }
            }
        }
        // Comprueba si las dos variables no continen errores
        if ($error_old_password == "" && $error_password == "") {
            // Llamamos a la clase para el cambio de password al no presentarse errores de validación y saneamiento
            $perfil = new FuncionesPerfil;
            $datos = $perfil->cambioPassword($id, $nuevo_password);
            // Comrpobamos si se ha realizado el cambio
            if ($datos == "OK") {
                $_SESSION['exito_password'] = 'Se ha modificado correctamente';
                header('Location: formCambioPassword.php');
            } else {
                // Ha habido algún error al guardar en la base de datos
                $_SESSION['error_password'] = 'No ha sido posible modificar los datos';
                header('Location: formCambioPassword.php');
            }
        } else {
            // Comrpobando las varibles de error
            if (isset($error_old_password) && !empty($error_old_password)) {
                $_SESSION['error_old'] = $error_old_password;
            }
            if (isset($error_password) && !empty($error_password)) {
                $_SESSION['error_new'] = $error_password;
            }
            // Redirecciona a la página del formulario de cambio de password
            header('Location: formCambioPassword.php');
        }
    }
}
