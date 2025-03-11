<?php

/**
 * Tính năng:
 * 1: wp-admin, wp-login.php direct về /login
 * 2: USer đã login thì cứ direct về trang home || admin tuỳ role
 */

if (!defined('ABSPATH')) {
    exit;
};


class AuthRedirect
{
    public function __construct()
    {
        /**
         *  Redirect wp-login.php và wp-admin nếu chưa đăng nhập
         */
        add_action('init', [$this, 'redirect_login_page']);
    }

    public function redirect_login_page()
    {

        /**
         * Bỏ qua nếu là ajax request
         * Vì khi request ajax, nó bắn sang admin ajax, mà mình direct wp-admin về login => nó skip phần admin ajax, chỉ direct về login
         */
        if (defined('DOING_AJAX') && DOING_AJAX) {
            return;
        }

        /**
         * Nếu đang truy cập trang admin mà chưa login thì direct sang /login
         */
        if (is_admin() && !is_user_logged_in()) {
            wp_redirect(home_url('/login'));
            exit;
        }

        $request_uri = $_SERVER['REQUEST_URI'];

        /**
         * Nếu đang ở trang login.php và chưa login thì direct sang /login
         */
        if (strpos($request_uri, 'wp-login.php') !== false && !is_user_logged_in()) {
            wp_redirect(home_url('/login'));
            exit;
        }

        /**
         * Trường hợp hiếm hoi nếu user đã login nhưng cố gắng truy cập login thì cho direct về lại
         * Func này có hoặc ko có đều được.
         */
        if (is_user_logged_in() && is_page('login')) {
            $user = wp_get_current_user();
            if (in_array('administrator', (array) $user->roles)) {
                wp_redirect(admin_url());
            } else {
                wp_redirect(home_url());
            };
            exit;
        }
    }
}

new AuthRedirect();
