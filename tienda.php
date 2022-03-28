<?php

include('template/header.php');
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1')) {

    include 'config/funcionesProductos.php';
    $datos = new Funciones;
    $productos = $datos->consultar();

?>
    <h3 class="text-center pt-3">Tienda Online</h3>
    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-sm-7 col-md-8 col-lg-9"></div>
            <a href="cesta.php" class="btn btn-primary col-sm-5 col-md-4 col-lg-3">Cesta</a>
        </div>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($productos as $producto) { ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?php
                        $imagen = "img/productos/" . $producto->imagen;
                        if (!file_exists($imagen)) {
                            $imagen = "img/alquileres/noDisponible.jpg";
                        }
                        ?>
                        <img class="img-thumbnail img-fluid" src="<?php echo $imagen; ?>">
                        <div class="card-body">
                            <h5 class="card-title">Nombre: <?php echo strtoupper($producto->nombre); ?></h5>
                            <p class="card-text">Referencia: <?php echo strtoupper($producto->referencia); ?></p>
                            <p class="card-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z" />
                                </svg> <?php echo $producto->precio; ?>€</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="" class="btn btn-primary">Detalles</a>
                                </div>
                                <a href="" class="btn btn-success">Comprar</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    </div>
<?php
}
?>