<?php

require_once(__DIR__.'\conexion.php');

/**
 * FuncionesAlquileres
 * En este archivo se realizan todas las operaciones sobre los alquileres que el administrador 
 * inserte.
 */
class FuncionesAlquileres{

    private $conexion;
    
    /**
     * __construct. Contructor que llama a la clase para la conexión con la base
     * datos e inicializa una instancia de clase.
     *
     * @return void
     */
    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
    }
   
    /**
     * consultarAlquiler. Consulta los alquileres disponibles
     *
     * @return void
     */
    public function consultarAlquiler(){
        $sql = "SELECT * FROM `alquileres` WHERE `activa` = 1 ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }  
    /**
     * agregar- Agrega nuevos alquileres
     *
     * @param  mixed $referencia
     * @param  mixed $localidad
     * @param  mixed $metros
     * @param  mixed $imagen
     * @param  mixed $telefono
     * @param  mixed $activa
     * @return void
     */
    public function agregar($referencia, $localidad, $metros, $imagen, $telefono, $activa){
        $resultado = null;
        try{
            $sql = "INSERT INTO alquileres (referencia, localidad, metros, imagen, telefono, activa) VALUES (:referencia,:localidad,:metros,:imagen,:telefono,:activa)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', strtoupper($referencia));
            $stmt ->bindParam(':localidad', ucwords($localidad));
            $stmt ->bindParam(':metros', $metros);
            $stmt ->bindParam(':imagen', strtoupper($imagen));
            $stmt ->bindParam(':telefono', $telefono);
            $stmt ->bindParam(':activa', $activa);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }
    /**
     * editar. Edita los alquileres para su modificación
     *
     * @param  mixed $id
     * @return void
     */
    public function editar($id){
        $sql = "SELECT * FROM `alquileres` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    /**
     * actualizar. Actualizar los alquileres editados
     *
     * @param  mixed $id
     * @param  mixed $referencia
     * @param  mixed $localidad
     * @param  mixed $metros
     * @param  mixed $imagen
     * @param  mixed $telefono
     * @param  mixed $activa
     * @return void
     */
    public function actualizar($id, $referencia, $localidad, $metros, $imagen, $telefono, $activa){
        $resultado = null;
        try{
            $sql = "UPDATE `alquileres` SET `referencia`=:referencia , `localidad`=:localidad, `metros`=:metros, `imagen`=:imagen, `telefono`=:telefono, `activa`= :activa WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', strtoupper($referencia));
            $stmt ->bindParam(':localidad', ucwords($localidad));
            $stmt ->bindParam(':metros', $metros);
            $stmt ->bindParam(':imagen', strtoupper($imagen));
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
    /**
     * borrar. Borrar los alquileres 
     *
     * @param  mixed $id
     * @return void
     */
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

