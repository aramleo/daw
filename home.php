<?php

    require_once("admin/config/funciones.php");
    use admin\config\Clase;

    // filtramos los campos que vienen del formulario de login.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $comprobarUsuario = new Clase\Funciones();

    $message = "";

    // comprobamos que no está vacio y es válido.
    if (!empty($email) && !empty($password) && $comprobarUsuario->comprobarUsuario($email)[1] == 1) {
        $comprobarPassword = $comprobarUsuario->comprobarUsuario($email)[0];
        if (password_verify($password, $comprobarPassword['password'])) {
            session_start();
            $_SESSION["email"]  = $email;
            setcookie('email', $email);
            $_SESSION["password"] = $password;
            setcookie('password', $password);
        } else {
            $message = "Contraseña inválida!!!";
        }
    } else if ($comprobarUsuario->comprobarUsuario($email)[1] == 0) {
        $message = 'Usuario no válido!!!';  
    } else if (empty($email) || empty($password)) {
        if (empty($email)) {
            $message .= "Email vacio!!!";
        }
        if (empty($password)) {
            $message .= " Contraseña vacia!!!";
        }
    }
    setcookie('message', trim($message));
    $_COOKIE['message'] = trim($message);
    if (!empty($_COOKIE['message'])) {
        $comprobarUsuario->redireccion('login.php');
    }
    include("template/header.php");
    if ($comprobarUsuario->comprobarSesion()) {
?>
    <div>
        <h1>Inicio</h1>
        <div>Contenido página.</div>
    </div>
<?php
    } else {
?>
    <div>
        <div>403</div>
        <div>No te está permitido visualizar esta página.</div>
    </div>
<?php
    }

?>