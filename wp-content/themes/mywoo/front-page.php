<link rel="stylesheet" href="<?php echo get_theme_file_uri() . '/assets/css/front-page.css' ?>">
<?php get_header(); ?>

<section class="hero-banner">
    <div class="hero-content">
        <!-- <h1>Tiêu đề chính</h1>
        <p>Mô tả ngắn gọn ở đây</p> -->
    </div>
    <div class="hero-slider">
        <div class="slide-item">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/home/banner2.jpg' ?>" alt="Slide 1">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/home/banner3.jpg' ?>" alt="Slide 2">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/products/A12.jpg' ?>" alt="Slide 3">
        </div>

        <div class="slide-item">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/products/A16.jpg' ?>" alt="Slide 3">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/products/A15.jpg' ?>" alt="Slide 3">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/products/A17.jpg' ?>" alt="Slide 3">
        </div>
    </div>
</section>

<section class="services">
    <div class="container">
        <div class="item">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/icons/services/service1.1.webp' ?>" alt="">
            <h4>SHIPPING & RETURN</h4>
            <p>If your glasses aren't perfect, return them within 30 days for a full refund.</p>
        </div>
        <div class="item">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/icons/services/service1.2.webp' ?>" alt="">
            <h4>SAFE PAYMENT</h4>
            <p>Pay with the world's most popular and secure payment methods</p>
        </div>
        <div class="item">
            <img src="<?php echo get_theme_file_uri() . '/assets/images/icons/services/service1.3.webp' ?>" alt="">
            <h4>SHOP WITH CONFIDENCE</h4>
            <p>Our Buyer Protection covers your purchase from click to delivery.</p>
        </div>
    </div>
</section>


<?php
$args_new = array(
    'post_type' => 'product',
    'posts_per_page' => 8,
    'orderby' => 'date',
    'order' => 'DESC'
);
$query_new = new WP_Query($args_new);

$args_bestseller = array(
    'post_type' => 'product',
    'posts_per_page' => 8,
    'meta_key' => 'total_sales',
    'orderby' => 'meta_value_num',
    'order' => 'DESC'
);
$query_bestseller = new WP_Query($args_bestseller);

$args_featured = array(
    'post_type' => 'product',
    'posts_per_page' => 8,
    'tax_query' => array(
        array(
            'taxonomy' => 'product_visibility',
            'field' => 'slug',
            'terms' => 'featured'
        )
    )
);
$query_featured = new WP_Query($args_featured);

$args_sale = array(
    'post_type' => array('product', 'product_variation'),
    'posts_per_page' => 8,
    'meta_query' => array(
        array(
            'key' => '_sale_price',
            'value' => 0,
            'compare' => '>',
            'type' => 'NUMERIC'
        )
    )
);

$query_sale = new WP_Query($args_sale);
$displayed_parents = [];
?>

<section class="products">
    <div class="group-products-tab">
        <ul class="product-tabs">
            <li class="tab-link" data-id-tab-content="new-products">Mới nhất</li>
            <li class="tab-link" data-id-tab-content="best-sellers">Bán chạy</li>
            <li class="tab-link" data-id-tab-content="featured">Nổi bật</li>
            <li class="tab-link" data-id-tab-content="on-sale">Giảm giá</li>
            <li class="tab-link-shop-page"><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Shop</a></li>
        </ul>
        <div class="product-content">
            <div class="tab-pane active" id="new-products">
                <?php if ($query_new->have_posts()) : ?>
                    <?php while ($query_new->have_posts()) : $query_new->the_post(); ?>
                        <?php wc_get_template_part('content', 'product'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="tab-pane" id="best-sellers">
                <?php if ($query_bestseller->have_posts()) : ?>
                    <?php while ($query_bestseller->have_posts()) : $query_bestseller->the_post(); ?>
                        <?php wc_get_template_part('content', 'product'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="tab-pane" id="featured">
                <?php if ($query_featured->have_posts()) : ?>
                    <?php while ($query_featured->have_posts()) : $query_featured->the_post(); ?>
                        <?php wc_get_template_part('content', 'product'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="tab-pane" id="on-sale">
                <?php if ($query_sale->have_posts()) : ?>
                        <?php while ($query_sale->have_posts()) : $query_sale->the_post(); ?>
                            <?php
                            global $product;
            
                            // Xử lý trường hợp product_variation
                            if ($product->is_type('variation')) {
                                $parent_id = $product->get_parent_id();
                                $parent_product = wc_get_product($parent_id);
                                if ($parent_product) {
                                    $product = $parent_product; // Dùng sản phẩm cha thay vì biến thể
                                }
                            }
                            if (in_array($product->get_id(), $displayed_parents)) {
                                continue;
                            }
                            
                            // Đánh dấu sản phẩm cha đã hiển thị
                            $displayed_parents[] = $product->get_id();

                        ?>
                        <?php wc_get_template_part('content', 'product'); ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
<script src="<?php echo get_theme_file_uri() . '/assets/js/front-page.js' ?>" defer></script>