<?php 
require_once('db_connection.php');
$user_name = $_POST['order-name'];
$user_email = $_POST['order-email'];
$user_phone = $_POST['order-phone'];
$product_id = $_POST['order-product-id'];
$product = mysqli_fetch_assoc(mysqli_query($connection, query:"SELECT `name` FROM `products` WHERE `product_id` = $product_id"));

$message = 'Здравствуйте '. $user_name .', cпасибо что заказли "' . $product['name'] . '", мы с вами свяжемся по вашему номеру телефона (' . $user_phone . ')';
header('Location: /thanks.php');

mail(
    $user_email,
    'Заказ товара',
    $message,
)
?>
