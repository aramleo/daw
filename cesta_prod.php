<?php
// Iniciamos sesión
session_start();

// Comprobamos usuario y rol
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
    }
    // Ponemos el número de productos en la cesta
    $num_cesta = 0;
    if (isset($_SESSION['cesta']['productos'])) {
        $num_cesta = count($_SESSION['cesta']['productos']);
    }
?>
<!-- Tabla con la cesta -->
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
                                $cantidad_pro = $agregado['cantidad_pro'];
                                $subtotal = $precio * $cantidad_pro;
                                $total += $subtotal;
                        ?>
                                <tr>
                                    <td><?php echo $nombre; ?></td>
                                    <td><?php echo number_format($precio, 2, '.', ','); ?> €</td>
                                    <td><input type="number" min="1" max="100" id="<?php echo $id; ?>" size="5" value="<?php echo $cantidad_pro; ?>" onchange="actualizar(this.value, <?php echo $id; ?>)">
                                    </td>
                                    <td>
                                        <div id="subtotal_<?php echo $id; ?>" name="subtotal[]">
                                            <?php echo number_format($subtotal, 2, '.', ','); ?> €
                                        </div>
                                    </td>
                                    <td><a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $id; ?>" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">
                                    <p class="h3" id="total"><?php echo number_format($total, 2, ',', '.'); ?> €</p>
                                </td>
                            </tr>
                    </tbody>
                <?php
                        }
                ?>
                </thead>
                </table>
            </div>
            <?php
            if ($lista_cesta != null) {
            ?>
                <div class="row">
                    <div class="col-md-5 offset-md-7 d-grid gap-2">
                        <a href="pago.php" class="btn btn-primary btn-md">Pagar compra</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Modal  de eliminiación de producto-->
    <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminaModalLabel">¿Quiere eliminar este producto de la cesta?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Atr&aacute;s</button>
                    <button id="btn-eliminar" type="button" onclick="eliminar()" class="btn btn-primary">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Funciones ajax -->
    <script>
        let eliminarModal = document.getElementById('eliminarModal');
        eliminarModal.addEventListener('show.bs.modal', function(event) {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            let buttonEliminar = eliminarModal.querySelector('.modal-footer #btn-eliminar')
            buttonEliminar.value = id
        })
        
        /**
         * actualizar
         *
         * @return void
         */
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
                        let divsubtotal = document.getElementById('subtotal_' + id)
                        divsubtotal.innerHTML = datos['sub'] + ' €';
                        let total = 0.00;
                        let list = document.getElementsByName('subtotal[]');

                        for (let i = 0; i < list.length; i++) {
                            total += parseFloat(list[i].innerHTML.replace(/[,]/g, ''))
                        }
                        total = new Intl.NumberFormat('es-ES', {
                            minimumFractionDigits: 2
                        }).format(total);
                        document.getElementById('total').innerHTML = total + '<?php echo ' €' ?>'
                    }
                })
                .catch(function(err) {
                    console.log(err);
                });
        }
        
        /**
         * eliminar
         *
         * @return void
         */
        function eliminar() {

            let elimina = document.getElementById('btn-eliminar')
            let id = elimina.value

            const data = new FormData();
            data.append('action', 'eliminar');
            data.append('id', id);
            fetch('eliminar_cesta.php', {
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
                        location.reload();
                    }
                })
                .catch(function(err) {
                    console.log(err);
                });
        }
    </script>
<?php
    include 'template/footer.php';
}else{
    header("Location: ./");
}
?>