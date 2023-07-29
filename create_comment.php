<?php 
session_start();
require_once('..//db_connection.php');
$name = $_POST['name']; $name = mysqli_real_escape_string($connection, $name); $name = htmlspecialchars($name);
$comment = $_POST['comment']; $comment = mysqli_real_escape_string($connection, $comment); $comment = htmlspecialchars($comment);

$PreparedQuery = $connection -> prepare("INSERT INTO `comments` (`comment_id`, `name`, `comment`,`date`) VALUES (NULL, ?, ?, now())");
$PreparedQuery -> bind_param('ss', $name, $comment);
$PreparedQuery -> execute();

$_SESSION['commented'] = true;
header('Location: /');
?>