<?php

/**
 * Xử lí ajax cho item loop
 */

if (!defined('ABSPATH')) {
    exit;
}

class Custom_add_to_cart
{
    public function __construct()
    {
        /**
         * Add cart từ user khi click button
         */
        add_action('wp_ajax_custom_add_to_cart', [$this, 'handle_add_to_cart']);
        add_action('wp_ajax_nopriv_custom_add_to_cart', [$this, 'handle_add_to_cart']);
    }

    public function handle_add_to_cart()
    {
        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'nonce')) {
            wp_send_json_error();
        }

        if (!isset($_POST['product_id'])) {
            wp_send_json_error(['message' => 'Không tìm thấy sản phẩm']);
        }

        /**
         * absint ép thành int và luôn >= 0
         */
        $product_id = absint($_POST['product_id']);
        /**
         * woocommerce/includes/class-wc-cart.php
         */
        $added = WC()->cart->add_to_cart($product_id);

        if ($added) {
            /**
             * Case: sau khi update count cart -> click icon cart trên header -> update mini cart, nếu ko, sẽ ko hiển thị sp
             * Update mini_cart trong div cart-content từ icon cart
             * key: woocomverce_mini_cart() hàm gọi woo/cart/mini-cart.php
             */
            ob_start();
            woocommerce_mini_cart();
            $mini_cart = ob_get_clean();
            wp_send_json_success([
                'cart_count' => WC()->cart->get_cart_contents_count(),
                'mini_cart' => $mini_cart
            ]);
        } else {
            wp_send_json_error([
                'message' => 'Không thể thêm sản phẩm vào giỏ hàng'
            ]);
        }
    }
}

new Custom_add_to_cart();
