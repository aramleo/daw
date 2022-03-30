<?php
/** 
 * Clase donde incluiremos las funciones concernientes a Login y Registro del usuario
 * 
 * */
require_once(__DIR__.'\conexion.php');

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
     * comprobarUsuario
     *
     * @param  mixed $email
     * @param  mixed $password
     * @return void
     */
    public function comprobarUsuario($email, $password) {
        $hash = $this->hash($password);
        $sql = "SELECT nombre, email, id_rol FROM usuario WHERE email = :email and password = :password";
        $query = $this->conexion -> prepare($sql);
        $query -> bindParam(':email', $email);
        $query -> bindParam(':password', $hash);
        $query -> execute();
        $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


    public function cambioEmail($id, $password) {
        $hash = $this->hash($password);
        $resultado = null;
        try{
            $sql = "UPDATE `usuario` SET password= :password WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':password', $hash);
            if($stmt ->execute()){
                $resultado = 'El password se ha cambiado';
            }else{
                $resultado = "El password no see ha cambiado";
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }
    
    // /**
    //  * redireccion
    //  *
    //  * @param  mixed $url
    //  * @return void
    //  */
    // public function redireccion($url) {
    //     header('Location: ' . $this->url . $url);
    //     die();
    // }
    
    // /**
    //  * logout
    //  *
    //  * @return void
    //  */
    // public function logout() {
    //     if (session_status() == PHP_SESSION_ACTIVE) {
    //         session_destroy();
    //     }
    //     $_SESSION['email'] = null;
    //     $_SESSION['password'] = null;
    //     unset($_COOKIE['email']);
    //     unset($_COOKIE['password']);
    //     setCookie('email', "", time()-3600);
    //     setCookie('password', "", time()-3600);
    // }

    public static function hash($password) {
        return hash('sha512', '34'.$password);
    }
}
