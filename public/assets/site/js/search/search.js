$(window).scroll(function(){
    if ($(this).scrollTop() > 50) {
       $('.tabs-buttons').addClass('fix');
    } else {
       $('.tabs-buttons').removeClass('fix');
    }
});
$(window).scroll(function(){
    if ($(this).scrollTop() > 400) {
       $('.tabs-buttons').addClass('shadow-sm');
    } else {
       $('.tabs-buttons').removeClass('shadow-sm');
    }
});

let tabs = document.querySelectorAll('.nav-link');
tabs.forEach((item) => item.addEventListener('click',() => {
   document.getElementById("scrollToMe").scrollIntoView();
}))