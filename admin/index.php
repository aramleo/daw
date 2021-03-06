<?php
// Inicio de sesión
session_start();
// Comprueba si existe la session de un usuario y si tiene el rol de administrador.
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == '1') {
    // incluyendo los archivos necesarios
    include('template/cabecera.php');
?>
    <div class="container-fluid mt-5 py-2">
        <div class="row justify-content-between">
            <div class="col-sm-4 gap-1 py-1">
                <div class="card">
                    <img src="../img/semillas.png" class="card-img-top img-thumbnail d-block w-100" alt="Icono de productos">
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <p class="card-text">Gestión de productos</p>
                        <a href="productos.php" class="btn btn-primary">Productos</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 gap-1 py-1">
                <div class="card">
                    <img src="../img/alquiler.png" class="card-img-top img-thumbnail d-block w-100" alt="Icono de alquileres">
                    <div class="card-body">
                        <h5 class="card-title">Alquileres</h5>
                        <p class="card-text">Gestión de alquileres</p>
                        <a href="alquileres.php" class="btn btn-primary">Alquileres</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 gap-1 py-1">
                <div class="card">
                    <img src="../img/user.png" class="card-img-top img-thumbnail d-block w-100" alt="Icono de usuario">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Gestión de usuarios</p>
                        <a href="usuarios.php" class="btn btn-primary">Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 gap-1 py-1">
                <div class="card">
                    <img src="../img/servicios.png" class="card-img-top img-thumbnail d-block w-100" alt="Icono de servicios">
                    <div class="card-body">
                        <h5 class="card-title">Servicios</h5>
                        <p class="card-text">Gestión de servicios</p>
                        <a href="serviciosAd.php" class="btn btn-primary">Servicios</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 gap-1 py-1">
                <div class="card">
                    <img src="../img/download.png" class="card-img-top img-thumbnail d-block w-100" alt="Icono de descarga">
                    <div class="card-body">
                        <h5 class="card-title">Descargas</h5>
                        <p class="card-text">Gestión de descargas</p>
                        <a href="descargasAd.php" class="btn btn-primary">Descargas</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 gap-1 py-1">
                <div class="card">
                    <img src="../img/blog.png" class="card-img-top img-thumbnail d-block w-100" alt="Icono de un blog">
                    <div class="card-body">
                        <h5 class="card-title">Blog</h5>
                        <p class="card-text">Gestión de blog</p>
                        <a href="adminBlog.php" class="btn btn-primary">Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include('template/pie.php');
} else {
    header('Location: ../');
}
?>