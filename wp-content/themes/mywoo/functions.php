<?php
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

    wp_localize_script('mytheme-script', 'custom_login', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('ajax-login-nonce')
    ));
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

// Ẩn version wp
function mytheme_remove_wp_version()
{
    return '';
}
add_filter('the_generator', 'mytheme_remove_wp_version');


function mytheme_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'mywoo'),
        'footer'  => __('Footer Menu', 'mywoo'),
    ));
}
add_action('after_setup_theme', 'mytheme_menus');


function mytheme_disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'mytheme_disable_emojis');

// Xử lí login form
function custom_ajax_login()
{
    check_ajax_referer('ajax-login-nonce', 'security');

    $creds = array(
        'user_login'    => $_POST['log'],
        'user_password' => $_POST['pwd'],
        'remember'      => isset($_POST['rememberme']) ? true : false,
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        echo json_encode(array('status' => false, 'message' => 'Invalid username or password.'));
    } else {
        echo json_encode(array('status' => true, 'message' => 'Login successful, redirecting...'));
    }

    wp_die();
}

add_action('wp_ajax_nopriv_custom_ajax_login', 'custom_ajax_login');
add_action('wp_ajax_custom_ajax_login', 'custom_ajax_login');
