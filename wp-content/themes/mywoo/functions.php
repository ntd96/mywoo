<?php

// if (!function_exists('get_theme_file_path')) {
//     require_once ABSPATH . 'wp-includes/theme.php';
// }

require_once get_theme_file_path() . '/core/enqueue.php';
require_once get_theme_file_path() . '/core/helpers.php';
require_once get_theme_file_path() . '/core/setup.php';
require_once get_theme_file_path() . '/inc/custom.php';

require_once get_theme_file_path() . '/ajax/auth.php';
require_once get_theme_file_path() . '/ajax/class-archive-product.php';
require_once get_theme_file_path() . '/ajax/add-to-cart.php';
require_once get_theme_file_path() . '/ajax/mini-cart.php';
require_once get_theme_file_path() . '/inc/class-authRedirect.php';
require_once get_theme_file_path() . '/inc/class-productHelper.php';

function add_cors_http_header() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
}
add_action('init', 'add_cors_http_header');
