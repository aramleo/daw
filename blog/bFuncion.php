<?php


function getPosts($conn){	
	$sql="SELECT id, title FROM post ORDER BY id desc";
	$query = $conn -> prepare($sql);
    $query -> execute();
    $results = $query -> fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function getPostById($conn, $id)
{
    $sql = "SELECT date, title, content, author FROM post WHERE id = :id;";
    $query = $conn -> prepare($sql);
    $query -> execute();
    $results = $query -> fetchAll(PDO::FETCH_ASSOC);
    return $results;
}