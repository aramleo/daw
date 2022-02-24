<?php

class Funciones{

    private $nombre;
    private $estacion;
    private $conexion;

    public function  __construct(){

    }

    public function consultar($conn){
        $this->conexion = $conn;
        $sql = "SELECT * FROM productos";
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
        }catch(Exception $e){
            if($e->getCode()==23000){
                $resultado = 'Registro duplicado';
            }
        }      
        return $resultado;
    }
}

