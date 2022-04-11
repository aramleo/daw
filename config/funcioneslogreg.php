<?php
/** 
 * Clase donde incluiremos las funciones concernientes a Login y Registro del usuario
 * 
 * */
require_once(__DIR__.'/conexion.php');

class FuncionesLogReg{
    
    /**
     * __construct.- Constructor de la clase FuncionesLogReg
     *
     * @return void
     */
    public function __construct(){
        $bd = new Conexion();
        $this->conexion = $bd->conexion();
    }

    // /**
    //  * comprobarSesion.- Comprueba si hay alguna sesión activa
    //  *
    //  * @return void
    //  */
    // public function comprobarSesion() {
        
    // }

    
    /**
     * registrarUsuario
     *
     * @param  mixed $email
     * @param  mixed $password
     * @return void
     */
    public function registrarUsuario($nombre, $email, $password) {
        $retorno = '';
        $hash = $this->hash($password);
        try {
            $sql = "INSERT INTO `usuario` (nombre,email,password) VALUES (:nombre, :email, :password);";
            $query = $this->conexion -> prepare($sql);
            $query -> bindParam(':nombre', $nombre);
            $query -> bindParam(':email', $email);
            $query -> bindParam(':password', $hash);
            if($query -> execute()){
                $retorno = 2;
            }
        }catch(Exception $e){
            if($e->getCode()=="23000")
            $retorno = 3;
        }    
        return $retorno;  
    }
   
        
    /**
     * comprobarUsuario.- Comprueba si el usuario existe en la base de datos
     *
     * @param  mixed $email
     * @param  mixed $password
     * @return void
     */
    public function comprobarUsuario($email, $password) {
        $hash = $this->hash($password);
        $sql = "SELECT * FROM usuario WHERE email = :email and password = :password";
        $query = $this->conexion -> prepare($sql);
        $query -> bindParam(':email', $email);
        $query -> bindParam(':password', $hash);
        $query -> execute();
        $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    
    public static function hash($password) {
        return hash('sha512', '34'.$password);
    }
}
