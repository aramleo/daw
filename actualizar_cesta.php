<?php
session_start();

if (isset($_SESSION['usuario']) && $_SESSION['rol']) {
    include 'config/funcionesProductos.php';
    // Decodifico el parametro persona que me envian
    function agregar($id, $cantidad)
    {
        $respuesta = 0;
        if ($id > 0 && $cantidad > 0 && is_numeric($cantidad)) {
            if (isset($_SESSION['cesta']['productos'][$id])) {
                $_SESSION['cesta']['productos'][$id] = $cantidad;
                $datos = new Funciones;
                $recibo = $datos->actualizar_cesta($id);
                $precio = $recibo['precio'];
                $respuesta = $precio * $cantidad;
                return $respuesta;
            }
        } else {
            return $respuesta;
        }
    }

    if (isset($_POST['action'])) {

        $action = json_decode($_POST['action']);
        $id = isset($_POST['id']) ? json_decode($_POST['id']) : 0;

        if (isset($_POST['action']) == 'actualizar') {
            $cantidad = isset($_POST['cantidad']) ? json_decode($_POST['cantidad']) : 0;
            $result = agregar($id, $cantidad);
            if ($result > 0) {
                $datos['ok'] = true;
            } else {
                $datos['ok'] = false;
            }
            $datos['sub'] = number_format($result, 2, '.', ',');
        } else {
            $datos['ok'] = false;
        }
    } else {
        $datos['ok'] = false;
    }

    echo json_encode($datos);
} else {
    header('Location: ./');
}
