jQuery(document).ready(function ($) {
  $('#v-pills-tab[data-mouse="hover"] button').hover(function () {
    $(this).tab('show');
  });
  $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
    var target = $(e.relatedTarget).attr('href');
    $(target).removeClass('active');
  })
});

const imageComparisonSliders = document.querySelectorAll('[data-component="image-comparison-slider"]');

function setSliderstate(e, element) {
  const sliderRange = element.querySelector('[data-image-comparison-range]');

  if (e.type === 'input') {
    sliderRange.classList.add('image-comparison__range--active');
    return;
  }

  sliderRange.classList.remove('image-comparison__range--active');
  element.removeEventListener('mousemove', moveSliderThumb);
}

function moveSliderThumb(e) {
  const sliderRange = e.currentTarget.querySelector('[data-image-comparison-range]');
  const thumb = e.currentTarget.querySelector('[data-image-comparison-thumb]');
  let position = e.layerY - 20;

  if (e.layerY <= sliderRange.offsetTop) {
    position = -20;
  }

  if (e.layerY >= sliderRange.offsetHeight) {
    position = sliderRange.offsetHeight - 20;
  }

  thumb.style.top = `${position}px`;
}

function moveSliderRange(e, element) {
  const value = e.target.value;
  const slider = element.querySelector('[data-image-comparison-slider]');
  const imageWrapperOverlay = element.querySelector('[data-image-comparison-overlay]');

  slider.style.left = `${value}%`;
  imageWrapperOverlay.style.width = `${value}%`;

  element.addEventListener('mousemove', moveSliderThumb);
  setSliderstate(e, element);
}

function init(element) {
  const sliderRange = element.querySelector('[data-image-comparison-range]');

  if ('ontouchstart' in window === false) {
    sliderRange.addEventListener('mouseup', e => setSliderstate(e, element));
    sliderRange.addEventListener('mousedown', moveSliderThumb);
  }

  sliderRange.addEventListener('input', e => moveSliderRange(e, element));
  sliderRange.addEventListener('change', e => moveSliderRange(e, element));
}

imageComparisonSliders.forEach(init);


var swiper = new Swiper(".swiper-suggest", {
  spaceBetween: 8,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
  breakpoints: {
    0: {
      slidesPerView: 3.25,
      spaceBetween: 8,
    },
    576: {
      slidesPerView: 4,
      spaceBetween: 8,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 8,
    },
    992: {
      slidesPerView: 2.75,
      spaceBetween: 8,
    },
    1200: {
      slidesPerView: 3.75,
      spaceBetween: 8,
    },
    1400: {
      slidesPerView: 4.75,
      spaceBetween: 8,
    },
    1600: {
      slidesPerView: 6,
      spaceBetween: 8,
    },
  },
});

document.addEventListener("DOMContentLoaded", function() {
  const textBox = document.getElementById("text-box");
  const moreButton = document.getElementById("more-button");
  const expandedCheckbox = document.getElementById("expanded");

  if (textBox.textContent.length <= 500) {
      moreButton.style.display = "none";
      textBox.classList.remove("collapsed");
  } else {
      moreButton.style.display = "flex";
      textBox.classList.add("after");
  }
});