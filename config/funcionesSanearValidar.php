<?php
class FuncionesSaneaValida
{
    public function __construct()
    {
    }
    // Funciones que sanean y devuelven un valor++++++++++++++++++++++++++
    /**
     * sanearNombre. Saneamiento del nombre
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
     * sanearEmail.- Saneamiento del email
     *
     * @param  mixed $var
     * @return void
     */
    public function sanearEmail($var)
    {
        $dato = filter_var(strtolower($var), FILTER_SANITIZE_EMAIL);
        return $dato;
    }


    public function sanearPassword($var)
    {
        $password = $this->espaciosBlanco($var);
        return $password;
    }

    //Funciones que realizan limpieza+++++++++++++++++
    /**
     * espaciosBlanco
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
     * minus.-convierte a minúsculas 
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

    // Funciones para validad los datos+++++++++++++++++++++

    public function validaNombre($var)
    {
        $error = null;
        if (strlen($var) < 6) {
            $error = 'El nombre debe ser mayor de 6 carácteres';
        }
        if (strlen($var) > 30) {
            $error = 'El nombre debe ser menor de 30 carácteres';
        }
        return $error;
    }


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
}
