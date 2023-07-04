<?php   
    session_start();
    require_once 'db_connection.php' ;
?>

<!DOCTYPE html>
<html lang="Ru">
    <head>
        <meta charset="UTF-8">
        <title>Stationeries</title>
        <link rel="stylesheet" href="css/main.css"> <!--стили для сайта-->
        <link rel="stylesheet" href="slider/swiper-bundle.min.css"/> <!--стили слайдера-->
        <script src="slider/swiper-bundle.min.js"></script> <!--скрипты для слайдера-->
        
        <!--<link rel="stylesheet" href="css/modal.css"> стили для модального окна-->
    </head>
    <body>
        <div class="container">
            
            <header class="header">
                <div class="logo header__logo">
                    <img src="imgs/logo.svg" alt="">
                    <div class="logotext header__logo">
                    stationeries
                    </div>
                </div>
            </header>
            <div class="header-slider-container">
                <div class="swiper header-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="swiper-text">
                            <div class="heading">
                            Канцтовары для дома и офиса
                            </div>
                            Все что необходимо здесь
                        </div>
                        <div class="swiper-image">
                            <img src="imgs/cup.png" alt="">
                        </div>
                    </div>
                    <div class="swiper-slide">Slide 2</div>
                    <div class="swiper-slide">Slide 3</div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="main-container">
                <div class="main">
                    <p>Каталог</p>
                    <div class="catalog-container" id="catalog">
                        <?php 
                        $products = mysqli_query($connection, query:"SELECT * FROM `products`");
                        foreach($products as $product) {
                        ?>
                        <div class="product">
                            <div class="product-image">
                                <img src="<?= 'imgs/' . $product['image_url'] . '.jpg';?>" alt="">
                            </div>
                            <div class="product-name">
                                <?php echo $product['name']; ?>
                            </div>
                            <div class="product-description">
                                <?php echo $product['description']; ?>
                            </div>
                            <div data-id="<?php echo $product['product_id'];?>" class="product-button" onclick="openmodal()">
                                <button class="button" type="button">Заказать</button>
                            </div>
                        </div>
                        
                        <?php 
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
            <div class="review-container">
                <p>Отзывы</p>
                <div class="reviews">
                    <div class="swiper review-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide review-card-container">
                                <?php 
                                $comments = mysqli_query($connection, query:"SELECT * FROM `comments`");
                                foreach($comments as $comment){
                                ?>
                                <div class="review-card">
                                    <div class="review-card-name"><?= '- ' . $comment['name']?></div>
                                    <div class="review-card-review"><?= '“' . $comment['comment'] . '”'?></div>
                                    <div class="review-card-date"><?= $comment['date']?></div>
                                </div>
                                <?php 
                                }
                                ?>
                            </div>
                            <div class="swiper-slide review-card-container"></div>
                            <div class="swiper-slide review-card-container"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                        </div>
                        
                        <div class="review-form">                 
                            <div class="review-form-heading">Оставьте отзыв</div>
                            <form action="create_comment.php" method="post">
                                <?php 
                                if(!isset($_SESSION['commented'])) {
                                    echo('
                                        <textarea name="comment" cols="30" rows="10"></textarea>
                                        <div class="review-form-bottom">
                                            <p>Ваше имя</p>
                                            <input type="text" name="name">
                                            <button type="submit">Отправить</button>
                                        </div>
                                    ');
                                }   else {
                                    echo('
                                        <p>Спасибо за отзыв!</p>
                                    ');
                                }
                                    ?>
                                    <?php 
                                    if (isset($_SESSION['message'])) {
                                        echo('<div class="review-form-warning">' . $_SESSION['message'] . '</div>');
                                    }
                                    unset($_SESSION['message']);
                                    ?>
                            </form>
                        </div>
                </div>
            </div>

            <footer class="footer">
                <div class="logo footer__logo">
                    <img src="imgs/logo.svg" alt="">
                    <div class="logotext">
                    stationeries
                    </div>
                </div>
                <p>Copyright 2023. Stationeries</p>
                <p>Телефон: 8 913 951 56 18</p>
            </footer>
        </div>
        <dialog class="modal" id='modal'>
            <div class="modal-content">
                <div class="modal-header"><p>Оформление заказа</p><div class="close-modal-btn" onclick="closemodal()">&times;</div></div>
                <form action="create_order.php" method="post" class="modal-form" >
                    <div class="modal-body-form-input" name="prod-name">
                        <p>Ваше имя</p><input type="text" name="order-name"  required>
                    </div>
                    <div class="modal-body-form-input">
                        <p>Эл. почта</p><input type="text" name="order-email" required>
                    </div> 
                    <div class="modal-body-form-input">
                        <p>Телефон</p><input type="text" name="order-phone" pattern="[+7]{2}[0-9]{10}" required title="+7 (___) ___-____" placeholder="+7 (___) ___-____">
                    </div>
                    <input type="text" hidden name="order-product-id" class="order-product-id">
                    <button type="submit" class="modal-submit-btn">Заказать</button>
                    
                </form>
            </div>
        </dialog>
        <script src="jscode.js"></script> <!--файл инициализации слайдера-->
        
    </body>
    
</html>