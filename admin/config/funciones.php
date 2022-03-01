<?php

class Funciones{

    private $nombre;
    private $estacion;
    private $conexion;

    public function  __construct(){

    }

    public function consultar($conn){
        $this->conexion = $conn;
        $sql = "SELECT p.ID, p.nombre, e.estacion FROM `productos` AS p JOIN `estaciones` AS e on p.estacion = e.id_estacion ORDER BY p.nombre;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    public function agregar($conn, $nombre, $estacion){
        $resultado = null;
        $this->conexion = $conn;
        $this->nombre = $nombre;
        $this->estacion = $estacion;
        try{
            $sql = "INSERT INTO productos (nombre, estacion) VALUES (?,?)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt -> execute([$this->nombre, $this->estacion]);
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }

    public function editar($conn, $id){
        $this->conexion = $conn;
        $sql = "SELECT * FROM `productos` WHERE ID = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function actualizar($conn, $id, $nombre, $estacion){

    }
}

