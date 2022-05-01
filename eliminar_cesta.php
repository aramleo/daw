<?php
// Inicio de sesión
session_start();
// Comprobamos usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol']) {
    include 'config/funcionesProductos.php';

    // Elimino producto pasado por parámetro id de producto
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
    // Existe la variable action
    if (isset($_POST['action'])) {

        $action = json_decode($_POST['action']);
        // Si existe decodifica, si no el valor es 0
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
    // No está logueado
    header('Location: ./');
}
