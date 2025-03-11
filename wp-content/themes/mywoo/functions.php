<?php

// if (!function_exists('get_theme_file_path')) {
//     require_once ABSPATH . 'wp-includes/theme.php';
// }

require_once get_theme_file_path() . '/core/enqueue.php';
require_once get_theme_file_path() . '/core/helpers.php';
require_once get_theme_file_path() . '/core/setup.php';
require_once get_theme_file_path() . '/inc/custom.php';

require_once get_theme_file_path() . '/ajax/auth.php';
require_once get_theme_file_path() . '/ajax/add-to-cart.php';
require_once get_theme_file_path() . '/ajax/mini-cart.php';
require_once get_theme_file_path() . '/inc/class-authRedirect.php';
