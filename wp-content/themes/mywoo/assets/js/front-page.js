jQuery(document).ready(function ($) {
    // Hero Banner
    $('.hero-slider').slick({
        autoplay: true,
        autoplaySpeed: 5000, 
        arrows: true, // Bật mũi tên
        dots: true,   // Bật dots
        fade: true,   
        speed: 1200,  
        infinite: true,
        draggable: true,
        swipe: true,
        prevArrow: '<button class="slick-prev"><svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg></button>',
        nextArrow: '<button class="slick-next"><svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg></button>'
    });

    let tabs = $('.products .tab-link');
    let panes = $('.products .tab-pane');

    tabs.first().addClass('active');
    panes.first().addClass('active');

    tabs.on('click', function () {
        if ($(this).hasClass('active')) return;

        tabs.removeClass('active');
        $(this).addClass('active');

        let idTabContent = $(this).data('id-tab-content');

        panes.removeClass('active');
        $('#' + idTabContent).addClass('active');
    });


});