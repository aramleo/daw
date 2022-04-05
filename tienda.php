<?php

include('template/header.php');
// require ('config/clave.php');
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1')) {

    include 'config/funcionesProductos.php';
    $datos = new Funciones;
    $productos = $datos->consultar();
    $cuenta = count($_SESSION['cesta']['productos']);
    echo $cuenta;
    // $token_tmp = hash_hmac('sha1', $id, KEY_CLAVE);
?>
    <h3 class="text-center pt-3">Tienda Online</h3>
    <div class="container">
        <div class="row my-4">
            <div class="col-sm-7 col-md-8 col-lg-9"></div>
            <a href="cesta.php" class="btn btn-primary col-sm-5 col-md-4 col-lg-3">
                Cesta<span id="num_pro" class="badge bg-secondary">3</span></a>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($productos as $producto) { ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?php
                        $id_producto = $producto->id;
                        $imagen = "img/productos/" . $producto->imagen;
                        if (!file_exists($imagen)) {
                            $imagen = "img/noDisponible.jpg";
                        }
                        ?>
                        <img class="img-thumbnail img-fluid d-block w-100" src="<?php echo $imagen; ?>">
                        <div class="card-body">
                            <h5 class="card-title">Nombre: <?php echo strtoupper($producto->nombre); ?></h5>
                            <p class="card-text">Referencia: <?php echo strtoupper($producto->referencia); ?></p>
                            <p class="card-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                                </svg> <?php echo $producto->precio; ?>€</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group"></div>
                                <button type="button" class="btn btn-success" onclick="adProducto(<?php echo $id_producto;?>)">Agregar a la cesta</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
        function adProducto(id){
            let url = 'cesta.php'
            let formData = new FormData()
            formData.append('id', id)

            fetch(url, {
                method: 'POST',
                body: formData,
                mode:'cors'
            })
            .then(response => response.json())
            .then(data => {
                // if(data.ok){
                   let elemento = document.getElementById("num_pro")
                   elemento.innerHTML = data.numero;
                // }
            })
        }
    </script>
            <?php } ?>
        </div>
    </div>
    </div>
<?php
    include 'template/footer.php';
}
?>