<?php

include('template/header.php');
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == 'user' || $_SESSION['rol'] == 'admin')) {

    include 'config/funcionesAlquileres.php';
    $datos = new FuncionesAlquileres;
    $alquileres = $datos->consultarAlquiler();

?>
    <h3 class="text-center pt-3">Alquileres de huertos</h3>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($alquileres as $alquiler) { ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <?php
                        $imagen = "img/alquileres/" . $alquiler->imagen;
                        if (!file_exists($imagen)) {
                            $imagen = "img/alquileres/noDisponible.jpg";
                        }
                        ?>
                        <img class="img-thumbnail img-fluid" src="<?php echo $imagen; ?>">
                        <div class="card-body">
                            <h5 class="card-title">Referencia: <?php echo strtoupper($alquiler->referencia); ?></h5>
                            <p class="card-text">Localidad: <a href="https://www.google.es/maps/place/<?php echo $alquiler->localidad; ?>" target="_blank" style="text-decoration:none"><?php echo $alquiler->localidad; ?></a></p>
                            <p class="card-text">Metros: <?php echo $alquiler->metros; ?> m2</p>
                            <p class="card-text">Teléfono: +34 <?php echo $alquiler->telefono; ?></p>
                            <!-- <div class="d-flex justify-content-between align-items-center">
                            </div> -->
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