<?php
// Iniciamos la sesion 
session_start();
/**Comrpobamos si existe el usuario y si existe el rol de usuario. Pueden entrar en esta zona tanto admiistrador 
* como el usuario.
*/
if (isset($_SESSION['usuario']) && (isset($_SESSION['rol']))) {

    // Archivos necesarios
    include('../template/headerS.php');
    include '../config/funcionesProductos.php';

    // Instanciamos la clase
    $pedidos = new Funciones;

    // Asignamos valores
    $id = $_SESSION['id'];

    // Consultamos base de datos
    $resultado = $pedidos->consultaPedidosAll($id);
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
                        <td scope="row"><a href="pedidos_detallados.php?pedido=<?php echo $resultados['id_pedido']?>"><?php echo $resultados['id_pedido'] ?></a></td>
                        <td><?php echo $resultados['precio_total'] ?> €</td>
                        <td><?php echo date( 'd-m-Y',strtotime($resultados['fecha'])) ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <a href="../perfil.php" class="btn btn-info" role="button">Volver a perfil</a>
    </div>
<?php
    include("../template/footer.php");
} else {
    // No estamos logueados
    header('Location: ../../');
}
?>