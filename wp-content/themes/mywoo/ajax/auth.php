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
        add_action('wp_ajax_custom_login', [$this, 'login_handler']);
        add_action('wp_ajax_nopriv_custom_login', [$this, 'login_handler']);
    }

    public function login_handler()
    {
        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'nonce')) {
            wp_send_json_error(['message' => 'Lỗi bảo mật, vui lòng thử lại!']);
            wp_die();
        }
        if (empty($_POST['username']) || empty($_POST['password'])) {
            wp_send_json_error(['message' => 'Vui lòng nhập đầy đủ thông tin!']);
            wp_die();
        }
        $this->access_login();
    }

    public function register_handler() {
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
        $user = wp_signon($creds, false);
        if (!is_wp_error($user)) {
            $redirect_url = home_url(); // Chuyển hướng về trang chủ
            wp_send_json_success([
                'redirect' => $redirect_url,
                'message' => 'Đăng nhập thành công!'
            ]);
        } else {
            wp_send_json_error(['message' => $user->get_error_message()]);
        }
        wp_die();
    }

    private function access_register() {
        
    }

}

new Auth();
