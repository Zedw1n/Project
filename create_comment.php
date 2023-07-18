<?php 
session_start();
require_once('db_connection.php');
$PreparedQuery = $connection -> prepare("INSERT INTO `comments` (`comment_id`, `name`, `comment`,`date`) VALUES (NULL, ?, ?, now())");
$name = $_POST['name']; $name = strip_tags($name);
$comment = $_POST['comment']; $comment = strip_tags($comment);
$PreparedQuery -> bind_param('ss', $name, $comment);
$PreparedQuery -> execute();
$_SESSION['commented'] = true;
header('Location: /');
?>