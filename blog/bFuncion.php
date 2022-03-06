<?php


function getPosts($conn){	
	$sql="SELECT id, titulo FROM blog ORDER BY id desc";
	$query = $conn -> prepare($sql);
    $query -> execute();
    $results = $query -> fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function getPostById($conn, $id)
{
    $sql = "SELECT id, titulo, fecha, texto, imagen FROM blog WHERE id = :id;";
    $query = $conn -> prepare($sql);
    $query->bindParam(':id', $id);
    $query -> execute();
    $results = $query -> fetchAll(PDO::FETCH_ASSOC);
    return $results;
}