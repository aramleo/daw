<?php
// Inclusión del archivo para la conexión
require_once(__DIR__.'/conexion.php');

/**
 * FuncionesUsuarios. Funciones relacionadas con el usuario
 */
class FuncionesUsuarios{

    private $conexion;
    
    /**
     * __construct. Instancia y creación de la conexión
     *
     * @return void
     */
    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
        
    }
    /**
     * consultarUsuario. Consulta de usuarios para el administrador.
     *
     * @return void
     */
    public function consultarUsuario(){
        $sql = "SELECT u.id, u.nombre, u.email, r.rol FROM `usuario` AS u JOIN `roles` AS r on u.id_rol = r.id_rol ORDER BY u.nombre;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    /**
     * consultarUsuarioRol. Consulta del usuario por su id y comprobación del rol
     *
     * @param  mixed $id
     * @return void
     */
    public function consultarUsuarioRol($id){
        $sql = "SELECT u.id, u.nombre, u.email, r.rol FROM `usuario` AS u JOIN `roles` AS r on u.id_rol = r.id_rol WHERE u.id = :id;";
        $query = $this->conexion -> prepare($sql);
        $query ->bindParam(':id', $id);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    /**
     * consultarUsuarioId. Consulta de usuario por id
     *
     * @param  mixed $id
     * @return void
     */
    public function consultarUsuarioId($id){
        $sql = "SELECT nombre FROM `usuario` WHERE id = :id;";
        $query = $this->conexion -> prepare($sql);
        $query ->bindParam(':id', $id);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    /**
     * editar. Llamada de los datos de un usuario por el parámetro del id de usuario
     *
     * @param  mixed $id
     * @return void
     */
    public function editar($id){
        $sql = "SELECT * FROM `usuario` WHERE id = $id";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    /**
     * actualizar. Guarda los datos del usuario actualizados.
     *
     * @param  mixed $id
     * @param  mixed $nombre
     * @param  mixed $email
     * @param  mixed $rol
     * @return void
     */
    public function actualizar($id, $nombre, $email, $rol){
        $resultado = null;
        try{
            $sql = "UPDATE `usuario` SET `nombre`=:nombre , `email`=:email, `id_rol`=:rol WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':email', $email);
            $stmt ->bindParam(':rol', $rol);
            if($stmt ->execute()){
                $resultado = 'Registro actualizado';
            }else{
                $resultado = "Registro no actualizado";
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }

    /**
     * borrar. Borra a un usuario por id
     *
     * @param  mixed $id
     * @return void
     */
    public function borrar($id){
        $resultado = null;
        try{
            $sql = "DELETE FROM `usuario` WHERE id = :id";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':id', $id);
            $resultado = $stmt ->execute();
            if($resultado === true){
                $envio = 'Registro eliminado';
            }else{
                $envio = 'No se ha eliminado el registro';
            }
        }catch(Exception $e){
            $envio = $e->getMessage();
        }      
        return $envio;
        
    } 

    /**
     * editarUsuario. Llamada de un usuario por id para la consulta por el administrador
     *
     * @param  mixed $id
     * @return void
     */
    public function editarUsuario($id){
        $sql = "SELECT * FROM `usuario` WHERE id = :id";
        $query = $this->conexion -> prepare($sql);
        $query->bindParam(':id', $id);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    /**
     * consulta_direccion. Consulta la dirección de un usuario pasado por parámetro.
     *
     * @param  mixed $id
     * @return void
     */
    public function consulta_direccion($id){
        $resultado = null;
        $sql = "SELECT usuario.nombre, usuario.email, direcciones.dni, direcciones.direccion, direcciones.otros, direcciones.localidad, direcciones.provincia, direcciones.cp, direcciones.telefono 
        FROM usuario INNER JOIN direcciones ON usuario.id = direcciones.id_usuario WHERE usuario.id = :id;";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':id', $id);
        $query -> execute();
        $resultado = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    
}

