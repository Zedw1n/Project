<?php  
    session_start();
    require_once 'db_connection.php' ;
    require_once 'config.php' ;
    if(!$config['production']){
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);
    }
    $products = mysqli_query($connection, query:"SELECT * FROM `products`");
    $comments = mysqli_query($connection, query:"SELECT * FROM `comments`");  
    $names = $review = $date = array();
    foreach($comments as $comment){

        array_push($names, $comment['name']);
        array_push($review, $comment['comment']);
        array_push($date, $comment['date']);
    };
?>

<!DOCTYPE html>
<html lang="Ru">
    <head>
        <title>Stationeries</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="Канцелярия, товары к школе, тетрадные принадлежности, школа">
        <meta name="description" content="Товары канцелярии по низкой цене и быстрой доставки на дом">
        <meta name="author" content="Stationeries Inc.">
        <link rel="preload" href="imgs\cup.png" as="image"/>
        <link rel="preload" href="imgs\logo.svg" as="image"/>
        <link rel="preload" href="fonts/Montserrat-Bold.woff" as="font"  crossorigin/>
        <link rel="preload" href="fonts/Montserrat-Medium.woff" as="font" crossorigin/>
        <link rel="preload" href="fonts/Montserrat-Regular.woff" as="font"  crossorigin/>
        <link rel="preload" href="fonts/Montserrat-Light.woff" as="font"  crossorigin/>
        <link rel="stylesheet" href="modules/swiper/swiper-bundle.min.css"/> <!--стили слайдера-->
        <link rel="stylesheet" href="css/style.min.css"> <!--стили для сайта-->
        <link rel="shortcut icon" href="imgs/logo.svg" type="image/svg">    
        <script defer src="modules/swiper/swiper-bundle.min.js"></script> <!--скрипты для слайдера-->
        <script defer src="//cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.3/dist/lazyload.min.js"></script>
        <script defer src="jscode.js"></script> <!--файл инициализации слайдера--> 
    </head>
    <body>
        <div class="container">   
            <header class="header">
                <div class="logo header__logo">
                    <img class="lazy" data-src="imgs/logo.svg" alt="logo">
                    <div class="logotext header__logo">
                    stationeries
                    </div>
                </div>
            </header>
            <figure class="header-slider-container">
                <div class="swiper header-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="swiper-text">
                            <div class="heading">
                            Канцтовары для дома и офиса
                            </div>
                            Все что необходимо здесь!
                        </div>
                        <div class="swiper-image">
                            <img src="imgs/cup.png" alt="cup">
                        </div>
                    </div>
                    <div class="swiper-slide">
                    <div class="swiper-text">
                            <div class="heading">
                            Надежное качество товаров
                            </div>
                            Проверено временем!
                        </div>
                        <div class="swiper-image">
                            <img src="imgs/cup.png" alt="cup">
                        </div>
                    </div>
                    <div class="swiper-slide">
                    <div class="swiper-text">
                            <div class="heading">
                            Хорошая оценка покупателей
                            </div>
                            Не поддельные!
                        </div>
                        <div class="swiper-image">
                            <img src="imgs/cup.png" alt="cup">
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                </div>
            </figure>
            <section class="main-container">
                <div class="main">
                    <p>Каталог</p>
                    <div class="catalog-container" id="catalog">
                        <?php foreach($products as $product) {?>
                        <div class="product">
                            <div class="product-image"><img class="lazy" data-src="<?= 'imgs/' . $product['image_url'];?>" alt="<?= $product['name']; ?>"></div>
                            <div class="product-name"><?= $product['name']; ?></div>
                            <div class="product-description"><?= mb_strtoupper($product['description']); ?></div>
                            <div data-id="<?= $product['product_id'];?>" class="product-button" onclick="openmodal()"><button class="button" type="button">Заказать</button></div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
            <article class="review-container">
                <p>Отзывы</p>
                <div class="reviews"> 
                    <div class="swiper review-slider">
                        <div class="swiper-wrapper" id="review-slider-wrapper"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="review-form">                 
                    <?php if(!isset($_SESSION['commented'])) { echo('<div class="review-form-heading">Оставьте отзыв</div>');} ?>
                        <form action="create_comment.php" method="POST" id="review-form" name="review-form" >
                            <?php 
                            if(!isset($_SESSION['commented'])) {
                                echo('
                                    <textarea name="comment" placeholder="Не более 100 символов" id="textarea-review-form"></textarea>
                                    <div class="review-form-bottom">
                                        <p><label for="review-name-input"">Ваше имя</label></p>
                                        <input type="text" name="name" id="review-name-input">
                                        <button type="submit">Отправить</button>
                                    </div>
                                ');
                            }   else {
                                echo('
                                    <p>Спасибо за отзыв!</p>
                                ');
                            }
                                ?>
                            <div class="review-form-warning" id="review-invalid-warning"></div>
                        </form>
                    
                    </div>
                </div>
            </article>
            <footer class="footer">
                <div class="logo footer__logo">
                    <img class="lazy" data-src="imgs/logo.svg" alt="logo">
                    <div class="logotext">stationeries</div>
                </div>
                <p>Copyright 2023. Stationeries</p>
                <p>Телефон: 8 913 951 56 18</p>
            </footer>
        </div> 
    </body>
        <dialog class="modal" id='modal'>
            <div class="modal-content">
                <div class="modal-header"><p>Оформление заказа</p>
                    <div class="close-modal-btn" onclick="closemodal()">&times;</div>
                </div>
                <form action="create_order.php" method="post" class="modal-form" >
                    <div class="modal-body-form-input" name="prod-name">
                        <p>Ваше имя</p><input type="text" name="order-name"  required>
                    </div>
                    <div class="modal-body-form-input">
                        <p>Эл. почта</p><input type="email" name="order-email" required>
                    </div> 
                    <div class="modal-body-form-input">
                        <p>Телефон</p><input type="tel" name="order-phone" pattern="[+7]{2}[0-9]{10}" required title="+7 (___) ___-____" placeholder="+7 (___) ___-____">
                    </div>
                    <input type="text" hidden name="order-product-id" class="order-product-id">
                    <button type="submit" class="modal-submit-btn">Заказать</button>
                    
                </form>
            </div>
        </dialog>
        
        
</html>