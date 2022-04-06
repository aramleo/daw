<?php

require_once(__DIR__.'/conexion.php');

/**
 * FuncionesDireccion. Funciones para controlar los archivos que manejan la direccion
 */
class FuncionesDireccion{
    
    /**
     * conexion. Variable que contendrá la conexión a la base de datos
     *
     * @var mixed
     */
    private $conexion;
    
    /**
     * __construct. Instancia la clase con la conexión a base de datos
     *
     * @return void
     */
    public function __construct() {
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
    }

    public function consultarDireccion($id){
        $sql = "SELECT * FROM `direcciones` WHERE id_usuario = $id";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function agregarDireccion($id_usuario, $dni, $direccion, $otros, $localidad,$provincia,$cp, $telefono){
        $resultado = null;
        try{
            $sql = "INSERT INTO descargas (id_usuario, dni, direccion, otros, localidad, provincia, cp, telefono) VALUES (:id_usuario, :dni, :direccion, :otros, :localidad, :provincia, :cp, :telefono)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':id_usuario', $id_usuario);
            $stmt ->bindParam(':dni', $dni);
            $stmt ->bindParam(':direccion', $direccion);
            $stmt ->bindParam(':otros', $otros);
            $stmt ->bindParam(':localidad', $localidad);
            $stmt ->bindParam(':provincia', $provincia);
            $stmt ->bindParam(':cp', $cp);
            $stmt ->bindParam(':telefono', $telefono);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }

    public function actualizarDireccion($id_usuario, $dni, $direccion, $otros, $localidad,$provincia,$cp, $telefono){

    }
}


?>