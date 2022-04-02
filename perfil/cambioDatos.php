<?php
session_start();


print_r($_POST);
include '../config/funcionesPerfil.php';
include '../config/funcionesSanearValidar.php';

if (isset($_SESSION['usuario']) && ($_SESSION['rol'])) {

    if (isset($_POST['actualizar'])) {
        $llamada = new FuncionesSaneaValida;
        $error_nombre = $error_email = '';

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
            if(isset($error_nombre) && !empty($error_nombre)){
                $_SESSION['error_nombre'] = $error_nombre;
            }
            if(isset($error_email) && !empty($error_email)){
                $_SESSION['error_email'] = $error_email;
            }
            header('Location: formCambioDatos.php');
        }
    }
}
