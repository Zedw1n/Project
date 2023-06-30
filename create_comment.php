<?php 

require_once('db_connection.php');

$name = $_POST['name'];
$comment = $_POST['comment'];
mysqli_query($connection, query:"INSERT INTO `comments` (`comment_id`, `name`, `comment`) VALUES (NULL, '$name', '$comment')")

?>