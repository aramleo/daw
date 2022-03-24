<?php
//Valida y sanear registro.php
//Saneamiento..........................................................................
//eliminar los espacios en blanco antes y después de la cadena
function espacios($var) {
    $limpio = trim($var);
    return $limpio;
}

//elimina carácteres especiales
function especiales($var) {
    $especial = htmlentities($var);
    return $especial;
}

//convierte a minúsculas
function minus($var) {
    $minusculas = strtolower($var);
    $capitalizar = ucfirst($minusculas);
    return $capitalizar;
}

//aplica los cambios a los parámetros recibidos
function nombre(&$errores) {
    if(is_string($_POST['usuario'])){
        $sanNombre = $_POST['usuario'];
        especiales($sanNombre);
        espacios($sanNombre);
        minus($sanNombre);
        if($sanNombre === false || $sanNombre === null || strlen($sanNombre)<6){
            $errores['nombre'] = 'El nombre no es válido.';
        } else if (strlen($sanNombre) > 80) {
                $errores['nombre'] = 'El nombre es demasiado extenso.';
        }
    return $sanNombre;
    }    
}

function email(&$errores){
    if(isset($_POST['email'])){
        $sanEmail = $_POST['email'];
        $sanEmail = filter_var($sanEmail, FILTER_SANITIZE_EMAIL);
        $sanEmail = filter_var(strtolower($sanEmail), FILTER_VALIDATE_EMAIL);
        if(!$sanEmail){
            $errores['email'] = 'El correo electr&oacute;nico no es válido';
        }else if(strlen($sanEmail)>50){
            $errores['email'] = 'El correo electr&oacute;nico es demasiado extenso';
        }
    }
    return $sanEmail;
}


//Errores....................................................................................
//Errores del campo nombre
function validacion() {
    $retorno =[];
    if (count($_POST)>0) {
        $errores = [];
        $datos = [];
        //Sanea el nombre
        $sanNombre = nombre($errores);

        //Sanea el correo electrónico
        $sanEmail = email($errores);

        //valida del password
        if (!isset($_POST['password'])) {
            $errors['password'] = 'No se ha indicado la contrase&ntilde;a.';
        } elseif (!isset($_POST['confirmacion'])) {
            $errors['confirmacion'] = 'No se ha indicado la repetición de la contrase&ntilde;a.';
        } else {
            $password = trim($_POST['password']);
            $confirmacion = $_POST['confirmacion'];
            if (empty($password) || strlen($password) < 6) {
                $errors['password'] = 'La contrase&ntilde;a no es válidoa (tiene que tener una longitud mínima de 6).';
            }
            if ($password !== $confirmacion)
                $errors['confirmacion'] = 'La repetición de la contrase&ntilde;a no coincide.';
        }
        
        if(!$errores){
            $datos["nombre"] = $sanNombre;
            $datos["email"] = $sanEmail;
            $datos["password"] = $password;
        }
        $retorno = [$errores, $datos];
    }
    return $retorno;
}

function validacionEmail() {
    $retorno =[];
    if (count($_POST)>0) {
        $errores = [];
        $datos = [];
        
        //Sanea el correo electrónico
        $sanEmail = email($errores);

        //valida del password
        if (!isset($_POST['password'])) {
            $errors['password'] = 'No se ha indicado la contrase&ntilde;a.';
        } elseif (!isset($_POST['confirmacion'])) {
            $errors['confirmacion'] = 'No se ha indicado la repetición de la contrase&ntilde;a.';
        } else {
            $password = trim($_POST['password']);
            $confirmacion = $_POST['confirmacion'];
            if (empty($password) || strlen($password) < 6) {
                $errors['password'] = 'La contrase&ntilde;a no es válidoa (tiene que tener una longitud mínima de 6).';
            }
            if ($password !== $confirmacion)
                $errors['confirmacion'] = 'La repetición de la contrase&ntilde;a no coincide.';
        }
        
        if(!$errores){
            $datos["email"] = $sanEmail;
            $datos["password"] = $password;
        }
        $retorno = [$errores, $datos];
    }
    return $retorno;
}
