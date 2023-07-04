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
