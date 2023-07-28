
var lazy_load_instance = new LazyLoad();
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

function get_comments(num_rows,comment_package,slide_count,cycles){
  wrapper.innerHTML = '';

  for (num_rows; num_rows>0; num_rows--) {

    let counter = num_rows - 1;
    
    for(slide_count+1; slide_count>0;slide_count--){

      let document_fragment = document.createDocumentFragment();
      let slide = document.createElement('div');
      slide.classList.add('swiper-slide');
      document_fragment.appendChild(slide);
      
      for(let i = 0; i<cycles; i++){
        
        if(counter < 0){break};
        
        let slide_review_card = document.createElement('div');
        slide_review_card.classList.add('review-card');

        let slide_review_card_name = document.createElement('div');
        slide_review_card_name.classList.add('review-card-name');
        slide_review_card_name.innerHTML = '- ' + comment_package['name'][counter];

        let slide_review_card_review = document.createElement('div');
        slide_review_card_review.classList.add('review-card-review');
        slide_review_card_review.innerHTML = "“" + comment_package['comment'][counter] + "”" ;

        let slide_review_card_date = document.createElement('div');
        slide_review_card_date.classList.add('review-card-date');
        slide_review_card_date.innerHTML = comment_package['date'][counter];

        slide_review_card.append(slide_review_card_name,slide_review_card_review,slide_review_card_date);
        slide.appendChild(slide_review_card);
        document_fragment.appendChild(slide);

        counter--;
      }
      wrapper.appendChild(document_fragment);
    }
  }

}

async function getData(){
  const response = await fetch("get_comments.php");
  let comment_package = await response.json();
  return comment_package

}

async function SliderMediaBuilder(slider_media_query){
  let comment_package = await getData();
  if (slider_media_query.matches) {
    let slide_count;
    if (comment_package['num_rows'] >10 ){
      slide_count = 10;
    } else {
      slide_count = comment_package['num_rows'];
    }
    let cycles = 1;
    get_comments(
    comment_package['num_rows'],
    comment_package,
    slide_count,
    cycles);
  } else {
    if(comment_package['num_rows'] % 4 == 1){
      let slide_count;
      if (comment_package['num_rows'] >20 ){
        slide_count = 5;
      } else {
        slide_count = Math.round(comment_package['num_rows'] / 4)+1;//Math.round(comment_package['num_rows'] / 4)+1;
      }
      let cycles = 4;
      get_comments(
      comment_package['num_rows'],
      comment_package,
      slide_count,
      cycles);
    } else{
      let slide_count;
      if (comment_package['num_rows'] >20 ){
        slide_count = 5;
      } else {
        slide_count = Math.round(comment_package['num_rows'] / 4);//Math.round(comment_package['num_rows'] / 4);
      };
      let cycles = 4;
      get_comments(
      comment_package['num_rows'],
      comment_package,
      slide_count,
      cycles);
    }
  }
  SwiperInitialization()
}

function openmodal() {
  modal.showModal();
}
function closemodal() {
  modal.close();
}

function CheckReviewValidation(form){
  let comment = form.querySelector('textarea').value;
  let name = form.querySelector('input').value;
  let warning = document.getElementById('review-invalid-warning')
  if(comment && name){
    if(comment.length < 100){
      form.submit()
      
    }else {
      warning.innerHTML = "Вы ввели " + comment.length + " символов";
    }
  } else {
    warning.innerHTML = "Заполните все поля!";
  }
  
}

document.getElementById('review-form').addEventListener('submit',function(event){
  event.preventDefault();
  CheckReviewValidation(this);
});

const wrapper = document.getElementById("review-slider-wrapper");
const slider_media_query = window.matchMedia('(max-width:800px)');
slider_media_query.addListener(SliderMediaBuilder);
SliderMediaBuilder(slider_media_query);


document.querySelectorAll('.product-button').forEach(function(btn){
  btn.addEventListener('click', function(){
    productID = btn.dataset.id
    document.querySelector('.order-product-id').value = productID
    
  })
})

