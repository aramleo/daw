<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol']) {
    include('template/header.php');

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        if (isset($_SESSION['cesta']['productos'][$id])) {
            $_SESSION['cesta']['productos'][$id] += 1;
        } else {
            $_SESSION['cesta']['productos'][$id] = 1;
        }
        $numero = count($_SESSION['cesta']['productos']);
        $datos['numero'] = $numero;
        $_SESSION['cesta']['productos']['cuenta']= $datos['numero'];
        $datos['ok'] = true;
    } else {
        $datos['ok'] = false;
    }
    $json = json_encode($datos);
    echo $json;
} else {
    header('Location: ./');
}
