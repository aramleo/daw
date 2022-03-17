<?php

require_once(__DIR__.'\conexion.php');

class Funciones{

    private $conexion;
    private $url;

    public function  __construct(){
        $bd = new Conexion();
        $this->conexion = $bd->conexion();
    }
    
    // Funciones para el blog 

    public function getPosts(){	
        $sql="SELECT id, titulo FROM blog ORDER BY id desc";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    
    public function getPostById($id)
    {
        $sql = "SELECT id, titulo, fecha, texto, imagen FROM blog WHERE id = :id;";
        $query = $this->conexion-> prepare($sql);
        $query->bindParam(':id', $id);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    // Funciones de Usuario


}

