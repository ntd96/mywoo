<?php

/**
 * 
 */

if (!defined('ABSPATH')) {
    exit;
};

class Mini_Cart
{

    public function __construct()
    {
        /**
         * Update Cart Item
         */
        add_action('wp_ajax_update_cart_quantity', [$this, 'update_quantity_cart']);
        add_action('wp_ajax_nopriv_update_cart_quantity', [$this, 'update_quantity_cart']);

        /**
         * Remove Cart Item
         */
        add_action('wp_ajax_remove_cart_quantity', [$this, 'remove_cart_quantity']);
        add_action('wp_ajax_nopriv_remove_cart_quantity', [$this, 'remove_cart_quantity']);
    }

    public function update_quantity_cart()
    {

        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'nonce')) {
            wp_send_json_error(['message' => 'Invalid nonce']);
            wp_die();
        }

        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $quantity = intval($_POST['quantity']);

        if ($quantity < 1) {
            wp_send_json_error(['message' => 'Quantity must be at least 1']);
            wp_die();
        }

        $cart = WC()->cart;

        if (isset($cart->cart_contents[$cart_item_key])) {
            $cart->set_quantity($cart_item_key, $quantity);
            $cart->calculate_totals();
            wp_send_json_success([
                'cart_total' => WC()->cart->get_cart_total(),
                'cart_count' => WC()->cart->get_cart_contents_count(),
            ]);
        } else {
            wp_send_json_error(['message' => 'Cart item not found']);
        }
        wp_die();
    }

    public function remove_cart_quantity()
    {
        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'nonce')) {
            wp_send_json_error(['message' => 'Invalid nonce']);
            wp_die();
        }

        $cart = WC()->cart;
        $cart_item_key = sanitize_text_field($_POST['cart_key_item']);
        // $quantity = intval($_POST['quantity']);

        if (isset($cart->cart_contents[$cart_item_key])) {
            $cart->remove_cart_item($cart_item_key);
            $cart->calculate_totals();
            wp_send_json_success([
                'cart_total' => WC()->cart->is_empty() ? 'Không có sản phẩm nào trong giỏ hàng' : WC()->cart->get_cart_total(),
                'cart_count' => WC()->cart->get_cart_contents_count()
            ]);
        } else {
            wp_send_json_error(['message' => 'Cart item not found']);
        }

        wp_die();
    }
}

new Mini_Cart();
