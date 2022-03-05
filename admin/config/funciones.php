<?php

namespace admin\config\Clase;

require_once('admin/config/conexion.php');

use admin\config\BD\Conexion;
use PDO;
use Exception;

class Funciones{

    private $conexion;
    private $url;

    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
        $this->url = 'http://localhost/andres/daw/';
    }

    public function consultar($conn){
        $sql = "SELECT p.ID, p.nombre, e.estacion, m.mes, p.img FROM `productos` AS p JOIN `estaciones` AS e JOIN `meses` AS m on p.estacion = e.id_estacion AND p.clave_mes= m.id_mes ORDER BY p.nombre;";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    public function agregar($conn, $nombre, $estacion, $mes, $imagen){
        $resultado = null;
        try{
            $sql = "INSERT INTO productos (nombre, estacion, img, clave_mes) VALUES (:nombre,:estacion,:mes,:img)";
            $stmt = $conn -> prepare($sql);
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

    public function editar($conn, $id){
        $sql = "SELECT * FROM `productos` WHERE ID = $id;";
        $query = $conn -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function actualizar($conn, $id, $nombre, $estacion, $mes, $imagen){
        $resultado = null;
        try{
            $sql = "UPDATE `productos` SET `nombre`=:nombre , `estacion`=:estacion, `clave_mes`=:mes, `img`=:img WHERE ID = $id;";
            $stmt = $conn -> prepare($sql);
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

    public function borrar($conn, $id){
        $envio = $id;
        $resultado = null;
        try{
            $sql = "DELETE FROM `productos` WHERE ID = :id;";
            $stmt = $conn -> prepare($sql);
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
}

