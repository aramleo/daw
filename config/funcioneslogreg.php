<?php

/** 
 * Clase donde incluiremos las funciones concernientes a Login y Registro del usuario
 * 
 * */
require_once(__DIR__ . '/conexion.php');

class FuncionesLogReg
{

    /**
     * __construct.- Constructor de la clase FuncionesLogReg
     *
     * @return void
     */
    public function __construct()
    {
        $bd = new Conexion();
        $this->conexion = $bd->conexion();
    }


    /**
     * registrarUsuario. Registro de un usuario nuevo. Se comprueba que no haya usuario 
     * duplicado
     *
     * @param  mixed $email
     * @param  mixed $password
     * @return void
     */
    public function registrarUsuario($nombre, $email, $password)
    {
        $retorno = '';
        $hash = $this->hash($password);
        try {
            $sql = "INSERT INTO `usuario` (nombre,email,password) VALUES (:nombre, :email, :password);";
            $query = $this->conexion->prepare($sql);
            $query->bindParam(':nombre', $nombre);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $hash);
            if ($query->execute()) {
                $retorno = 2;
            }
        } catch (Exception $e) {
            if ($e->getCode() == "23000")
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
    public function comprobarUsuario($email, $password)
    {
        $hash = $this->hash($password);
        $sql = "SELECT * FROM usuario WHERE email = :email and password = :password";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $hash);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    /**
     * email_reset. Comprobación de la existencia del email para resetear sobre la contraseña
     *
     * @param  mixed $email
     * @return void
     */
    public function email_reset($email)
    {
        $sql = "SELECT email FROM usuario WHERE email = :email";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':email', $email);
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    
        
    /**
     * resetPassword. Una vez comnprobado la existencia del email, cambia el password con la 
     * contraseña seleccionada al azar
     *
     * @param  mixed $email
     * @param  mixed $password
     * @return void
     */
    public function resetPassword($email, $password) {
        $hash = $this->hash($password);
        $resultado = null;
        try{
            $sql = "UPDATE `usuario` SET password= :password WHERE email = :email;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':password', $hash);
            $stmt ->bindParam(':email', $email);
            if($stmt ->execute()){
                $resultado = 'OK';
            }else{
                $resultado = "El password no se ha cambiado";
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }

    
    /**
     * hash. Encripta la contraseña
     *
     * @param  mixed $password
     * @return void
     */
    public static function hash($password)
    {
        return hash('sha512', '34' . $password);
    }
}
