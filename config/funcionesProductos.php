<?php

require_once(__DIR__.'/conexion.php');

class Funciones{

    private $conexion;
    private $url;

    public function  __construct(){
        $bd = new Conexion();
        $this->conexion = $bd->conexion();
    }
    // Consultar productos
    public function consultar(){
        $sql = "SELECT * FROM `productos` ORDER BY nombre;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    // Agregar productos
    public function agregar($nombre, $referencia, $precio, $cantidad, $imagen){
        $resultado = null;
        try{
            $sql = "INSERT INTO productos (nombre, referencia, precio, cantidad, imagen) VALUES (:nombre,:referencia,:precio,:cantidad,:imagen)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':referencia', $referencia);
            $stmt ->bindParam(':precio', $precio);
            $stmt ->bindParam(':cantidad', $cantidad);
            $stmt ->bindParam(':imagen', $imagen);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }
    // Editar productos
    public function editar($id){
        $sql = "SELECT * FROM `productos` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    // Actualizar los productos editados
    public function actualizar($id, $nombre, $referencia, $precio, $cantidad, $imagen){
        $resultado = null;
        try{
            $sql = "UPDATE `productos` SET `nombre`=:nombre , `referencia`=:referencia, `precio`=:precio, `cantidad`=:cantidad, `imagen`=:imagen WHERE `id` = $id";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':referencia', $referencia);
            $stmt ->bindParam(':precio', $precio);
            $stmt ->bindParam(':cantidad', $cantidad);
            $stmt ->bindParam(':imagen', $imagen);
            if($stmt ->execute()){
                $resultado = 'Registro actualizado';
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }
    //Borrar los productos
    public function borrar($id){
        $resultado = null;
        try{
            $sql = "DELETE FROM `productos` WHERE id = :id;";
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

}

