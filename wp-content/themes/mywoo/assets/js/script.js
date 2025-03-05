jQuery(document).ready(function ($) {
    // header
    $('[data-fancybox]').fancybox({
        touch: false
    });

    $(".menu-toggle").click(function () {
        $("body").toggleClass("menu-open");
        let isMenuOpen = $('body').hasClass('menu-open');
        $('.menu-toggle span').css('background', isMenuOpen ? '#fff' : '#333' );
        $(".menu-toggle").toggleClass("fixed-position");
    });

})