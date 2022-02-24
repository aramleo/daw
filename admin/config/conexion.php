<?php

require_once 'bd.php';

try {
    $conn = new PDO($datos, $username, $password);
    /* echo "Connected to $dbname at $host successfully."; */
} catch (PDOException $pe) {
    die("No se ha podido conectar con $dbname :" . $pe->getMessage());
}