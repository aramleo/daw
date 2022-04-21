<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1')) {

    if (isset($_SESSION['lista']) && isset($_SESSION['total'])) {

        $datos = $_SESSION['lista'];
        $id_usuario = $_SESSION['id'];
        $precio_total = $_SESSION['total'];
        $id_pedido = $id_usuario . str_replace(".", "", $precio_total) . date('Ymd');


        include 'config/funcionesProductos.php';

        $confirmo = new Funciones;
        $pedido = $confirmo->guardar_pedido($id_pedido, $id_usuario, $precio_total);
        foreach ($datos as $dato) {
            $id_producto = $dato['id'];
            $precio = $dato['precio'];
            $cantidad = $dato['cantidad_pro'];
            $detalle_pedido = $confirmo->guardar_detalle_pedido($id_pedido, $id_producto, $precio, $cantidad);
        }
        if ($detalle_pedido) {
?>
            <div class="container">
                <h4>Gracias por su pedido</h4>
                <p>Su pedido va a ser procesado</p>
                <a href="tienda.php">Volver a la tienda</a>
            </div>
<?php
            unset($_SESSION['lista']);
            unset($_SESSION['total']);
            unset($_SESSION['cesta']['productos']);
            $id_pedido = '';
        } else {
            echo 'El pedido no ha podido ser procesado. Vuelva a intentarlo más tarde';
            ?>
            <a href="tienda.php">Volver a la tienda</a>
            <?php
        }
    }else{
        header('Location: tienda.php');
    }
} else {
    header("Location: ./");
}
