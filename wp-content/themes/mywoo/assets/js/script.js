jQuery(document).ready(function ($) {

    // INIT FANCYBOX
    $('[data-fancybox]').fancybox({
        touch: false
    });

    // ----- START HEADER -----
    // SCROLL FIXED HEADER
    let header = $(".site-header");
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 0) {
            header.addClass("active fixed")
        } else {
            header.removeClass("active fixed")
        }
    });

    // HUMBERGER
    $(".menu-toggle").click(function (e) {

        $("body").toggleClass("menu-open");
        $('#overlay').addClass('active');
    });
    $(".main-navigation .icon-close, #overlay").click(function () {
        $("body").removeClass("menu-open");
        $('#overlay').removeClass('active');
    });

    // CART
    $("#cart-toggle").on("click", function (e) {
        e.preventDefault();
        $("#slide-cart, #overlay").addClass("active");
    });

    $("#close-cart, #overlay").on("click", function () {
        $("#slide-cart, #overlay").removeClass("active");
    });

    // Click outsite


    // ----- END HEADER  -----

})