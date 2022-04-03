<?php

require_once(__DIR__.'/conexion.php');

class FuncionesUsuarios{

    private $conexion;
    
    /**
     * __construct
     *
     * @return void
     */
    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
        
    }
    // Consultar productos    
    /**
     * consultarUsuario
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
    
    // Editar usuarios    
    /**
     * editar
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
    // Actualizar los usuarios    
    /**
     * actualizar
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

    //Borrar los usuarios    
    /**
     * borrar
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

    // Editar usuarios    
    /**
     * editarUsuario
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
    
}

