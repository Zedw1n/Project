var swiper1 = new Swiper('.header-slider', {
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
});
var swiper2 = new Swiper('.review-slider', {
  loop: true,
  pagination: {
    el: '.swiper-pagination',
  },
});
