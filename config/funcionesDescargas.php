<?php

require_once(__DIR__.'\conexion.php');



class FuncionesDescargas{

    private $conexion;

    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
    }
    // Consultar alquileres
    public function consultarDescargas(){
        $sql = "SELECT * FROM `descargas` WHERE `activa` = 1 ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    // Agregar alquileres
    public function agregar($referencia, $titulo, $enlace, $imagen, $activa){
        $resultado = null;
        try{
            $sql = "INSERT INTO descargas (referencia, titulo, enlace, imagen, activa) VALUES (:referencia,:titulo,:enlace,:imagen,:activa)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', strtoupper($referencia));
            $stmt ->bindParam(':titulo', $titulo);
            $stmt ->bindParam(':enlace', $enlace);
            $stmt ->bindParam(':imagen', strtoupper($imagen));
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
        $sql = "SELECT * FROM `descargas` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    // Actualizar los alquileres editados
    public function actualizar($id, $referencia, $titulo, $enlace, $imagen, $activa){
        $resultado = null;
        try{
            $sql = "UPDATE `descargas` SET `referencia`=:referencia , `titulo`=:titulo, `enlace`=:enlace, `imagen`=:imagen, `activa`= :activa WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', strtoupper($referencia));
            $stmt ->bindParam(':titulo', $titulo);
            $stmt ->bindParam(':enlace', $enlace);
            $stmt ->bindParam(':imagen', strtoupper($imagen));
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
            $sql = "DELETE FROM `descargas` WHERE id = :id";
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

