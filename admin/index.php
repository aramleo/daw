<?php
include('template/cabecera.php');
?>
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="../img/semillas.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text">Un texto de ejemplo rápido para colocal cerca del título de la tarjeta y componer la mayor parte del contenido de la tarjeta.</p>
                    <a href="productos.php" class="btn btn-primary">Productos</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="../img/alquiler.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Alquileres</h5>
                    <p class="card-text">Un texto de ejemplo rápido para colocal cerca del título de la tarjeta y componer la mayor parte del contenido de la tarjeta.</p>
                    <a href="alquileres/alquileres.php" class="btn btn-primary">Alquileres</a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="../img/user.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Un texto de ejemplo rápido para colocal cerca del título de la tarjeta y componer la mayor parte del contenido de la tarjeta.</p>
                    <a href="usuarios/usuarios.php" class="btn btn-primary">Usuarios</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

include('template/pie.php');

?>