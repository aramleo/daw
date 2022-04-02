<?php
class FuncionesSaneaValida
{
    public function __construct()
    {
    }
    // Funciones que sanean y devuelven un valor++++++++++++++++++++++++++
    /**
     * sanearNombre. Saneamiento del nombre. Elimina espacios en blanco, carácteres especiales y 
     * cambia todo a misnusculas y posteriormente cambia a mayúsculas las letra iniciales de cada 
     * palabra
     *
     * @param  mixed $var
     * @return void
     */
    public function sanearNombre($var)
    {
        $dato = $this->espaciosBlanco($var);
        $dato = $this->caracterEspecial($dato);
        $dato = $this->minus($dato);
        return $dato;
    }

    /**
     * sanearEmail.- Saneamiento del email con el filtro de saneamiento
     *
     * @param  mixed $var
     * @return void
     */
    public function sanearEmail($var)
    {
        $dato = filter_var(strtolower($var), FILTER_SANITIZE_EMAIL);
        return $dato;
    }

    
    /**
     * sanearPassword. Elimina los espacios en blanco al principio y al final
     *
     * @param  mixed $var
     * @return void
     */
    public function sanearPassword($var)
    {
        $password = $this->espaciosBlanco($var);
        return $password;
    }

    //Funciones que realizan limpieza+++++++++++++++++
    /**
     * espaciosBlanco. Elimina los espacios en blanco iniciales y finales.
     *
     * @param  mixed $var
     * @return void
     */
    public function espaciosBlanco($var)
    {
        $dato = trim($var);
        return $dato;
    }

    /**
     * caracterEspecial.-elimina carácteres especiales
     *
     * @param  mixed $var
     * @return void
     */
    public function caracterEspecial($var)
    {
        $especial = htmlentities($var);
        return $especial;
    }

    /**
     * minus.-convierte a minúsculas y posteriormente pasa a mayúsculas las letras iniciales de cada palabra
     *
     * @param  mixed $var
     * @return void
     */
    public function minus($var)
    {
        $minusculas = strtolower($var);
        $capitalizar = ucwords($minusculas);
        return $capitalizar;
    }

    // Funciones para validar los datos que devuelven los errores+++++++++++++++++++++
    
    /**
     * validaNombre.- Valida el nombre que sea mayor que 6 y menor que 30 carácteres el nombre.
     *
     * @param  mixed $var
     * @return void
     */
    public function validaNombre($var)
    {
        $error = null;
        if (strlen($var) < 6) {
            $error = 'El nombre debe ser mayor de 6 carácteres';
        }
        if (strlen($var) > 100) {
            $error = 'El nombre debe ser menor de 100 carácteres';
        }
        return $error;
    }

    
    /**
     * validaEmail.- Valida que el email sea válido y que tenga la longitud adecuada
     *
     * @param  mixed $var
     * @return void
     */
    public function validaEmail($var)
    {
        $error = null;
        if (!filter_var($var, FILTER_VALIDATE_EMAIL)) {
            $error = "$var no es un email válido";
        }
        if (strlen($var) > 80) {
            $error = 'El email debe ser menor de 80 carácteres';
        }

        return $error;
    }
    
    /**
     * validaPassword. Comrpueba si el password y la confirmación son iguales y si cumplen 
     * el mínimo de carácteres
     *
     * @param  mixed $var
     * @param  mixed $var1
     * @return void
     */
    public function validaPassword($var, $var1)
    {
        $error = null;
        if (empty($var) || strlen($var) < 8) {
            $error = 'El password no es válido (tiene que tener una longitud mínima de 8).';
        } else {
            if ($var !== $var1) {
                $error = 'La repetición del password no coincide.';
            }
        }
        return $error;
    }
    
    /**
     * soloPassword. Solo comprueba la longitud del password y que no esté vacío. Si no cumple
     * devuelve un error.
     *
     * @param  mixed $var
     * @return void
     */
    public function soloPassword($var)
    {
        $error = null;
        if (empty($var) || strlen($var) < 8) {
            $error = 'El password no es válido (tiene que tener una longitud mínima de 8).';
        } 
        return $error;
    }
}
