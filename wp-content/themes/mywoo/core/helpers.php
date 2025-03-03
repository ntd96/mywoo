<?php

/**
 * Hàm hỗ trợ cần thiết cho theme
 */

function debug_to_console($data, $context = 'Debug in Console')
{

    // Buffering to solve problems frameworks, like header() in this and not a solid return.
    ob_start();

    $output  = 'console.info(\'' . $context . ':\');';
    $output .= 'console.log(' . json_encode($data) . ');';
    $output  = sprintf('<script>%s</script>', $output);

    echo $output;
}

// Disable emoji cho bớt nặng
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

