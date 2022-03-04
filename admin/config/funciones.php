<?php

class Funciones{

    private $conexion;

    public function  __construct(){

    }

    public function consultar($conn){
        $sql = "SELECT p.ID, p.nombre, e.estacion, m.mes, p.img FROM `productos` AS p JOIN `estaciones` AS e JOIN `meses` AS m on p.estacion = e.id_estacion AND p.clave_mes= m.id_mes ORDER BY p.nombre;";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    public function agregar($conn, $nombre, $estacion, $mes, $imagen){
        $resultado = null;
        try{
            $sql = "INSERT INTO productos (nombre, estacion, img, clave_mes) VALUES (:nombre,:estacion,:mes,:img)";
            $stmt = $conn -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':estacion', $estacion);
            $stmt ->bindParam(':mes', $mes);
            $stmt ->bindParam(':img', $imagen);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }

    public function editar($conn, $id){
        $sql = "SELECT * FROM `productos` WHERE ID = $id;";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function actualizar($conn, $id, $nombre, $estacion, $mes, $imagen){
        $resultado = null;
        try{
            $sql = "UPDATE `productos` SET `nombre`=:nombre , `estacion`=:estacion, `clave_mes`=:mes, `img`=:img WHERE ID = $id;";
            $stmt = $conn -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':estacion', $estacion);
            $stmt ->bindParam(':mes', $mes);
            $stmt ->bindParam(':img', $imagen);
            if($stmt ->execute()){
                $resultado = 'Registro actualizado';
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }

    public function borrar($conn, $id){
        $envio = $id;
        $resultado = null;
        try{
            $sql = "DELETE FROM `productos` WHERE ID = :id;";
            $stmt = $conn -> prepare($sql);
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

