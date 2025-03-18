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
        $cat = $_POST['category'] ?? [];
        $tag = $_POST['tag'] ?? [];
        $size = $_POST['size'] ?? [];
        /**
         * Init Args để query
         */
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 12,
            'paged'          => $paged,
            'tax_query' => [
                'relation' => 'OR',
            ]
        );

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
        $cat_tag_query = array(
            'relation' => 'OR',
        );
        if (!empty($cat)) {
            $cat_tag_query = [
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $cat,
                'operator' => 'IN'
            ];
        }
        if (!empty($tag)) {
            $cat_tag_query = [
                'taxonomy' => 'product_tag',
                'field' => 'term_id',
                'terms' => array_map('intval', $tag),
                'operator' => 'IN' // mặc định dugn2 terms là IN, nhưng thêm vào cho rõ ràng
            ];
        }
        $attr_query = array(
            'relation' => 'OR'
        );
        if (!empty($size)) {
            $attr_query = [
                'taxonomy' => 'pa_size',
                'field' => 'slug',
                'terms' => $size,
                'operator' => 'IN'
            ];
        };

        

        $args['tax_query'][] = $cat_tag_query;
        $args['tax_query'][] = $attr_query;

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
