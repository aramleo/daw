<?php

include('template/header.php');
if (isset($_SESSION['usuario']) && $_SESSION['rol'] == 'user'){ 
    echo 'Esta es la página de descargas';
}