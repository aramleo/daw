<?php

// Inicio de sesión
session_start();

// Comprobación si existe el usuario y el rol
if (isset($_SESSION['usuario']) && ($_SESSION['rol'])) {

    // Inclusión de los archivos necesarios
    include '../config/funcionesPerfil.php';
    include '../config/funcionesSanearValidar.php';

    // Variable id del usuario
    $id_usuario = $_POST['id_usuario'];

    // Comrpobación de existencia de la variable POST del botón
    if (isset($_POST['guardado'])) {
        // Instancia de la clase para validar campos
        $llamada = new FuncionesSaneaValida;
        // Variables de errores
        $error_dni = $error_direccion = $error_otros = $error_localidad = $error_provincia = $error_cp = $error_telefono = '';
        // Comprobación de dni
        if (!isset($_POST['dni'])) {
            // Comprobación de la variable error del dni
            $error_dni = "El campo dni no puede estar vacío";
        } else {
            // Si todo correcto. Saneamiento y validación
            $dni = $llamada->espaciosBlanco($_POST['dni']);
            $dni = $llamada->magnus($dni);
            if (!empty($llamada->validaDni($dni))) {
                $error_dni = $llamada->validaDni($dni);
            }
        }
        // Si existe la variable sanear y validar
        if (!isset($_POST['direccion'])) {
            $error_direccion = "El campo dirección no puede estar vacío";
        } else {
            $direccion = $llamada->limpia_dir($_POST['direccion']);
            if (!empty($llamada->validaLongitud($direccion, 6, 100, 'Dirección'))) {
                $error_direccion = $llamada->validaLongitud($direccion, 6, 200, 'direccion');
            }
        }
        // Si existe la variable sanear y validar
        if (!isset($_POST['otros'])) {
            $error_otros = "El campo otros datos no puede estar vacío";
        } else {
            $otros = $llamada->limpia_dir($_POST['otros']);
            if (!empty($llamada->validaLongitud($otros, 0, 100, 'Otros datos'))) {
                $error_otros = $llamada->validaLongitud($direccion, 0, 100, 'Otros datos');
            }
        }
        // Si existe la variable sanear y validar
        if (!isset($_POST['localidad'])) {
            $error_localidad = "El campo localidad no puede estar vacío";
        } else {
            $localidad = $llamada->limpia_dir($_POST['localidad']);
            if (!empty($llamada->validaLongitud($localidad, 6, 100, 'Localidad'))) {
                $error_localidad = $llamada->validaLongitud($localidad, 6, 100, 'Localidad');
            }
        }
        // Si existe la variable sanear y validar
        if (!isset($_POST['provincia'])) {
            $error_provincia = "El campo provincia no puede estar vacío";
        } else {
            $provincia = $llamada->limpia_dir($_POST['provincia']);
            if (!empty($llamada->validaLongitud($provincia, 6, 50, 'Provincia'))) {
                $error_provincia = $llamada->validaLongitud($provincia, 6, 50, 'Provincia');
            }
        }
        // Si existe la variable sanear y validar
        if (!isset($_POST['cp'])) {
            $error_cp = "El campo código postal no puede estar vacío";
        } else {
            $cp = $llamada->espaciosBlanco($_POST['cp']);
            $cp = $llamada->caracterEspecial($cp);
            if (!empty($llamada->validaCp($cp))) {
                $error_cp = $llamada->validaCp($cp);
            }
        }
        // Si existe la variable sanear y validar
        if (!isset($_POST['telefono'])) {
            $error_telefono = "El campo teléfono no puede estar vacío";
        } else {
            $telefono = $llamada->espaciosBlanco($_POST['telefono']);
            $telefono = $llamada->caracterEspecial($telefono);
            if (!empty($llamada->validaTfn($telefono))) {
                $error_telefono = $llamada->validaTfn($telefono);
            }
        }
        // Si no existe nigún error en los valores, guardamos la información
        if ($error_dni == "" && $error_direccion == '' && $error_otros == '' && $error_localidad == '' && $error_provincia == '' && $error_cp == '' && $error_telefono == '') {
            $perfil = new FuncionesPerfil;
            $datos = $perfil->agregarDireccion($id_usuario, $dni, $direccion, $otros, $localidad, $provincia, $cp, $telefono);
            if ($datos == "1") {
                // Si el valor devuelto es igual a 1 
                $_SESSION['exito_direccion'] = 'Se ha modificado correctamente';
                header('Location: formDireccion.php');
            } elseif($datos == 23000){
                $_SESSION['error'] = 'El DNI no puede estar duplicado';
                header('Location: formDireccion.php');
            }else {
                $_SESSION['error'] = 'No ha sido posible guardar la dirección';
                header('Location: formDireccion.php');
            }
        } else {
            // Si existen errores, le damos el valor a una variable de sesion y se imprime en la página del formulario
            if (isset($error_dni) && !empty($error_dni)) {
                $_SESSION['error_dni'] = $error_dni;
            }
            if (isset($error_direccion) && !empty($error_direccion)) {
                $_SESSION['error_direccion'] = $error_direccion;
            }
            if (isset($error_otros) && !empty($error_otros)) {
                $_SESSION['error_otros'] = $error_otros;
            }
            if (isset($error_localidad) && !empty($error_localidad)) {
                $_SESSION['error_localidad'] = $error_localidad;
            }
            if (isset($error_provincia) && !empty($error_provincia)) {
                $_SESSION['error_provincia'] = $error_provincia;
            }
            if (isset($error_cp) && !empty($error_cp)) {
                $_SESSION['error_cp'] = $error_cp;
            }
            if (isset($error_telefono) && !empty($error_telefono)) {
                $_SESSION['error_telefono'] = $error_telefono;
            }
            header('Location: formDireccion.php');
        }
    }
}

?>
