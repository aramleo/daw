<?php
// Inicio de sesión
session_start();

// Comrprobamos usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol']) {

    // Comrpuebo variables y añado a la cesta si existe. Si no, se crea
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
    // Decodifico string json
    echo json_encode($datos);
} else {
    // No está logueado
    header('Location: ./');
}
