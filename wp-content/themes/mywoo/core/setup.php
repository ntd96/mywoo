<?php

/*
* Hàm Initial theme
*/

function mytheme_setup()
{
    add_theme_support('title-tag'); // Tự động thêm title vào <head>
    add_theme_support('post-thumbnails'); // Hỗ trợ ảnh đại diện
    add_theme_support('custom-logo'); // Hỗ trợ logo tùy chỉnh
    add_theme_support('automatic-feed-links'); // Tạo RSS tự động - cho nhận diện những cái gì mới
    add_theme_support('site-icon'); // add favicon cho tab website
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption')); // HTML5
}
add_action('after_setup_theme', 'mytheme_setup');


/**
 * Add Menu Theme
 */
function mytheme_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mywoo'),
        'footer'  => __('Footer Menu', 'mywoo'),
    ));
}
add_action('after_setup_theme', 'mytheme_menus');

/**
 * Add Support Woo
 */
add_theme_support('woocommerce');


/**
 * Disable emoji cho bớt nặng
 */
function mytheme_disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'mytheme_disable_emojis');

// Ẩn version wp - tránh hacker biết site đang dùng wp version
function mytheme_remove_wp_version()
{
    return '';
}
add_filter('the_generator', 'mytheme_remove_wp_version');

// Giúp WordPress nhận diện cả hai template nằm trong cấu trúc templates/user
function register_custom_templates($templates)
{
    $templates['templates/user/login.php'] = 'Custom Login';
    return $templates;
}
add_filter('theme_page_templates', 'register_custom_templates');