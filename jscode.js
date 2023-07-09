
var lazyLoadInstance = new LazyLoad();

var swiper2 = new Swiper('.review-slider', {
  loop: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});

var swiper1 = new Swiper('.header-slider', {
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
});



function openmodal() {
  modal.showModal();
}
function closemodal() {
  modal.close();
}

document.querySelectorAll('.product-button').forEach(function(btn){
  btn.addEventListener('click', function(){
    productID = btn.dataset.id
    document.querySelector('.order-product-id').value = productID
    
  })
})
