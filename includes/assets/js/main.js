;(function($){
    'use strict';

    var Testimonials = new Swiper(".home-slider", {
        slidesPerView: 1,
        // spaceBetween: 30, 
        loop: true,
        centeredSlides: false,
        autoplay: true,
        autoHeight: true,
        autoplay: {
          delay: 3000,
        },
        navigation: {
          nextEl: ".swiper-button-next-slide",
          prevEl: ".swiper-button-prev-slide",
        },
        fadeEffect: {
          crossFade: true,
        },
        // breakpoints: {
        //   1024: {
        //     slidesPerView: 1,
        //   },
        //   768: {
        //     slidesPerView: 2,
        //   },
        //   0: {
        //     slidesPerView: 1,
        //   }
        // },
      });
    

})(jQuery); // End of use strict