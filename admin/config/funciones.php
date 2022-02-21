<?php

function consultar($conn){
    $sql = "SELECT * FROM pelicula";
    $query = $conn -> prepare($sql);
    $query -> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    return $results;
}