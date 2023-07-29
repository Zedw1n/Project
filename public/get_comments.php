<?php 
require_once '../db_connection.php' ;

$comments = mysqli_fetch_all(mysqli_query($connection, query:"SELECT * FROM `comments`"));

$CommentPackage = array(
    "num_rows" => count($comments),
    "name" => array(),
    "comment" => array(),
    "date" => array(),
);

foreach($comments as $comment){
    array_push($CommentPackage["name"], $comment[1]);
    array_push($CommentPackage["comment"], $comment[2]);
    array_push($CommentPackage["date"], $comment[3]);
};

echo(json_encode($CommentPackage, JSON_UNESCAPED_UNICODE));
?>