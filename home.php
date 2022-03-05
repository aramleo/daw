<?php

    require_once("admin/config/funciones.php");
    use admin\config\Clase;

    // filtramos los campos que vienen del formulario de login.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $comprobarUsuario = new Clase\Funciones();

    // comprobamos que no está vacio y es válido.
    if (!empty($email) && !empty($password) && $comprobarUsuario->comprobarUsuario($email) == 1) {
        session_start();
        $_SESSION["email"]  = $email;
        setcookie('email', $email);
        $_SESSION["password"] = $password;
        setcookie('password', $password);
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