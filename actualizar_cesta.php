<?php
// Iniciamos sesión
session_start();
// Comrpobamos si existe usuario y rol
if (isset($_SESSION['usuario']) && $_SESSION['rol']) {
    include 'config/funcionesProductos.php';

    // Agregamos el id y la cantidad del producto a la cesta
    function agregar($id, $cantidad)
    {
        $respuesta = 0;
        // Comrpobamos los valores recibidos por parámetros
        if ($id > 0 && $cantidad > 0 && is_numeric($cantidad)) {
            if (isset($_SESSION['cesta']['productos'][$id])) {
                // Si exite la cesta añadimos productos
                $_SESSION['cesta']['productos'][$id] = $cantidad;
                $datos = new Funciones;
                $recibo = $datos->actualizar_cesta($id);
                $precio = $recibo['precio'];
                $respuesta = $precio * $cantidad;
                return $respuesta;
            }
        } else {
            // Devuelve 0 o cesta vacía
            return $respuesta;
        }
    }
    // Si hemos recibido la variable post
    if (isset($_POST['action'])) {
        // Al recibir la cadena decodificamos el valor recibido mediante ajax
        $action = json_decode($_POST['action']);
        $id = isset($_POST['id']) ? json_decode($_POST['id']) : 0;
        // Si recibimos el valor actualizar
        if (isset($_POST['action']) == 'actualizar') {
            $cantidad = isset($_POST['cantidad']) ? json_decode($_POST['cantidad']) : 0;
            $result = agregar($id, $cantidad);
            if ($result > 0) {
                // Si han resultado validos los valores
                $datos['ok'] = true;
            } else {
                // No se han recibido valores
                $datos['ok'] = false;
            }
            // Campo subtotal
            $datos['sub'] = number_format($result, 2, '.', ',');
        }else {
            // En caso de fallo
            $datos['ok'] = false;
        }
    } else {
        // En caso de fallo
        $datos['ok'] = false;
    }
    // Imrpimimos en pantalla a través de la función ajax el valor
    echo json_encode($datos);
} else {
    // No está logueado
    header('Location: ./');
}
