<?php
// Iniciamos la sesion 
session_start();
// Comrpobamos si existe el usuario y si existe el rol de usuario. Pueden entrar en esta zona tanto admiistrador 
// como el usuario.
if (isset($_SESSION['usuario']) && (isset($_SESSION['rol']))) {
    include("../template/cabecera2.php");
    include("../../config/funcionesUsuarios.php");
    include '../../config/funcionesProductos.php';
    $pedidos = new Funciones;
    $num_pedido = $_GET['pedido'];
    $resultados = $pedidos->consultarDetallePedidosNombre($num_pedido);
?>
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
        <a href="pedidos_usuarios.php?id=<?php echo $_SESSION['id_usuario_pedido'] ?>" class="btn btn-info" role="button">Volver a pedidos</a>
    </div>
<?php
    include("../template/pie.php");
} else {
    header('Location: ../../');
}
?>