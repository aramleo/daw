<?php
// Inicio de sesión
session_start();
// Comprobamos si existe session de usuario y rol
if (isset($_SESSION['usuario']) && ($_SESSION['rol'])) {
    // cargando los archivos necesarios
    include '../config/funcionesPerfil.php';
    include '../config/funcionesSanearValidar.php';
    // Si hemos hecho clic sobre el botón actualizar
    if (isset($_POST['actualizar'])) {
        // Instanciamos la clase
        $llamada = new FuncionesSaneaValida;
        // Reseteamos las variables
        $error_nombre = $error_email = '';

        // Comprobamos si existen las variables. Si es correcto saneamos y validamos 
        if (!isset($_POST['nombre'])) {
            $error_nombre = "El campo usuario no puede estar vacío";
        } else {
            $nombre = $llamada->sanearNombre($_POST['nombre']);
            if (!empty($llamada->validaNombre($nombre))) {
                $error_nombre = $llamada->validaNombre($nombre);
            }
        }
        if (!isset($_POST['email'])) {
            $error_nombre = "El campo email no puede estar vacío";
        } else {
            $email = $llamada->sanearEmail($_POST['email']);
            if (!empty($llamada->validaEmail($email))) {
                $error_email = $llamada->validaEmail($email);
            }
        }
        // Si los las variables de error están vacías, guardamos los datos
        if ($error_nombre == "" && $error_email == '') {
            $perfil = new FuncionesPerfil;
            $datos = $perfil->cambioDatos($_POST['id'], $nombre, $email);
            if ($datos == "OK") {
                $_SESSION['exito'] = 'Se ha modificado correctamente';
                header('Location: formCambioDatos.php');
            } else {
                $_SESSION['error'] = 'No ha sido posible modificar los datos';
                header('Location: formCambioDatos.php');
            }
        } else {
            /** Si no es correcto, guardamos el error en una variable de session para poder leerla en la 
            * página del formulario
            */
            if (isset($error_nombre) && !empty($error_nombre)) {
                $_SESSION['error_nombre'] = $error_nombre;
            }
            if (isset($error_email) && !empty($error_email)) {
                $_SESSION['error_email'] = $error_email;
            }
            header('Location: formCambioDatos.php');
        }
    }
}
