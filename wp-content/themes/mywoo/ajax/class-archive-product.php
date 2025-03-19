<?php

/**
 * Xử lí ajax Trang archive product
 */

if (!defined('ABSPATH')) {
    exit;
}

class Woo_Archive_Product
{
    public function __construct()
    {
        add_action('wp_ajax_load_archive_products', [$this, 'load_products']);
        add_action('wp_ajax_nopriv_load_archive_products', [$this, 'load_products']);
    }

    public function load_products()
    {

        if (!isset($_POST['security']) || !wp_verify_nonce($_POST['security'], 'nonce')) {
            wp_die('Lỗi nonce');
        }

        /**
         * Thu thập dữ liệu từ client request
         */
        $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $sort = $_POST['sort'] ?? 'newest';
        $cat = !empty($_POST['category']) ? array_map('intval', (array) $_POST['category']) : [];
        $tag = !empty($_POST['tag']) ? array_map('intval', (array) $_POST['tag']) : [];
        $size = !empty($_POST['size']) ? array_map('sanitize_text_field', (array) $_POST['size']) : [];
        $color = !empty($_POST['color']) ? array_map('sanitize_text_field', (array) $_POST['color']) : [];
        $min = isset($_POST['min']) ? floatval($_POST['min']) : 0;
        $max = isset($_POST['max']) ? floatval($_POST['max']) : 200;
        /**
         * Init Args để query
         */
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 12,
            'paged'          => $paged,
            'tax_query' => [
                'relation' => 'OR',
            ],
            'meta_query' => []
        );


        /**
         * Xử lí Price range
         */
        $groupPrice = [];
        if (!empty($min) || !empty($max)) {
            $groupPrice[] = [
                'key' => '_price',
                'value' => [$min, $max],
                'compare' => 'BETWEEN',
                'type' => 'NUMERIC'
            ];
        }

        if (!empty($groupPrice)) {
            $args['meta_query'][] = array_merge($groupPrice);
        }


        // Sorting
        switch ($sort) {
            case 'low_to_high':
                $args['meta_key'] = '_price';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'ASC';
                break;
            case 'high_to_low':
                $args['meta_key'] = '_price';
                $args['orderby'] = 'meta_value_num';
                $args['order'] = 'DESC';
                break;
            case 'oldest':
                $args['orderby'] = 'date';
                $args['order'] = 'ASC';
                break;
            case 'newest':
            default:
                $args['orderby'] = 'date';
                $args['order'] = 'DESC';
                break;
        }

        // Nhóm CAT TAG
        $cat_tag_query = array();
        if (!empty($cat)) {
            $cat_tag_query[] = [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $cat,
                'operator' => 'IN'
            ];
        }
        if (!empty($tag)) {
            $cat_tag_query[] = [
                'taxonomy' => 'product_tag',
                'field' => 'term_id',
                'terms' => array_map('intval', $tag),
                'operator' => 'IN' // mặc định dùng terms là IN, nhưng thêm vào cho rõ ràng
            ];
        }

        $args['tax_query'][] = array_merge(
            ['relation' => 'OR'],
            $cat_tag_query,
        );

        $attr_query = array();
        if (!empty($size)) {
            $attr_query = [
                'taxonomy' => 'pa_size',
                'field' => 'slug',
                'terms' => $size,
                'operator' => 'IN'
            ];
        };
        if (!empty($color)) {
            $attr_query = [
                'taxonomy' => 'pa_color',
                'field' => 'slug',
                'terms' => $color,
                'operator' => 'IN'
            ];
        };

        $args['tax_query'][] = array_merge(
            ['relation' => 'OR'],
            $attr_query,
        );

        // if (!empty($groupPrice)) {
        // }

        $query = new WP_Query($args);
        ob_start(); ?>
        <?php if ($query->have_posts()): ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php wc_get_template_part('content', 'product'); ?>
            <?php endwhile; ?>
            <!-- Hiển thị phân trang -->
            <?php wp_reset_postdata(); ?>
        <?php else: ?>
            <p>Không có sản phẩm nào!</p>   
        <?php endif; ?>

        <?php
        $html = ob_get_clean();
        $pagination = paginate_links(array(
            'total'   => $query->max_num_pages,
            'current' => $paged,
            'format'  => '?page=%#%',
            'prev_text' => __('«'),
            'next_text' => __('»'),
        ));

        wp_send_json_success([
            'html' => $html,
            'pagination' => $pagination,
        ]);
    }
}

new Woo_Archive_Product();
