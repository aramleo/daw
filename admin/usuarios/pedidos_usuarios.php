<?php
// Iniciamos la sesion 
session_start();
// Comrpobamos si existe el usuario y si existe el rol de usuario. Pueden entrar en esta zona tanto admiistrador 
// como el usuario.
if (isset($_SESSION['usuario']) && (isset($_SESSION['rol']))) {
    // Cargamos los archivos necesarios
    include("../template/cabecera2.php");
    include("../../config/funcionesUsuarios.php");
    include '../../config/funcionesProductos.php';
    // Instancia de la clase Funciones perteneciente a los productos y pedidos
    $pedidos = new Funciones;
    // Parámetro recibido por get. Id del usuario
    $id = $_GET['id'];
    // Se pasa el valor de id a una variable de session para poder utilizarla en otras páginas
    $_SESSION['id_usuario_pedido'] = $id;
    // Solicitando los datos de los pedidos según el id de pedido
    $resultado = $pedidos->consultaPedidosAll($id);
    // Si existen datos
    if(isset($resultado) && $resultado != null){
        ?>
    <div class="container">
        <!-- Tabla de datos de pedidos -->
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
        // En caso que el usuario no tenga pedidos
        echo '<p class="text-center fs-4 mt-3">El usuario seleccionado no tiene ningún pedido realizado.</p>';
    }
    ?>
    <!-- Botón para volver a la página anterior -->
    <div class="my-2">
        <a href="../usuarios.php" class="btn btn-info" role="button">Volver a usuarios</a>
    </div>
<?php
    include("../template/pie.php");

} else {
    // Si no existe usuario o rol
    header('Location: ../../');
}
?>