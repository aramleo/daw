<?php

/**
 * Conectamos con la base de datos
 */

include 'bd.php';

Class Conexion extends Database {
    
    /**
     * __construct. Contructor de la clase donde asignamos uno de los parámetros de la 
     * conexion PDO.
     *
     * @return void
     */
    public function __construct() {
        $this->datos = "mysql:host=127.0.0.1;dbname=$this->dbname";
    }
   
    /**
     * conexion. Conexión con la base de datos mediante PDO.
     *
     * @return void
     */
    public function conexion() {
        try {
            $conn = new PDO($this->datos, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'));
            /* echo "Connected to $dbname at $host successfully."; */
        } catch (PDOException $pe) {
            die("No se ha podido conectar con $this->dbname :" . $pe->getMessage());
        }
        return $conn;
    }
}
