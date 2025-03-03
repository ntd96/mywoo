<?php
/* 
*Hàm đăng kí style, script, hoạc localize
*/
function mytheme_enqueue_scripts()
{
    // CSS
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());
    // Style Global
    wp_enqueue_style('mytheme-custom', get_theme_file_uri() . '/assets/css/styles.css', array(), '1.0.0');
    // Fonts
    wp_enqueue_style('custom-fonts', get_template_directory_uri() . '/assets/css/fonts.css', array(), null);
    // Fancy Box
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    // Slick Slide
    wp_enqueue_style('slick-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', array(), '1.8.1');

    // JavaScript
    // Enqueue jQuery (đảm bảo jQuery đã được WP load)
    wp_enqueue_script('jquery');
    // Scriptt Global
    wp_enqueue_script('mytheme-script', get_theme_file_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
    // Ajax
    wp_enqueue_script('ajaxJs', get_theme_file_uri() . '/assets/js/ajax.js', array(), '1.0.0', true);
    // Jquery
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    // Font-awsome
    wp_enqueue_script('font-awesome-kit', 'https://kit.fontawesome.com/9a811ce03d.js', array(), null, false);
    // Fancy Box
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);
    // Slick Slide
    wp_enqueue_script('slick-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);
    // Locallize
    wp_localize_script('ajaxJs', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('nonce')
    ));
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');
