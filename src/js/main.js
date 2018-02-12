/*
* Hamburger menu script
*
* */

(function hamburgerMenuSlide() {

    const sidebarBox = document.querySelector('#menuSlideBox'),
        sideBarContainer = document.querySelector('.menu-slide__box-container'),
        sidebarBtn = document.querySelector('#menuSlideButton');

    sidebarBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        sideBarContainer.classList.toggle('active');
        sidebarBtn.classList.toggle('active');
        sidebarBox.classList.toggle('active');
    });

    // Close sliding menu when is click outside menu or closing button is clicked
    window.addEventListener('click', function(e) {

        if( !sidebarBox.contains(e.target) || e.target.className == 'menu-slide__btn-close' ) {
            if (sidebarBox.classList.contains('active')) {
                sideBarContainer.classList.remove('active');
                sidebarBtn.classList.remove('active');
                sidebarBox.classList.remove('active');
            }
        }
    });

    // Close sliding menu on esc button
    window.addEventListener('keydown', function(e) {
        if (sidebarBox.classList.contains('active') && e.keyCode === 27) {
            sideBarContainer.classList.remove('active');
            sidebarBtn.classList.remove('active');
            sidebarBox.classList.remove('active');
        }
    });

})();

jQuery(document).ready(function($) {


    /*
    * Home page slider setup and initialization
    * */

    $('#home-page-slider').slick({
        arrows: false,
        dots: false,
        infinite: true,
        speed: 500
    });


    /*
    * Carousel logotypes
    * */

    $(".owl-carousel").owlCarousel({
        items: 9,
        margin: 5,
        loop: true,
        autoplay: true,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        lazyLoad: true,
        responsiveClass:true,
        responsive:{
            0:{
                items:3,
                slideBy: 3
            },
            620:{
                items:4,
                slideBy: 4
            },
            992:{
                items:4,
                slideBy: 1
            },
            1200: {
                items: 5
            }
        }
    });
});