<?php

require_once(__DIR__.'/conexion.php');



/**
 * FuncionesServicios. Funciones que gestionan los servicios persentados a los usuarios
 */
class FuncionesServicios{
    
    /**
     * conexion. Conexión a la base de datos. variable 
     *
     * @var mixed
     */
    private $conexion;
    
    /**
     * __construct. Instancia la clase y crea la conexión con la base de datos
     *
     * @return void
     */
    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
    }
       
    /**
     * consultarServicios. Consulta los servicios activos por referencia para la presentación del usuario
     *
     * @return void
     */
    public function consultarServicios(){
        $sql = "SELECT * FROM `servicios` WHERE `activa` = 1 ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    /**
     * consultarServiciosAdmin. Consulta todos los servicios para el administrador activos o no
     *
     * @return void
     */
    public function consultarServiciosAdmin(){
        $sql = "SELECT * FROM `servicios` ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
        
    /**
     * agregar. Agrega servicios nuevos.
     *
     * @param  mixed $referencia
     * @param  mixed $servicio
     * @param  mixed $imagen
     * @param  mixed $activa
     * @return void
     */
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
        
    /**
     * editar. Edita los servicios consultando el servicios y traer los datos al formulario
     *
     * @param  mixed $id
     * @return void
     */
    public function editar($id){
        $sql = "SELECT * FROM `servicios` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
        
    /**
     * actualizar. Guarda los datos actualizados por el administrador
     *
     * @param  mixed $id
     * @param  mixed $referencia
     * @param  mixed $servicio
     * @param  mixed $imagen
     * @param  mixed $activa
     * @return void
     */
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
        
    /**
     * borrar. Borra el servicio por el id del servicio
     *
     * @param  mixed $id
     * @return void
     */
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

