<?php

require_once(__DIR__.'/conexion.php');

class Funciones{

    private $conexion;
    private $url;
    
    /**
     * __construct
     *
     * @return void
     */
    public function  __construct(){
        $bd = new Conexion();
        $this->conexion = $bd->conexion();
    }
    // Consultar productos    
    /**
     * consultar
     *
     * @return void
     */
    public function consultar(){
        $sql = "SELECT * FROM `productos` ORDER BY nombre;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function consultarUser(){
        $sql = "SELECT * FROM `productos` WHERE estado = 1 ORDER BY nombre;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    // Agregar productos    
    /**
     * agregar
     *
     * @param  mixed $nombre
     * @param  mixed $referencia
     * @param  mixed $precio
     * @param  mixed $imagen
     * @param  mixed $estado
     * @return void
     */
    public function agregar($nombre, $referencia, $precio, $imagen, $estado){
        $resultado = null;
        try{
            $sql = "INSERT INTO productos (nombre, referencia, precio, imagen, estado) VALUES (:nombre,:referencia,:precio,:imagen,:estado)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':referencia', $referencia);
            $stmt ->bindParam(':precio', $precio);
            $stmt ->bindParam(':imagen', $imagen);
            $stmt ->bindParam(':estado', $estado);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }
    // Editar productos    
    /**
     * editar
     *
     * @param  mixed $id
     * @return void
     */
    public function editar($id){
        $sql = "SELECT * FROM `productos` WHERE id = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    // Actualizar los productos editados    
    /**
     * actualizar
     *
     * @param  mixed $id
     * @param  mixed $nombre
     * @param  mixed $referencia
     * @param  mixed $precio
     * @param  mixed $imagen
     * @param  mixed $estado
     * @return void
     */
    public function actualizar($id, $nombre, $referencia, $precio, $imagen, $estado){
        $resultado = null;
        try{
            $sql = "UPDATE `productos` SET `nombre`=:nombre , `referencia`=:referencia, `precio`=:precio, `imagen`=:imagen, `estado`=:estado WHERE `id` = $id";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':referencia', $referencia);
            $stmt ->bindParam(':precio', $precio);
            $stmt ->bindParam(':imagen', $imagen);
            $stmt ->bindParam(':estado', $estado);
            if($stmt ->execute()){
                $resultado = 'Registro actualizado';
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }
    //Borrar los productos    
    /**
     * borrar
     *
     * @param  mixed $id
     * @return void
     */
    public function borrar($id){
        $resultado = null;
        try{
            $sql = "DELETE FROM `productos` WHERE id = :id;";
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

    // Consultar productos de la cesta    
    /**
     * consultar_cesta
     *
     * @param  mixed $id
     * @param  mixed $elementos
     * @return void
     */
    public function consultar_cesta($id, $elementos){
        $sql = "SELECT id, nombre, precio, $elementos as cantidad_pro FROM `productos` WHERE estado = 1  AND id =:id;";
        $query = $this->conexion -> prepare($sql);
        $query ->bindParam(':id', $id);
        $query -> execute();
        $results = $query -> fetch(PDO::FETCH_ASSOC);
        return $results;
    }

    // Consultar productos de la cesta    
    /**
     * actualizar_cesta
     *
     * @param  mixed $id
     * @return void
     */
    public function actualizar_cesta($id){
        $sql = "SELECT precio FROM `productos` WHERE estado = 1 AND id =:id;";
        $query = $this->conexion -> prepare($sql);
        $query ->bindParam(':id', $id);
        $query -> execute();
        $results = $query -> fetch(PDO::FETCH_ASSOC);
        return $results;
    }
    
    /**
     * guardar_pedido
     *
     * @param  mixed $id_pedido
     * @param  mixed $id_usuario
     * @param  mixed $precio_total
     * @return void
     */
    public function guardar_pedido($id_pedido, $id_usuario, $precio_total){
        $resultado = null;
        $fecha = date('Y-m-d H:m:s');
        $estado = 1;
        try{
            $sql = "INSERT INTO pedidos (id_pedido,id_usuario, precio_total, fecha, estado) VALUES (:id_pedido, :id_usuario,:precio_total,:fecha,:estado)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':id_pedido', $id_pedido);
            $stmt ->bindParam(':id_usuario', $id_usuario);
            $stmt ->bindParam(':precio_total', $precio_total);
            $stmt ->bindParam(':fecha', $fecha);
            $stmt ->bindParam(':estado', $estado);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }    
    /**
     * guardar_detalle_pedido
     *
     * @param  mixed $id_pedido
     * @param  mixed $id_producto
     * @param  mixed $precio
     * @param  mixed $cantidad
     * @return void
     */
    public function guardar_detalle_pedido($id_pedido, $id_producto, $precio, $cantidad){
        $resultado = null;
        $estado = 1;
        try{
            $sql = "INSERT INTO detalle_pedidos(id_pedido,id_producto, precio_unitario, cantidad, estado) VALUES (:id_pedido, :id_producto,:precio,:cantidad,:estado)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':id_pedido', $id_pedido);
            $stmt ->bindParam(':id_producto', $id_producto);
            $stmt ->bindParam(':precio', $precio);
            $stmt ->bindParam(':cantidad', $cantidad);
            $stmt ->bindParam(':estado', $estado);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }
    
    /**
     * consultarPedidos
     *
     * @param  mixed $pedido
     * @return void
     */
    public function consultarDetallePedidos($pedido){
        $resultado = null;
        try{
            $sql = "SELECT `id`, `id_pedido`, `id_producto`, `precio_unitario`, `cantidad` FROM `detalle_pedidos` WHERE id_pedido = :pedido";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':pedido', $pedido);
            $stmt -> execute();
            $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }

    public function consultarPedidos($pedido){
        $resultado = null;
        try{
            $sql = "SELECT id, id_pedido, id_usuario, precio_total, fecha FROM pedidos WHERE id_pedido = :pedido";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':pedido', $pedido);
            $stmt -> execute();
            $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }

}