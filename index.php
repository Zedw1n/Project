<?php require_once 'db_connection.php' ; ?>
<!DOCTYPE html>
<html lang="Ru">
    <head>
        <meta charset="UTF-8">
        <title>Stationeries</title>
        <link rel="stylesheet" href="css/main.css"> <!--стили для сайта-->
        <link rel="stylesheet" href="slider/swiper-bundle.min.css"/> <!--стили слайдера-->
        <script src="slider/swiper-bundle.min.js"></script> <!--скрипты для слайдера-->
        <link rel="stylesheet" href="css/modal.css"> <!--стили для модального окна-->
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
                            <div class="product-button">
                                <a href="#" class="order-link" data-name="Карандаш чернографитный аыва"><button>Заказать</button></a>
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
                                <div class="review-card">
                                    <div class="review-card-name">- Мария</div>
                                    <div class="review-card-review">“Оставляю отзыв, потому что довольна сервисом и предоставленной услугой. Обязательно вернусь еще.”</div>
                                    <div class="review-card-date">20.06.2023</div>
                                </div>
                                <div class="review-card">
                                    <div class="review-card-name">- Михаил</div>
                                    <div class="review-card-review">“Удобно делать покупки, богатый ассортимент, быстрая доставка. Сервисом довольна.”</div>
                                    <div class="review-card-date">20.06.2023</div>
                                </div>
                                <div class="review-card">
                                    <div class="review-card-name">- Даниил</div>
                                    <div class="review-card-review">“Рекомендую от души. Все мастера своего дела и пример того, как нужно работать в любой сфере.”</div>
                                    <div class="review-card-date">20.06.2023</div>
                                </div>
                                <div class="review-card">
                                    <div class="review-card-name">- Екатерина</div>
                                    <div class="review-card-review">“Хочу выразить благодарность компании за проделанную работу.Вернемся к вам с другим заказом.”</div>
                                    <div class="review-card-date">20.06.2023</div>
                                </div>
                                
                            </div>
                            <div class="swiper-slide review-card-container">
                            </div>
                            <div class="swiper-slide review-card-container">
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                        </div>
                        <div class="review-form">
                            <div class="review-form-heading">Оставьте отзыв</div>
                            <form action="create_comment.php " method="post">
                                <textarea name="comment" cols="30" rows="10"></textarea>
                                <div class="review-form-bottom">
                                    <p>Ваше имя</p>
                                    <input type="text" name="name">
                                    <button type="submit">Отправить</button>
                                </div>
                                <div class="review-form-warning">
                                    <?php?>
                                </div>
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
        <div class="modal" id="open-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Оформление заказа</h3>
                        <a href="#" class="close">×</a>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="modal-body-form-input">
                                <p>Ваше имя</p>
                                <input type="text">
                            </div>
                            <div class="modal-body-form-input">
                                <p>Эл. почта</p>
                                <input type="text">
                            </div>
                            <div class="modal-body-form-input">
                                <p>Телефон</p>
                                <input type="text">
                            </div>
                            <a href=""><button>Заказать</button></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="jscode.js"></script> <!--файл инициализации слайдера-->
        
    </body>
    
</html>