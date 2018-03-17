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
    * Single page slider
    * */

    $('#singlePage-slider').slick({
        arrows: false,
        dots: true,
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
                items:2,
                slideBy: 2
            },
            600:{
                items:3,
                slideBy: 3
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

    /* Hide Comment Box */

    $('.comments .comment-box .comment-form-container').hide();
    $('.reply').on('click', function() {
        $(this).next().slideToggle(100);
        $(this).next().find('textarea').focus();
    });

    $('.post-main > .comment-box > .comment-form-container').insertAfter($('.post-main > .comment-box > .comments > .comments-title'));

});

/*
 * Google Map initialization
 * */
var map;
function initMap() {

    var divMap, placeLat, placeLang;

    divMap = document.querySelector('.gmap');
    placeLat = parseFloat(divMap.getAttribute('data-lat'));
    placeLang = parseFloat(divMap.getAttribute('data-lng'));

    map = new google.maps.Map(divMap, {
        center: {lat: placeLat, lng: placeLang},
        zoom: 16,
        scrollwheel: false
    });

    new google.maps.Marker({
        map: map,
        position: {lat: placeLat, lng: placeLang}
    });

    google.maps.event.addDomListener(window, "resize", function () {
        map.setCenter({lat: placeLat, lng: placeLang})
    })
}
