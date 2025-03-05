jQuery(document).ready(function ($) {
    // Hero Banner
    $('.hero-slider').slick({
        autoplay: true,
        autoplaySpeed: 5000, // 3 giây chuyển slide
        arrows: false, // Ẩn mũi tên
        dots: false, // Hiển thị chấm
        fade: true, // Hiệu ứng mờ dần
        speed: 1200, // Tốc độ chuyển
        infinite: true,
        draggable: true,
        swipe: true
    });
});