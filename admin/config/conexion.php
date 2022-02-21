<?php

require_once 'bd.php';

try {
    $conn = new PDO($datos, $username, $password);
    /* echo "Connected to $dbname at $host successfully."; */
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}