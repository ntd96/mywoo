<?php

/**
 * Áp dụng SingleTon cho class ProductHelper
 */

class ProductHelper
{
    private static $instance = null;

    public function __construct() {}
    /**
     * Khai báo instace cho class
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new ProductHelper();
        }
        return self::$instance;
    }
    /**
     * Lấy tiêu đề của sản phẩm (hỗ trợ cả biến thể và đơn giản)
     * @param WC_Product $product Đối tượng sản phẩm WooCommerce
     * @return string Tiêu đề của sản phẩm ko dính các thuộc tính biến thể, chỉ lấy title cha
     */
    public function custom_get_title($product)
    {
        if (!($product instanceof WC_Product)) return '';
        if ($product->is_type('variation')) {
            $parent_id = $product->get_parent_id();
            $parent_product = wc_get_product($parent_id);
            $title = $parent_product ? $parent_product->get_name() : '';
        } else {
            $title = $product->get_name();
        }
        return $title;
    }

    /**
     * Lấy tiêu đề của sản phẩm (hỗ trợ cả biến thể và đơn giản)
     * @param WC_Product $product Đối tượng sản phẩm WooCommerce
     * @return string Giá sản phẩm
     */
    public function custom_display_product_price($product)
    {
        if ($product->is_type('simple')) {
            $regular_price = wc_get_price_to_display($product, ['price' => $product->get_regular_price()]);
            $sale_price = wc_get_price_to_display($product, ['price' => $product->get_sale_price()]);

            if ($product->is_on_sale() && $sale_price) {
                $price = '<span class="old-price">' . wc_price($regular_price) . '</span> ';
                $price .= '<span class="sale-price">' . wc_price($sale_price) . '</span>';
            } else {
                $price = '<span class="regular-price">' . wc_price($regular_price) . '</span>';
            }
        } elseif ($product->is_type('variable') && $product instanceof WC_Product_Variable ) {
            
            $prices = $product->get_variation_prices();
            $min_price = min($prices['price']);
            $max_price = max($prices['price']);

            if ($min_price == $max_price) {
                $price = '<span class="regular-price">' . wc_price($min_price) . '</span>';
            } else {
                $price = '<span class="price-range">' . wc_price($min_price) . ' - ' . wc_price($max_price) . '</span>';
            }
        }
        return $price;
    }
}

function mywoo()
{
    return ProductHelper::instance();
}
