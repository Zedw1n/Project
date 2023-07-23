<?php	
    require_once('config.php');
    $connection = new mysqli($config['hostname'],$config['login'],$config['password'],$config['database']);
    mysqli_set_charset($connection,$config['encoding']);
?>
