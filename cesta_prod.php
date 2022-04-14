<?php
session_start();
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1')) {
    // Cargamos los archivos necesarios 
    include('template/header.php');
    include 'config/funcionesProductos.php';

    // Llamamos a la clase Funciones del archivo funcionesPorductos.php
    $datos = new Funciones;
    $lista_cesta = array();
    $productos_carrito = isset($_SESSION['cesta']['productos']) ? $_SESSION['cesta']['productos'] : null;
    if ($productos_carrito != null) {
        foreach ($productos_carrito as $id_producto => $elementos) {
            $lista_cesta [] = $datos->consultar_cesta($id_producto, $elementos);
        }
    }
    // Ponemos el número de productos en la cesta
    $num_cesta = 0;
    if (isset($_SESSION['cesta']['productos'])) {
        $num_cesta = count($_SESSION['cesta']['productos']);
    }
?>
    <div class="pb-5">
        <div class="container">
            <div class="row my-2">
                <div class="col-sm-7 col-md-8 col-lg-9">
                </div>
                <a href="cesta_prod.php" class="btn btn-primary col-sm-5 col-md-4 col-lg-3">
                    Cesta <span id="num_pro" class="badge bg-secondary"><?php if (isset($num_cesta)) {
                                                                            echo $num_cesta;
                                                                        } ?></span></a>
            </div>
            <div class="table-responsive">
                <table class="table" id="cesta">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
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
                                $cantidad = $agregado['cantidad'];
                                $cantidad_pro = $agregado['cantidad_pro'];
                                $subtotal = $precio * $cantidad_pro;
                                $total += $subtotal;
                        ?>
                                <tr>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo number_format($precio, 2, '.', ','); ?> €</td>
                                    <td><input type="number" min="1" max="<?php echo $cantidad; ?>" id="<?php echo $id; ?>" size="5" value="<?php echo $cantidad_pro; ?>" onchange="actualizar(this.value, <?php echo $id; ?>)">                            
                                </td>
                                    <td>
                                        <div id="subtotal_<?php echo $id; ?>" name="subtotal[]">
                                            <?php echo number_format($subtotal, 2, '.', ','); ?> €
                                        </div>
                                    </td>
                                    <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $id; ?>" data-ds-toggle="modal" data-bs-target="eliminarModal">Eliminar</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2"><p class="h3"><?php echo number_format($total, 2, '.', ',');?> €</p></td>
                            </tr>
                    </tbody>
                <?php
                        }
                ?>
                </thead>
                </table>
            </div>
            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2">
                    <button class="btn btn-primary btn-lg-">Pagar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function actualizar(cantidad, id) {
            const data = new FormData();
            data.append('action', 'actualizar');
            data.append('cantidad', cantidad);
            data.append('id', id);
            fetch('actualizar_cesta.php', {
                    method: 'POST',
                    body: data
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.text()
                    } else {
                        throw "Error en la llamada Ajax";
                    }

                })
                .then(function(texto) {
                    datos = JSON.parse(texto);
                    console.log(datos);
                    if (datos['ok']) {
                        let divsubtotal = document.getElementById('subtotal_'+id)
                        divsubtotal.innerHTML = datos['sub'];
                    }
                })
                .catch(function(err) {
                    console.log(err);
                });
        }
    </script>
<?php
    include 'template/footer.php';
}
?>