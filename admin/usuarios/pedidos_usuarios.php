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
    $id = $_GET['id'];
    $_SESSION['id_usuario_pedido'] = $id;
    $resultado = $pedidos->consultaPedidosAll($id);
    if(isset($resultado) && $resultado != null){
        ?>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nº pedido</th>
                    <th>Importe total</th>
                    <th>Fecha del pedido</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($resultado as $resultados) {
                ?>
                    <tr>
                        <td scope="row"><a href="detalles_pedido_usuario.php?pedido=<?php echo $resultados['id_pedido']?>"><?php echo $resultados['id_pedido'] ?></a></td>
                        <td><?php echo $resultados['precio_total'] ?> €</td>
                        <td><?php echo date( 'd-m-Y',strtotime($resultados['fecha'])) ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }else{
        echo '<p class="text-center fs-4 mt-3">El usuario seleccionado no tiene ningún pedido realizado.</p>';
    }
    ?>
    <div class="my-2">
        <a href="../usuarios.php" class="btn btn-info" role="button">Volver a usuarios</a>
    </div>
<?php
    include("../template/pie.php");
} else {
    header('Location: ../../');
}
?>