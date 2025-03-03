<?php
/* 
* Xử lí login form bằng AJAX
*/

if (!defined('ABSPATH')) {
    exit;
};



class Auth
{

    public function __construct()
    {
        /* Login form */
        add_action('wp_ajax_custom_login', [$this, 'login_handler']);
        add_action('wp_ajax_nopriv_custom_login', [$this, 'login_handler']);

        /* Register form */
        add_action('wp_ajax_custom_register', [$this, 'register_handler']);
        add_action('wp_ajax_nopriv_custom_register', [$this, 'register_handler']);
    }

    public function login_handler()
    {
        if (!isset($_POST['action']) || $_POST['action'] !== 'custom_login') {
            return;
        }
        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'nonce')) {
            wp_send_json_error(['message' => 'Lỗi bảo mật, vui lòng thử lại!']);
            wp_die();
        }
        if (empty($_POST['log-username']) || empty($_POST['log-password'])) {
            wp_send_json_error(['message' => 'Vui lòng nhập đầy đủ thông tin!']);
            wp_die();
        }
        $this->access_login();
    }

    public function register_handler()
    {
        if (!isset($_POST['action']) || $_POST['action'] !== 'custom_register') {
            return;
        }
        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'nonce')) {
            wp_send_json_error(['message' => 'Lỗi bảo mật, vui lòng thử lại!']);
            wp_die();
        }
        if (empty($_POST['reg-username']) || empty($_POST['reg-email']) || empty($_POST['reg-password'])) {
            wp_send_json_error(['message' => 'Vui lòng điền đầy đủ thông tin!']);
        }
        $this->access_register();
    }

    private function access_login()
    {
        $creds = array(
            'user_login' => sanitize_user($_POST['log-username']),
            'user_password' => $_POST['log-password'],
            'remember' => isset($_POST['log-remember']) ? true : false,
        );
        $user = wp_signon($creds, false); // Check có tồn tại ko, false là mặc định
        if (!is_wp_error($user)) {
            if (in_array('administrator', $user->roles)) {
                $redirect_url = admin_url();
            } elseif (in_array('subscriber', $user->roles)) {
                $redirect_url = home_url();
            } else {
                $redirect_url = home_url();
            }

            wp_send_json_success([
                'redirect' => $redirect_url,
                'message' => 'Đăng nhập thành công!'
            ]);
        } else {
            wp_send_json_error(['message' => $user->get_error_message()]);
        }
        wp_die();
    }

    private function access_register()
    {
        $username = sanitize_user($_POST['reg-username']);
        $email = sanitize_email($_POST['reg-email']);
        $pw = trim($_POST['reg-password']);
        $diplay_name = sanitize_text_field($_POST['reg-display-name']);
        $phone = sanitize_text_field($_POST['reg-phone']);


        if (empty($username) || (empty($email)) || empty($pw)) {
            wp_send_json_error([
                'message' => 'Vui lòng điền đầy đủ thông tin!'
            ]);
            wp_die();
        }

        if (username_exists($username)) {
            wp_send_json_error([
                'message' => 'Tên đăng nhập đã tồn tại'
            ]);
            wp_die();
        }

        if (email_exists($email)) {
            wp_send_json_error([
                'message' => 'Email đã được sử dụng!'
            ]);
            wp_die();
        }

        // Tạo user mới với mật khẩu đã hash pw trước khi lưu
        $user_id = wp_create_user($username, $pw, $email);

        if (is_wp_error($user_id)) {
            wp_send_json_error([
                'message' => 'Đăng ký thất bại, vui lòng thử lại!'
            ]);
            wp_die();
        } else {
            wp_update_user([
                'ID' => $user_id,
                'display' => $diplay_name ? $diplay_name : $username
            ]);
            update_user_meta($user_id, 'phone', $phone);
            wp_send_json_success([
                'message' => 'Đăng ký thành công! Vui lòng đăng nhập.',
                'redirect' => home_url('/login'),
            ]);
        }
        wp_die();
    }
}

new Auth();
