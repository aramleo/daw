<?php

include('template/header.php');
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == '2' || $_SESSION['rol'] == '1' )){ 
    echo 'Esta es la página de descargas';
}