<?php

include('template/header.php');
if (isset($_SESSION['usuario']) && ($_SESSION['rol'] == 'user' || $_SESSION['rol'] == 'admin' )){ 
    echo 'Esta es la página de descargas';
}