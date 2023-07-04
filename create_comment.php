<?php 
session_start();
require_once('db_connection.php');
if($_POST['name'] and $_POST['comment']) {
    if(iconv_strlen($_POST['comment']) <= 100){
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        mysqli_query($connection, query:"INSERT INTO `comments` (`comment_id`, `name`, `comment`,`date`) VALUES (NULL, '$name', '$comment',now())");
        $_SESSION['commented'] = true;
        header('Location: /index.php');
    } else {
        $_SESSION['message'] = 'Не более 100 символов';
        header('Location: /index.php');
    }
} else {
    $_SESSION['message'] = 'Заполните все поля!';
    header('Location: /index.php');
}
?>