<?php

/**
 * Generica. Se utiliza esta clase para guardar las fotos que el administrador sube a las
 * carpetas del proyecto de imágenes
 */
class Generica{

    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(){}

    
    /**
     * subirFoto. La imagen guardada en la carpeta temporal de files la copiamos a 
     * la carpeta correspondiente donde guardemos las imágenes. Le pasamos el valor
     * de la carpeta por parámetro.
     *
     * @param  mixed $var
     * @return void
     */
    public function subirFoto($var) {
        $carpeta = __DIR__.'/../img/'.$var.'/';
        $archivo = $carpeta.$_FILES['imagen']['name'];
        move_uploaded_file($_FILES['imagen']['tmp_name'],$archivo);
        return $_FILES['imagen']['name'];
    }
}



?>