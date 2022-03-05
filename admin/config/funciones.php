<?php

namespace admin\config\Clase;

require_once('admin/config/conexion.php');

use admin\config\BD\Conexion;
use PDO;
use Exception;

class Funciones{

    private $nombre;
    private $estacion;
    private $conexion;
    private $url;

    public function  __construct(){
        $bd = new Conexion;
        $this->conexion = $bd->conexion();
        $this->url = 'http://localhost/andres/daw/';
    }

    public function consultar($conn){
        $this->conexion = $conn;
        $sql = "SELECT p.ID, p.nombre, e.estacion FROM `productos` AS p JOIN `estaciones` AS e on p.estacion = e.id_estacion ORDER BY p.nombre;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    
    public function agregar($conn, $nombre, $estacion){
        $resultado = null;
        $this->conexion = $conn;
        $this->nombre = $nombre;
        $this->estacion = $estacion;
        try{
            $sql = "INSERT INTO productos (nombre, estacion) VALUES (?,?)";
            $stmt = $this->conexion -> prepare($sql);
            $stmt -> execute([$this->nombre, $this->estacion]);
            $resultado = 1;
        }catch(Exception $e){
            $resultado = $e->getCode();
        }      
        return $resultado;
    }

    public function editar($conn, $id){
        $this->conexion = $conn;
        $sql = "SELECT * FROM `productos` WHERE ID = $id;";
        $query = $this->conexion -> prepare($sql);
        $query -> execute();
        $results = $query -> fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public function actualizar($conn, $id, $nombre, $estacion){

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

