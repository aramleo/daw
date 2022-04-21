<?php
session_start();

if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1')) {
    include('template/header.php');
    include 'config/funcionesServicios.php';
    $datos = new FuncionesServicios;
    $servicios = $datos->consultarServicios();

?>
    <div class="pb-5">
        <h3 class="text-center pt-3 mt-5">Servicios prestados</h3>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($servicios as $servicio) { ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <?php
                            $imagen = "img/servicios/" . $servicio->imagen;
                            if (empty($servicio->imagen)) {
                                $imagen = "img/sin_foto.jpg";
                            }
                            ?>
                            <img class="img-thumbnail img-fluid" src="<?php echo $imagen; ?>">
                            <div class="card-body">
                                <h5 class="card-title">Referencia: <?php if(isset($servicio->referencia) && $servicio->referencia != null){echo strtoupper($servicio->referencia);} ?></h5>
                                <p class="card-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-fill" viewBox="0 0 16 16">
                                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z" />
                                        <path d="M3.5 1h.585A1.498 1.498 0 0 0 4 1.5V2a1.5 1.5 0 0 0 1.5 1.5h5A1.5 1.5 0 0 0 12 2v-.5c0-.175-.03-.344-.085-.5h.585A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1Z" />
                                    </svg> <?php if(isset($servicio->servicio) && $servicio->servicio != null){echo $servicio->servicio;} ?></a></p>
                                <p class="card-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                    </svg> +34 955 545 555</p><!-- El teléfono es el de la empresa pues hace de intermediario-->
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
    include 'template/footer.php';
}else{
    header("Location: ./");
}
?>