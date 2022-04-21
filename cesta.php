<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol']) {
    // Decodifico el parametro persona que me envian
    if (isset($_POST['id'])) {
        $producto = json_decode($_POST['id']);
        if(isset($_SESSION['cesta']['productos'][$producto])){
            $_SESSION['cesta']['productos'][$producto] += 1;
        }else{
            $_SESSION['cesta']['productos'][$producto] = 1;
        }
        $datos['numero'] = count($_SESSION['cesta']['productos']);
        $datos['ok']= true;
    }else{
        header('Location: tienda.php');
        $datos['ok']= false;
    }
    echo json_encode($datos);
} else {
    header('Location: ./');
}
