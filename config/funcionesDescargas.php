<?php
/**
 * EN este archivo controlamos las diferentes funciones de la tabla descargas.
 */
require_once(__DIR__.'/conexion.php');



/**
 * FuncionesDescargas. Controla la edición, agregación y borrado de descargas
 */
class FuncionesDescargas{
    
    /**
     * conexion. Conexión con base de datos
     *
     * @var mixed
     */
    private $conexion;
    
    /**
     * __construct. Crea una conexión con la base de datos
     *
     * @return void
     */
    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
    }
    /**
     * consultarDescargas. Consultar descargas activas
     *
     * @return void
     */
    public function consultarDescargas(){
        $sql = "SELECT * FROM `descargas` WHERE `activa` = 1 ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    /**
     * consultarDescargasAdmin. Consulta todas las descargas, activas y no activas.
     *
     * @return void
     */
    public function consultarDescargasAdmin(){
        $sql = "SELECT * FROM `descargas` ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    /**
     * agregar las descargas que introduce el administrador
     *
     * @param  mixed $referencia. Referencia de la descarga
     * @param  mixed $titulo. Título de la descarga
     * @param  mixed $enlace. Enlace desde donde se puede descargar
     * @param  mixed $imagen. Imagen asignada a la descarga
     * @param  mixed $activa. Si la descarga permanece activa
     * @return void
     */
    public function agregar($referencia, $titulo, $enlace, $imagen, $activa){
        $resultado = null;
        try{
            $sql = "INSERT INTO descargas (referencia, titulo, enlace, imagen, activa) VALUES (:referencia,:titulo,:enlace,:imagen,:activa)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', strtoupper($referencia));
            $stmt ->bindParam(':titulo', $titulo);
            $stmt ->bindParam(':enlace', $enlace);
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
     * editar las diferentes descargas de la base de datos
     *
     * @param  mixed $id
     * @return void
     */
    public function editar($id){
        $sql = "SELECT * FROM `descargas` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    /**
     * actualizar. Actualiza las descargas en la base de datos 
     * 
     * @param  mixed $id
     * @param  mixed $referencia
     * @param  mixed $titulo
     * @param  mixed $enlace
     * @param  mixed $imagen
     * @param  mixed $activa
     * @return void
     */
    public function actualizar($id, $referencia, $titulo, $enlace, $imagen, $activa){
        $resultado = null;
        try{
            $sql = "UPDATE `descargas` SET `referencia`=:referencia , `titulo`=:titulo, `enlace`=:enlace, `imagen`=:imagen, `activa`= :activa WHERE id = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':referencia', strtoupper($referencia));
            $stmt ->bindParam(':titulo', $titulo);
            $stmt ->bindParam(':enlace', $enlace);
            $stmt ->bindParam(':imagen', $imagen) ;
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
     * borrar. Borra los registros de la base de datos y tabla descarga.
     *
     * @param  mixed $id
     * @return void
     */
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

