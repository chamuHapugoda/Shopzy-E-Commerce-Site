const triggerOpen=document.querySelectorAll('[trigger-button]');
const triggerClose=document.querySelectorAll('[close-button]');
const overlay=document.querySelector('[data-overlay]');

for(let i=0; i <triggerOpen.length; i++){
    let currentID=triggerOpen[i].dataset.target,
    targetEl=document.querySelector(`#${currentID}`)

    const openData =function(){
        targetEl.classList.remove('active');
        overlay.classList.remove('active');
    };
    triggerOpen[i].addEventListener('click', function(){
        targetEl.classList.add('active');
        overlay.classList.add('active');
    });

    targetEl.querySelector('[close-button]').addEventListener('click', openData);
    overlay.addEventListener('click',openData);

}


///mobile menu submenu

const submenu = document.querySelectorAll('.child-trigger');
submenu.forEach((menu) => menu.addEventListener('click', function(e){
    e.preventDefault();
    submenu.forEach((item)=>item !=this ? item.closest('.has-child').classList.remove('active'):null);
    if(this.closest('.has-child').classList !='active'){
        this.closest('.has-child').classList.toggle('active');
    }

}))


//sorter
const sorter = document.querySelector('.sort-list');
if (sorter) {
  const sortLi = sorter.querySelectorAll('li'); // Get all li elements
  const optTrigger = sorter.querySelector('.opt-trigger');
  const dropdown = sorter.querySelector('ul');
  const valueSpan = sorter.querySelector('.opt-trigger span.value');

  if (optTrigger) {
    // Dropdown toggle
    optTrigger.addEventListener('click', function () {
      dropdown.classList.toggle('show');
    });
  }

  sortLi.forEach((item) => {
    const link = item.querySelector('a'); // Get the <a> inside the li
    if (link) {
      item.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default action
        sortLi.forEach((li) => li.classList.remove('active')); // Remove active from all
        this.classList.add('active'); // Add active to clicked item
        valueSpan.textContent = this.textContent.trim(); // Update displayed value
        dropdown.classList.remove('show'); // Close dropdown

        // Redirect to the URL in the link
        const sortParam = link.getAttribute('href');
        if (sortParam) {
          window.location.href = sortParam;
        }
      });
    }
  });
}


//tabbed

const trigger = document.querySelectorAll('.tabbed-trigger');
const content = document.querySelectorAll('.tabbed > div');

trigger.forEach((btn) => {
  btn.addEventListener('click', function() {
    let dataTarget = this.dataset.id;
    let body = document.querySelector(`#${dataTarget}`);

    // Remove 'active' class from all triggers and content
    trigger.forEach((b) => {
      b.parentNode.classList.remove('active'); // Assuming the active class is on the parent element
      b.classList.remove('active');
    });
    content.forEach((c) => c.classList.remove('active')); // Remove 'active' from all content

    // Add 'active' class to the clicked trigger and the corresponding content
    this.parentNode.classList.add('active');
    body.classList.add('active');
  });
});



//slider

const swiper = new Swiper('.sliderbox', {
   
    loop: true,
    effect:'fade',
    autoHeight:true,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
        clickable:true,
    },
  
  });

  //carousel
  const Carousel = new Swiper('.carouselbox', {
   
    spaceBetween:30,
    slidesPerView:'auto',
    centeredSlides:true,
  
    // If we need pagination
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',

    },
    breakpoints:{
      481: {
        slidesPerView:2,
        sliderPerGroup:1,
        centeredSlides:false,
      },
      640: {
        slidesPerView:3,
        sliderPerGroup:3,
        centeredSlides:false,
      },
      992: {
        slidesPerView:4,
        sliderPerGroup:4,
        centeredSlides:false,
      },
    }
  
  });


  //product image-page single
  const thumbImage = new Swiper('.thumbnail-image', {
   
    // loop: true,
    direction:'vertical',
    spaceBetween:15,
    slidesPerView:1,
    freeMode:true,
    watchSlidesProgress:true,
  
  });
  const mainImage = new Swiper('.main-image', {
   
    loop: true,
    autoHeight:true,

    pagination: {
      el: '.swiper-pagination',
      clickable:true,
    },
    thumbs: {
      swiper:thumbImage,
    },
  
  });


  



  