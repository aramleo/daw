<?php

class Generica{


    public function __construct(){}


    public function subirFoto($var) {
        $carpeta = __DIR__.'/../img/'.$var.'/';
        $archivo = $carpeta.$_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'],$archivo);
        return $_FILES['imagen']['name'];
    }
}



?>