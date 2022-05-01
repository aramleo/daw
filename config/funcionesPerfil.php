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
    
    /**
     * cambioDatos. Cambio de los datos personales
     *
     * @param  mixed $id
     * @param  mixed $nombre
     * @param  mixed $email
     * @return void
     */
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
    
    /**
     * comprobarOldPassword. Comprobación si la contraseña antigua es correcta para el
     * cambio de contraseña
     *
     * @param  mixed $id
     * @param  mixed $old_password
     * @return void
     */
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
     * cambioEmail. Cambia el email del usuario
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
    
    /**
     * hash
     *
     * @param  mixed $password.  Encripta el password
     * @return void
     */
    public static function hash($password) {
        return hash('sha512', '34'.$password);
    }
    
    /**
     * consultarDireccion. Consulta la dirección del usuario
     *
     * @param  mixed $id
     * @return void
     */
    public function consultarDireccion($id){
        $sql = "SELECT * FROM `direcciones` WHERE id_usuario = $id";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    
    /**
     * agregarDireccion. Agrega la dirección del usuario a la base de datos
     *
     * @param  mixed $id_usuario
     * @param  mixed $dni
     * @param  mixed $direccion
     * @param  mixed $otros
     * @param  mixed $localidad
     * @param  mixed $provincia
     * @param  mixed $cp
     * @param  mixed $telefono
     * @return void
     */
    public function agregarDireccion($id_usuario, $dni, $direccion, $otros, $localidad, $provincia, $cp, $telefono){
        $resultado = null;
        try {
            $sql = "INSERT INTO direcciones (id_usuario,dni, direccion, otros, localidad, provincia, cp, telefono) 
            VALUES (:id_usuario,:dni, :direccion ,:otros, :localidad, :provincia, :cp, :telefono)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':id_usuario', $id_usuario);
            $stmt ->bindParam(':dni', $dni);
            $stmt ->bindParam(':direccion', $direccion);
            $stmt ->bindParam(':otros', $otros);
            $stmt ->bindParam(':localidad', $localidad);
            $stmt ->bindParam(':provincia', $provincia);
            $stmt ->bindParam(':cp', $cp);
            $stmt ->bindParam(':telefono', $telefono);
            if($stmt -> execute()){
                $resultado = 1;
            };
        } catch (Exception $e) {
            $resultado = $e->getMessage();
        }
        return $resultado;
    }
    
    /**
     * actualizarDireccion. Actualliza la dirección del usuario de la base de datos
     *
     * @param  mixed $id_usuario
     * @param  mixed $dni
     * @param  mixed $direccion
     * @param  mixed $otros
     * @param  mixed $localidad
     * @param  mixed $provincia
     * @param  mixed $cp
     * @param  mixed $telefono
     * @return void
     */
    public function actualizarDireccion($id_usuario, $dni, $direccion, $otros, $localidad,$provincia, $cp, $telefono){
        $resultado = null;
        try{
            $sql = "UPDATE direcciones SET dni=:dni, direccion=:direccion, otros=:otros, localidad=:localidad, provincia = :provincia, cp = :cp, telefono =:telefono WHERE id_usuario = :id_usuario";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':id_usuario', $id_usuario);
            $stmt ->bindParam(':dni', $dni);
            $stmt ->bindParam(':direccion', $direccion);
            $stmt ->bindParam(':otros', $otros);
            $stmt ->bindParam(':localidad', $localidad);
            $stmt ->bindParam(':provincia', $provincia);
            $stmt ->bindParam(':cp', $cp);
            $stmt ->bindParam(':telefono', $telefono);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;

    }


}