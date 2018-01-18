/*
* Hamburger menu script
*
* */

(function hamburgerMenuSlide() {

    const sidebarBox = document.querySelector('#menuSlideBox'),
        sidebarBtn = document.querySelector('#menuSlideButton');

    sidebarBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        sidebarBtn.classList.toggle('active');
        sidebarBox.classList.toggle('active');
    });

    // Close sliding menu when is click outside menu
    document.body.addEventListener('click', function(e) {
        if (sidebarBox.classList.contains('active')) {
            sidebarBtn.classList.remove('active');
            sidebarBox.classList.remove('active');
        }
    });

    // Close sliding menu on esc button
    window.addEventListener('keydown', function(e) {
        if (sidebarBox.classList.contains('active') && e.keyCode === 27) {
            sidebarBtn.classList.remove('active');
            sidebarBox.classList.remove('active');
        }
    });

})();

jQuery(document).ready(function($) {

    $('.slider').slick({
        dots: false,
        infinite: true,
        speed: 500
    });

});