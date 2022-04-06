<?php
/** 
 * Clase donde incluiremos las funciones concernientes a cambios en el perfil
 * 
 * */
// Lllamamos a el archivo conexion.php
require_once(__DIR__.'/conexion.php');

class FuncionesPerfil{
    
    /**
     * __construct.- Constructor de la clase FuncionesPerfil
     *
     * @return void
     */
    public function __construct(){
        $bd = new Conexion();
        $this->conexion = $bd->conexion();
    }

    public function cambioDatos($id, $nombre, $email){
        $resultado = null;
        try {
            $sql = "UPDATE usuario SET nombre = :nombre, email = :email WHERE id = $id;";
            $conex = $this->conexion->prepare($sql);
            $conex->bindParam(':nombre', $nombre);
            $conex->bindParam(':email', $email);
            if($conex->execute()){
                $resultado = 'OK';
            }
        }catch (Exception $e){
            $resultado = $e->getMessage();
        }
        return $resultado;
    }

    public function comprobarOldPassword($id, $old_password){
        $comprobacion = false;
        $hash = $this->hash($old_password);
        try {
            $sql = "SELECT password FROM usuario WHERE id = $id and password = :password;";
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindParam(':password', $hash);
            if($consulta->execute()){
                $comprobacion = $consulta->rowCount() == 1;
            }
        } catch (Exception $e) {
            $comprobacion = $e->getMessage();
        }
        return $comprobacion;
    }

    /**
     * cambioEmail
     *
     * @param  mixed $id
     * @param  mixed $password
     * @return void
     */
    public function cambioPassword($id, $password) {
        $hash = $this->hash($password);
        $resultado = null;
        try{
            $sql = "UPDATE `usuario` SET password= :password WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':password', $hash);
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

    public static function hash($password) {
        return hash('sha512', '34'.$password);
    }
}