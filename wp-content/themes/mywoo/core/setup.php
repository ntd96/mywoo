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


function mytheme_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mywoo'),
        'footer'  => __('Footer Menu', 'mywoo'),
    ));
}
add_action('after_setup_theme', 'mytheme_menus');


