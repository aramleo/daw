<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol']) {
    include 'config/funcionesProductos.php';

    // Decodifico el parametro persona que me envian

    function eliminar($id){
        if($id > 0){
            if (isset($_SESSION['cesta']['productos'][$id])) {
                unset($_SESSION['cesta']['productos'][$id]);
                
                return true;
            }
        }else{
            return false;
        }

    }

    if (isset($_POST['action'])) {

        $action = json_decode($_POST['action']);
        $id = isset($_POST['id']) ? json_decode($_POST['id']) : 0;

        if($_POST['action'] == 'eliminar'){
            $datos['ok'] = eliminar($id);
        }else {
            $datos['ok'] = false;
        }
    } else {
        $datos['ok'] = false;
    }

    echo json_encode($datos);
} else {
    header('Location: ./');
}
