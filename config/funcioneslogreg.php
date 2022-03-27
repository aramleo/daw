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

    /**
     * comprobarSesion.- Comprueba si hay alguna sesión activa
     *
     * @return void
     */
    public function comprobarSesion() {
        
    }

    
    /**
     * registrarUsuario
     *
     * @param  mixed $email
     * @param  mixed $password
     * @return void
     */
    public function registrarUsuario($nombre, $email, $password) {
        $retorno = '';
        try {
            $sql = "INSERT INTO `usuario` (nombre,email,password) VALUES (:nombre, :email, SHA2(:password,0));";
            $query = $this->conexion -> prepare($sql);
            $query -> bindParam(':nombre', $nombre);
            $query -> bindParam(':email', $email);
            $query -> bindParam(':password', $password);
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
     * @return void
     */
    public function comprobarUsuario($email) {
        $sql = "SELECT * FROM `usuarios` WHERE email = :email;";
        $query = $this->conexion -> prepare($sql);
        $query -> bindParam(':email', $email);
        $query -> execute();
        // $result = $query -> fetchAll(PDO::FETCH_ASSOC);
        // return $result;
        return $query->rowCount();
    }
    
    /**
     * redireccion
     *
     * @param  mixed $url
     * @return void
     */
    public function redireccion($url) {
        header('Location: ' . $this->url . $url);
        die();
    }
    
    /**
     * logout
     *
     * @return void
     */
    public function logout() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION['email'] = null;
        $_SESSION['password'] = null;
        unset($_COOKIE['email']);
        unset($_COOKIE['password']);
        setCookie('email', "", time()-3600);
        setCookie('password', "", time()-3600);
    }
}