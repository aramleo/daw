<div class="container-fluid mt-5">
    <h4>Si quieres obtener tablas de cultivo y más información,
        <?php if (!isset($_SESSION['usuario'])) {
            echo '<a href="registro.php">regístrate</a>';
        } else {
            echo 'regístrate';
        } ?> y obtendrás acceso premium
    </h4>
    <div>
        <?php if (!isset($_SESSION['usuario'])) {?>
        <div class="row mt-md-5 m-auto">
            <div class="col-12 col-md-6 col-lg-3 g-3 g-lg-1"><a href="registro.php"><img class="d-block w-75 m-auto" src="img/calendario.jpg" alt="calendario de cultivo"></a></div>
            <div class="col-12 col-md-6 col-lg-3 g-3 g-lg-1"><a href="registro.php"><img class="d-block w-75 m-auto" src="img/siembra.jpg" alt="foto de siembra"></a></div>
            <div class="col-12 col-md-6 col-lg-3 g-3 g-lg-1"><a href="registro.php"><img class="d-block w-75 m-auto" src="img/julio2.jpg" alt="siembra en julio"></a></div>
            <div class="col-12 col-md-6 col-lg-3 g-3 g-lg-1"><a href="registro.php"><img class="d-block w-75 m-auto" src="img/siembraEnero.jpg" alt="siembra en enero"></a></div>
        </div>
        
        <?php 
        }
        ?>
    </div>

</div>