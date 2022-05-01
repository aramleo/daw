<?php
// Iniciamos sesión
session_start();
// Comrpobamos usuario y rol
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1')) {
    // Insertamos cabecera
    include('template/header.php');
    // Archivo con la clase FuncionesAlquileres
    include 'config/funcionesAlquileres.php';
    // Instanciamos
    $datos = new FuncionesAlquileres;
    // Recuperamos datos con la consulta sobre alquileres
    $alquileres = $datos->consultarAlquiler();

?>
<!-- Sección donde se presentan los alquileres -->
    <div class="pb-5">
        <h3 class="text-center pt-3 mt-5">Alquileres de huertos</h3>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($alquileres as $alquiler) { ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <?php
                            $imagen = "img/alquileres/" . $alquiler->imagen;
                            if (empty($alquiler->imagen)) {
                                $imagen = "img/sin_foto.jpg";
                            }
                            ?>
                            <img class="img-thumbnail img-fluid d-block w-100" src="<?php echo $imagen; ?>">
                            <div class="card-body">
                                <h5 class="card-title">Referencia: <?php if(isset($alquiler->referencia) && $alquiler->referencia != null){ echo strtoupper($alquiler->referencia);} ?></h5>
                                <p class="card-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z" />
                                        <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z" />
                                    </svg> <a href="https://www.google.es/maps/place/<?php echo $alquiler->localidad; ?>" target="_blank" style="text-decoration:none"><?php if(isset($alquiler->localidad) && $alquiler->localidad != null){ echo $alquiler->localidad;} ?></a></p>
                                <p class="card-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bounding-box-circles" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM0 2a2 2 0 0 1 3.937-.5h8.126A2 2 0 1 1 14.5 3.937v8.126a2 2 0 1 1-2.437 2.437H3.937A2 2 0 1 1 1.5 12.063V3.937A2 2 0 0 1 0 2zm2.5 1.937v8.126c.703.18 1.256.734 1.437 1.437h8.126a2.004 2.004 0 0 1 1.437-1.437V3.937A2.004 2.004 0 0 1 12.063 2.5H3.937A2.004 2.004 0 0 1 2.5 3.937zM14 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM2 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm12 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                    </svg></img> <?php if(isset($alquiler->metros) && $alquiler->metros != null){ echo $alquiler->metros;} ?> m2</p>
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
    // No estamos logueados
    header("Location: ./");
}
?>