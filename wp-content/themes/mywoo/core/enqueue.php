<?php
/* 
*Hàm đăng kí style, script, hoạc localize
*/
function mytheme_enqueue_scripts()
{
    // CSS
    wp_enqueue_style('mytheme-style', get_stylesheet_uri());
    wp_enqueue_style('mytheme-custom', get_theme_file_uri() . '/assets/css/styles.css', array(), '1.0.0');
    wp_enqueue_style('mytheme-google-fonts', 'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap', array(), null);
    wp_enqueue_style('fancybox-css', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    // JavaScript
    wp_enqueue_script('mytheme-script', get_theme_file_uri() . '/assets/js/script.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), '3.6.0', true);
    wp_enqueue_script('font-awesome-kit', 'https://kit.fontawesome.com/9a811ce03d.js', array(), null, false);
    wp_enqueue_script('fancybox-js', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), null, true);

    wp_localize_script('mytheme-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('nonce')
    ));
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');