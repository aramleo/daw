<?php

require_once(__DIR__.'\conexion.php');



class FuncionesAlquileres{

    private $conexion;

    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
    }
    // Consultar alquileres
    public function consultarAlquiler(){
        $sql = "SELECT * FROM `alquileres` WHERE `activa` = 1 ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    // Agregar alquileres
    public function agregar($referencia, $localidad, $metros, $imagen, $telefono, $activa){
        $resultado = null;
        try{
            $sql = "INSERT INTO alquileres (referencia, localidad, metros, imagen, telefono, activa) VALUES (:referencia,:localidad,:metros,:imagen,:telefono,:activa)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', $referencia);
            $stmt ->bindParam(':localidad', $localidad);
            $stmt ->bindParam(':metros', $metros);
            $stmt ->bindParam(':imagen', $imagen);
            $stmt ->bindParam(':telefono', $telefono);
            $stmt ->bindParam(':activa', $activa);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }
    // Editar alquileres
    public function editar($id){
        $sql = "SELECT * FROM `alquileres` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    // Actualizar los alquileres editados
    public function actualizar($id, $referencia, $localidad, $metros, $imagen, $telefono, $activa){
        $resultado = null;
        try{
            $sql = "UPDATE `alquileres` SET `referencia`=:referencia , `localidad`=:localidad, `metros`=:metros, `imagen`=:imagen, `telefono`=:telefono, `activa`= :activa WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', $referencia);
            $stmt ->bindParam(':localidad', $localidad);
            $stmt ->bindParam(':metros', $metros);
            $stmt ->bindParam(':imagen', $imagen);
            $stmt ->bindParam(':telefono', $telefono);
            $stmt ->bindParam(':activa', $activa);
            if($stmt ->execute()){
                $resultado = 'Registro actualizado';
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }
    //Borrar los alquileres
    public function borrar($id){
        $resultado = null;
        try{
            $sql = "DELETE FROM `alquileres` WHERE id = :id";
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

