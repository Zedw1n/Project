
var lazyLoadInstance = new LazyLoad();
function SwiperInitialization() {
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
      el: '.swiper-pagination'
    },
  });
}

function get_comments(num_rows,CommentPackage,slide_count,cycles){
  wrapper.innerHTML = '';

  for (num_rows; num_rows>0; num_rows--) {

    let counter = num_rows - 1;
    
    for(slide_count+1; slide_count>0;slide_count--){

      let documentFragment = document.createDocumentFragment();
      let slide = document.createElement('div');
      slide.classList.add('swiper-slide');
      documentFragment.appendChild(slide);
      
      for(let i = 0; i<cycles; i++){
        
        //console.log(counter);
        if(counter == 0){break};
        let slide_review_card = document.createElement('div');
        slide_review_card.classList.add('review-card');

        let slide_review_card_name = document.createElement('div');
        slide_review_card_name.classList.add('review-card-name');
        slide_review_card_name.innerHTML = '- ' + CommentPackage['name'][counter];

        let slide_review_card_review = document.createElement('div');
        slide_review_card_review.classList.add('review-card-review');
        slide_review_card_review.innerHTML = "“" + CommentPackage['comment'][counter] + "”" ;

        let slide_review_card_date = document.createElement('div');
        slide_review_card_date.classList.add('review-card-date');
        slide_review_card_date.innerHTML = CommentPackage['date'][counter];

        slide_review_card.append(slide_review_card_name,slide_review_card_review,slide_review_card_date);
        slide.appendChild(slide_review_card);
        documentFragment.appendChild(slide);

        counter--;
      }
      wrapper.appendChild(documentFragment);
    }
  }

}

async function media(mediaQuery){
  const response = await fetch("get_comments.php");
  let CommentPackage = await response.json();
  if (mediaQuery.matches) {
    let slide_count;
    if (CommentPackage['num_rows'] >10 ){
      slide_count = 10;
    } else {
      slide_count = CommentPackage['num_rows'];
    }
    let cycles = 1;
    get_comments(
    CommentPackage['num_rows'],
    CommentPackage,
    slide_count,
    cycles);
  } else {
    if(CommentPackage['num_rows'] % 4 == 1){
      let slide_count;
      if (CommentPackage['num_rows'] >20 ){
        slide_count = 5;
      } else {
        slide_count = Math.round(CommentPackage['num_rows'] / 4)+1;//Math.round(CommentPackage['num_rows'] / 4)+1;
      }
      let cycles = 4;
      get_comments(
      CommentPackage['num_rows'],
      CommentPackage,
      slide_count,
      cycles);
    } else{
      let slide_count;
      if (CommentPackage['num_rows'] >20 ){
        slide_count = 5;
      } else {
        slide_count = Math.round(CommentPackage['num_rows'] / 4);//Math.round(CommentPackage['num_rows'] / 4);
      };
      let cycles = 4;
      get_comments(
      CommentPackage['num_rows'],
      CommentPackage,
      slide_count,
      cycles);
    }
  }
  SwiperInitialization()
}
const wrapper = document.getElementById("review-slider-wrapper");
const mediaQuery = window.matchMedia('(max-width:800px)');
mediaQuery.addListener(media);
media(mediaQuery);

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
