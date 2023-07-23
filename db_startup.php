<?php
require_once('db_connection.php');

$connection->query("CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL
  )");
$connection->query("INSERT INTO `products` (`product_id`, `name`, `description`, `image_url`) VALUES
  (1, 'Ножницы', '130 мм \"FINECUT\" с тефлоновым покрытием, эргономичные ручки 60-0024 Альт', 'nozhneci.jpg'),
  (2, 'Комплект предметных тетрадей', '48л 10 шт. в пленке \"Ничего лишнего\" (079084) Хатбер', 'complekt_tetradey.jpg'),
  (3, 'Дневник', '1-11 класс (твердая обложка) \"Dino party\" (074584) 27179 Хатбер', 'dnevnik.jpg'),
  (4, 'Калькулятор ', '8 разрядов CITIZEN BusinessLine CMB801BK 136х100х32 мм CITIZEN', 'kalkulyator.jpg'),
  (5, 'Бумажник', 'иск. кожа, черный, крокодил 240454', 'bumazhnik.jpg')");

$connection->query("ALTER TABLE `products`
ADD PRIMARY KEY (`product_id`);");
$connection->query("ALTER TABLE `products`
MODIFY `product_id` int NOT NULL AUTO_INCREMENT");

$connection->query("CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `name` text NOT NULL,
  `comment` text NOT NULL,
  `date` text NOT NULL
  )");
$connection->query("INSERT INTO `comments` (`comment_id`, `name`, `comment`, `date`) VALUES
(1, 'Мария', 'Оставляю отзыв, потому что довольна сервисом и предоставленной услугой. Обязательно вернусь еще.', '2023-07-01'),
(2, 'Михаил', 'Удобно делать покупки, богатый ассортимент, быстрая доставка. Сервисом довольна.', '2023-07-02'),
(3, 'Даниил', 'Рекомендую от души. Все мастера своего дела и пример того, как нужно работать в любой сфере.', '2023-07-02'),
(4, 'Екатерина', 'Хочу выразить благодарность компании за проделанную работу.Вернемся к вам с другим заказом.', '2023-07-02')");

$connection->query("ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);");
$connection->query("ALTER TABLE `comments`
MODIFY `comment_id` int NOT NULL AUTO_INCREMENT");
?>