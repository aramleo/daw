<?php

namespace admin\config\Clase;

require_once(__DIR__.'\conexion.php');

use admin\config\BD\Conexion;
use PDO;
use Exception;

class FuncionesAlquileres{

    private $conexion;
    private $url;

    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
        $this->url = 'http://localhost/daw/';
    }
    // Consultar productos
    public function consultarAlquiler(){
        $sql = "SELECT id, referencia, localidad,metros, imagen FROM `alquileres` ORDER BY referencia;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    // Agregar productos
    public function agregar($nombre, $estacion, $mes, $imagen){
        $resultado = null;
        try{
            $sql = "INSERT INTO productos (nombre, estacion, clave_mes, img) VALUES (:nombre,:estacion,:mes,:img)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':estacion', $estacion);
            $stmt ->bindParam(':mes', $mes);
            $stmt ->bindParam(':img', $imagen);
            $stmt -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }
    // Editar productos
    public function editar($id){
        $sql = "SELECT * FROM `productos` WHERE ID = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
    // Actualizar los productos editados
    public function actualizar($id, $nombre, $estacion, $mes, $imagen){
        $resultado = null;
        try{
            $sql = "UPDATE `productos` SET `nombre`=:nombre , `estacion`=:estacion, `clave_mes`=:mes, `img`=:img WHERE ID = $id;";
            $stmt = $this->conexion -> prepare($sql);
            $stmt ->bindParam(':nombre', $nombre);
            $stmt ->bindParam(':estacion', $estacion);
            $stmt ->bindParam(':mes', $mes);
            $stmt ->bindParam(':img', $imagen);
            if($stmt ->execute()){
                $resultado = 'Registro actualizado';
            }
        }catch(Exception $e){
            $resultado = $e->getMessage();
        }      
        return $resultado;
    }
    //Borrar los productos
    public function borrar($id){
        $envio = $id;
        $resultado = null;
        try{
            $sql = "DELETE FROM `productos` WHERE ID = :id;";
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

    /**
     * Método para comprobar si el usuario tiene abierta la sesión.
     */
    public function comprobarSesion() {
        return (session_status() == PHP_SESSION_ACTIVE || (isset($_SESSION['email']) && isset($_SESSION['password'])) 
            || (isset($_COOKIE['email']) || isset($_COOKIE['password']))) ? true : false;
    }

    /**
     * Método para registrar el usuario.
     * @param $email
     * @param $password
     * @return int
     */
    public function registrarUsuario($email, $password) {
        try {
            $sql = "INSERT INTO `usuarios` (email, password) VALUES (:email, :password);";
            $query = $this->conexion -> prepare($sql);
            $query -> bindParam(':email', $email);
            $query -> bindParam(':password', $password);
            $query -> execute();
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }    
        return $resultado;  
    }

    /**
     * Comprueba que el usuario está registrado.
     * @param $email
     * @return $result;
     */
    public function comprobarUsuario($email) {
        $sql = "SELECT * FROM `usuarios` WHERE email = :email;";
        $query = $this->conexion -> prepare($sql);
        $query -> bindParam(':email', $email);
        $query -> execute();
        // $result = $query -> fetchAll(PDO::FETCH_ASSOC);
        // return $result;
        return $query->rowCount();
    }

    public function redireccion($url) {
        header('Location: ' . $this->url . $url);
        die();
    }

    public function logout() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION['email'] = null;
        $_SESSION['password'] = null;
        unset($_COOKIE['email']);
        unset($_COOKIE['password']);
        setCookie('email', "", time()-3600);
        setCookie('password', "", time()-3600);
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

