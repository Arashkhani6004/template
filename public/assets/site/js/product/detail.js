var mzOptions = {
    textExpandHint: "برای بزرگنمایی کلیک کنید",
    textHoverZoomHint: "",
    zoomMode: "magnifier",
    zoomWidth: 200,
    zoomHeight: 200,
    transitionEffect: false,
};

var swiper = new Swiper(".swiper-selector", {
    spaceBetween: 30,
    slidesPerView: 4,
    grabCursor: true,
    autoplay: {
      delay: 1500,
      disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    breakpoints: {
      0: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      576: {
        slidesPerView: 4.5,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 8,
        spaceBetween: 10,
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 10,
      },
      1400: {
        slidesPerView: 3.75,
        spaceBetween: 10,
      },
      1600: {
        slidesPerView: 4.5,
        spaceBetween: 10,
      },
    },
  });
  var swiper = new Swiper(".swiper-team", {
    spaceBetween: 30,
    slidesPerView: 5.75,
    grabCursor: true,
    centeredSlides: true,
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    breakpoints: {
      0: {
        slidesPerView: 1.25,
        spaceBetween: 10,
      },
      576: {
        slidesPerView: 2.75,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 3.75,
        spaceBetween: 30,
      },
      992: {
        slidesPerView: 4,
        spaceBetween: 30,
      },
      1200: {
        slidesPerView: 4.75,
        spaceBetween: 30,
      },
      1400: {
        slidesPerView: 5,
        spaceBetween: 30,
      },
      1600: {
        slidesPerView: 5.75,
        spaceBetween: 30,
      },
    },
  });


