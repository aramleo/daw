<?php
/**
 * lee los diferentes posts guardados en la base de datos.
 */
require_once(__DIR__.'/conexion.php');

/**
 * Funciones
 */
class FuncionesBlog{

    private $conexion;
    // private $url;
    
    /**
     * __construct. Constructor de la clase donde inicia una instancia y conecta con la base de datos.
     *
     * @return void
     */
    public function  __construct(){
        $bd = new Conexion();
        $this->conexion = $bd->conexion();
    }
    
   
    /**
     * getPosts. Extrae todos los posts que exiten en la base de datos.
     *
     * @return void
     */
    public function getPosts(){	
        $sql="SELECT id, titulo FROM blog ORDER BY id desc";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
        
    /**
     * getPostById. Extrae los post por id para poder mostrarlos en una página aparte.
     *
     * @param  mixed $id
     * @return void
     */
    public function getPostById($id)
    {
        $sql = "SELECT id, titulo, fecha, texto, imagen FROM blog WHERE id = :id;";
        $query = $this->conexion-> prepare($sql);
        $query->bindParam(':id', $id);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}

