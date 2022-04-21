<?php

require_once(__DIR__.'/conexion.php');



class FuncionesServicios{

    private $conexion;

    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
    }
    // Consultar servicios
    public function consultarServicios(){
        $sql = "SELECT * FROM `servicios` WHERE `activa` = 1 ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function consultarServiciosAdmin(){
        $sql = "SELECT * FROM `servicios` ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    // Agregar servicios
    public function agregar($referencia, $servicio, $imagen, $activa){
        $resultado = null;
        try{
            $sql = "INSERT INTO servicios (referencia, servicio, imagen, activa) VALUES (:referencia,:servicio,:imagen,:activa)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', strtoupper($referencia));
            $stmt ->bindParam(':servicio', $servicio);
            $stmt ->bindParam(':imagen', $imagen);
            $stmt ->bindParam(':activa', $activa);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }
    // Editar servicios
    public function editar($id){
        $sql = "SELECT * FROM `servicios` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    // Actualizar los servicios editados
    public function actualizar($id, $referencia, $servicio, $imagen, $activa){
        $resultado = null;
        try{
            $sql = "UPDATE `servicios` SET `referencia`=:referencia , `servicio`=:servicio, `imagen`=:imagen, `activa`= :activa WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', strtoupper($referencia));
            $stmt ->bindParam(':servicio', $servicio);
            $stmt ->bindParam(':imagen', $imagen);
            $stmt ->bindParam(':activa', $activa);
            if($stmt ->execute()){
                $resultado = 'Registro actualizado';
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }
    //Borrar los servicios
    public function borrar($id){
        $resultado = null;
        try{
            $sql = "DELETE FROM `servicios` WHERE id = :id";
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

