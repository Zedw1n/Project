<?php   
    session_start();
    require_once 'db_connection.php' ;
?>

<!DOCTYPE html>
<html lang="Ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stationeries</title>
        <link rel="stylesheet" href="css/main.css"> <!--стили для сайта-->
        <link rel="stylesheet" href="modules/swiper-bundle.min.css"/> <!--стили слайдера-->
        <script src="modules/swiper-bundle.min.js"></script> <!--скрипты для слайдера-->
    </head>
    <body>
        <div class="container">
            
            <header class="header">
                <div class="logo header__logo">
                    <img class="lazy" data-src="imgs/logo.svg" alt="">
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
                            Все что необходимо здесь!
                        </div>
                        <div class="swiper-image">
                            <img class="lazy" data-src="imgs/cup.png" alt="">
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
                            <img class="lazy" data-src="imgs/cup.png" alt="">
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
                            <img class="lazy" data-src="imgs/cup.png" alt="">
                        </div>
                    </div>
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
                                <img class="lazy" data-src="<?= 'imgs/' . $product['image_url'] . '.jpg';?>" alt="">
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
                        <div class="swiper-wrapper" id="wrapper">
                        </div>
                        <div class="swiper-pagination"></div>
                        </div>
                        <div class="review-form">                 
                            <div class="review-form-heading">Оставьте отзыв</div>
                            <form action="create_comment.php" method="post">
                                <?php 
                                if(!isset($_SESSION['commented'])) {
                                    echo('
                                        <textarea name="comment" ></textarea>
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
                    <img class="lazy" data-src="imgs/logo.svg" alt="">
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
        <script>
        
            <?php 
                $comments = mysqli_query($connection, query:"SELECT * FROM `comments`");  
                $names = $review = $date = array();
                foreach($comments as $comment){

                    array_push($names, $comment['name']);
                    array_push($review, $comment['comment']);
                    array_push($date, $comment['date']);
                };?>
            function get_comments(num_rows,name_inner, review_inner, date_inner,slide_count,cycles){
                
                wrapper.innerHTML = '';
                while(num_rows>0){
                    let counter = 0;
                    for(slide_count; slide_count>0;slide_count--){
                        let documentFragment = document.createDocumentFragment();
                        let slide = document.createElement('div');
                        slide.classList.add('swiper-slide');
                        documentFragment.appendChild(slide);
                        
                        for(let i = 0; i<cycles; i++){
                            if(counter == num_rows){
                                console.log('done');
                                break
                            };
                            let slide_review_card = document.createElement('div');
                            slide_review_card.classList.add('review-card');

                            let slide_review_card_name = document.createElement('div');
                            slide_review_card_name.classList.add('review-card-name');
                            slide_review_card_name.innerHTML = '- ' + name_inner[counter];

                            let slide_review_card_review = document.createElement('div');
                            slide_review_card_review.classList.add('review-card-review');
                            slide_review_card_review.innerHTML = "“" + review_inner[counter] + "”" ;

                            let slide_review_card_date = document.createElement('div');
                            slide_review_card_date.classList.add('review-card-date');
                            slide_review_card_date.innerHTML = date_inner[counter];

                            slide_review_card.append(slide_review_card_name,slide_review_card_review,slide_review_card_date);
                            slide.appendChild(slide_review_card);
                            documentFragment.appendChild(slide);
                            
                            counter++;
                        };
                        wrapper.appendChild(documentFragment);
                        
                    };
                    num_rows--;
                };
            }

            function media(mediaQuery){
                if (mediaQuery.matches) {
                    console.log('rebuilding...');
                    let slide_count = num_rows;
                    let cycles = 1;
                    get_comments(
                    num_rows,
                    <?php echo(json_encode($names, JSON_UNESCAPED_UNICODE))?>,
                    <?php echo(json_encode($review, JSON_UNESCAPED_UNICODE))?>,
                    <?php echo(json_encode($date, JSON_UNESCAPED_UNICODE))?>,
                    slide_count,
                    cycles);
                } else {
                    let slide_count = Math.round(num_rows / 4);
                    let cycles = 4;
                    get_comments(
                    num_rows,
                    <?php echo(json_encode($names, JSON_UNESCAPED_UNICODE))?>,
                    <?php echo(json_encode($review, JSON_UNESCAPED_UNICODE))?>,
                    <?php echo(json_encode($date, JSON_UNESCAPED_UNICODE))?>,
                    slide_count,
                    cycles);
                }
            }

            let num_rows = <?php echo($comments -> num_rows);?>;
            const wrapper = document.getElementById("wrapper");
            const mediaQuery = window.matchMedia('(max-width:800px)');
            mediaQuery.addListener(media);
            media(mediaQuery);

        </script>
        <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.3/dist/lazyload.min.js"></script>
        <script src="jscode.js"></script> <!--файл инициализации слайдера-->
    </body>
    
</html>