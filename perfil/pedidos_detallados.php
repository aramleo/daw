<?php
// Iniciamos la sesion 
session_start();
/**Comrpobamos si existe el usuario y si existe el rol de usuario. Pueden entrar en esta zona 
 * tanto el administrador como el usuario.
*/
if (isset($_SESSION['usuario']) && (isset($_SESSION['rol']))) {
    // Archivos necesarios
    include('../template/headerS.php');
    include '../config/funcionesProductos.php';
    // Instanciamos la clase
    $pedidos = new Funciones;
    // Asginamos valor a la varirable
    $num_pedido = $_GET['pedido'];
    // Consultamos la base de datos
    $resultados = $pedidos->consultarDetallePedidosNombre($num_pedido);
?>
<!-- Imrpimimos por pantalla los valores -->
    <div class="container">
        <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultados as $datos) {
                ?>
                    <tr>
                        <td scope="row"><?php echo $datos['nombre'] ?></td>
                        <td><?php echo $datos['precio_unitario'] ?>€</td>
                        <td><?php echo $datos['cantidad'] ?></td>
                        <td><?php echo $datos['cantidad']*$datos['precio_unitario'] ?>€</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        </div>
        <a href="pedidos.php" class="btn btn-info" role="button">Volver a pedidos</a>
    </div>
<?php
    include("../template/footer.php");
} else {
    // No estamos logueados
    header('Location: ../../');
}
?>