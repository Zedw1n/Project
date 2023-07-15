
var lazyLoadInstance = new LazyLoad();

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
    clickable: true,
  },
});

function LoadComments1Package() {
  let request = new XMLHttpRequest();
  request.open("GET", "get_comments.php");
  request.responseType = 'json';
  request.send();
  request.onload = function() {
    if (request.status == 200) {
      return request.response
    }
    else {
      console.log('failed getting comments');
    }
    
  };
}

function LoadCommentsPackage1() {
  let result = [];
  fetch("get_comments.php").then((response) => response.json()).then(response => result.push(response))
  return result
}
//LoadCommentsPackage1()
  
  let request = new XMLHttpRequest();
  request.open("GET","get_comments.php");
  //return request.response;

//LoadCommentsPackage();
let CommentPackage = LoadCommentsPackage1();
console.log(CommentPackage);

function get_comments(num_rows,name_inner, review_inner, date_inner,slide_count,cycles){
                
  wrapper.innerHTML = '';
  while(num_rows>0){
    let counter = 0;
    for(slide_count+1; slide_count>0;slide_count--){

      let documentFragment = document.createDocumentFragment();
      let slide = document.createElement('div');
      slide.classList.add('swiper-slide');
      documentFragment.appendChild(slide);
      
      for(let i = 0; i<cycles; i++){
          if(counter == num_rows){
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
        }
      }
    }
}

function media(mediaQuery){
  
  if (mediaQuery.matches) {
      console.log('rebuilding...');
      let slide_count = num_rows
      let cycles = 1;
      get_comments(
      num_rows,
      CommentPackage['name'],
      CommentPackage['comment'],
      CommentPackage['date'],
      slide_count,
      cycles);
  } else {
      console.log('rebuilding...');
      if(num_rows % 4 == 1){
          let slide_count = Math.round(num_rows / 4)+1;
          let cycles = 4;
          get_comments(
          num_rows,
          CommentPackage['name'],
          CommentPackage['comment'],
          CommentPackage['date'],
          slide_count,
          cycles);
      } else{
          let slide_count = Math.round(num_rows / 4);
          let cycles = 4;
          get_comments(
          num_rows,
          CommentPackage['name'],
          CommentPackage['comment'],
          CommentPackage['date'],
          slide_count,
          cycles);
      }
      
  }
}

const wrapper = document.getElementById("review-slider-wrapper");
const mediaQuery = window.matchMedia('(max-width:800px)');
//let CommentPackage = LoadCommentsPackage();
//let num_rows = CommentPackage['num_rows']
mediaQuery.addListener(media);
//media(mediaQuery);



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
