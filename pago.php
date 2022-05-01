<?php
// Iniciamos sesión
session_start();

// Comrpobamos usuario y rol
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1')) {
    // Cargamos los archivos necesarios 
    include('template/header.php');
    include 'config/funcionesProductos.php';

    // Llamamos a la clase Funciones del archivo funcionesPorductos.php
    $datos = new Funciones;
    $lista_cesta = array();
    $productos_cesta = isset($_SESSION['cesta']['productos']) ? $_SESSION['cesta']['productos'] : null;
    if ($productos_cesta != null) {
        foreach ($productos_cesta as $id_producto => $elementos) {
            $lista_cesta[] = $datos->consultar_cesta($id_producto, $elementos);
        }
    } else {
        header("Location: ./");
        exit;
    }
    // Ponemos el número de productos en la cesta
    $num_cesta = 0;
    if (isset($_SESSION['cesta']['productos'])) {
        $num_cesta = count($_SESSION['cesta']['productos']);
    }
?>
    <div class="pb-5">
        <div class="container">
            <div class="row my-2 visually-hidden">
                <div class="col-sm-7 col-md-8 col-lg-9">
                </div>
                <a href="cesta_prod.php" class="btn btn-primary col-sm-5 col-md-4 col-lg-3">
                    Cesta <span id="num_pro" class="badge bg-secondary"><?php if (isset($num_cesta)) {
                                                                            echo $num_cesta;
                                                                        } ?></span></a>
            </div>
            <div class="row my-5">
                <div class="col-6">
                    <h4>Detalles del pago</h4>
                    <div class="">
                        <i class="bi bi-cash-coin"></i>
                        <div class="card-body">
                            <h4 class="card-title">Pago por transferencia</h4>
                            <p class="card-text">Debe realizar el pago por transferencia y mandar a nuestro
                                correo una prueba de la realización. En cuanto se compruebe el pago, se le enviarán
                                los productos.</p>
                            <p>Nuestra cuenta es Banco Mibanco IBAN 00 0000 0000 00 0000000000.</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table" id="cesta">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Subtotal</th>
                                </tr>
                            <tbody>
                                <?php
                                if ($lista_cesta == null) {
                                    echo '<tr><td colspan="5" class="text-center"><b>Lista vacía</b></td></tr>';
                                } else {
                                    $total = 0;
                                    foreach ($lista_cesta as $agregado) {
                                        $id = $agregado['id'];
                                        $nombre = $agregado['nombre'];
                                        $precio = $agregado['precio'];
                                        $cantidad_pro = $agregado['cantidad_pro'];
                                        $subtotal = $precio * $cantidad_pro;
                                        $total += $subtotal;
                                ?>
                                        <tr>
                                            <td><?php echo $nombre; ?></td>
                                            <td>
                                                <div id="subtotal_<?php echo $id; ?>" name="subtotal[]">
                                                    <?php echo number_format($subtotal, 2, '.', ','); ?> €
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                            <p class="h3 text-end" id="total"><?php echo number_format($total, 2, ',', '.'); ?> €</p>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php
                                }
                        ?>
                        </thead>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            // Si la cesta contiene datos
            if ($lista_cesta != null) {
                $_SESSION['lista'] = $lista_cesta;
                $_SESSION['total'] = $total;
            ?>
                <div class="row">
                    <div class="col-md-5 offset-md-7 d-grid gap-2">
                        <a href="confirmo.php" class="btn btn-primary btn-lg">Confirmar</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php
    include 'template/footer.php';
} else {
    // No está logueado
    header("Location: ./");
}
?>