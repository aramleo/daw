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
    
    /**
     * consultarPost
     *
     * @return void
     */
    public function consultarPost()
    {
        $sql = "SELECT id, titulo, fecha, texto, imagen FROM blog;";
        $query = $this->conexion-> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    /**
     * agregarPost
     *
     * @param  mixed $titulo
     * @param  mixed $fecha
     * @param  mixed $texto
     * @param  mixed $imagen
     * @return void
     */
    public function agregarPost($titulo, $fecha, $texto, $imagen){
        $resultado = null;
        try{
            $sql = "INSERT INTO blog (titulo, fecha, texto, imagen) VALUES (:titulo,:fecha,:texto,:imagen)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':titulo', $titulo);
            $stmt ->bindParam(':fecha', $fecha);
            $stmt ->bindParam(':texto', $texto);
            $stmt ->bindParam(':imagen', $imagen);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }


    public function borrarPost($id){
        $resultado = null;
        try{
            $sql = "DELETE FROM `blog` WHERE id = :id";
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

    public function editarPost($id){
        $sql = "SELECT * FROM `blog` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }


    public function actualizarPost($id, $titulo, $fecha, $texto, $imagen){
        $resultado = null;
        try{
            $sql = "UPDATE `blog` SET `titulo`=:titulo , `fecha`=:fecha, `texto`=:texto, `imagen`=:imagen WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':titulo', $titulo);
            $stmt ->bindParam(':fecha', $fecha);
            $stmt ->bindParam(':texto', $texto);
            $stmt ->bindParam(':imagen', $imagen);
            if($stmt ->execute()){
                $resultado = 'Registro actualizado';
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }
}

