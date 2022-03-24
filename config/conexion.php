<?php

include 'bd.php';

Class Conexion extends Database {

    public function __construct() {
        $this->datos = "mysql:host=127.0.0.1;dbname=$this->dbname";
    }

    /**
     * Conexión con la base de datos mediante PDO.
     */
    public function conexion() {
        try {
            $conn = new PDO($this->datos, $this->username, $this->password);
            /* echo "Connected to $dbname at $host successfully."; */
        } catch (PDOException $pe) {
            die("No se ha podido conectar con $this->dbname :" . $pe->getMessage());
        }
        return $conn;
    }
}
