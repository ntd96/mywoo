<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

if (!defined('ABSPATH')) {
	exit;
}
?>

<link rel="stylesheet" href="<?= get_theme_file_uri() . '/assets/css/archive-product.css'; ?>">
<?php get_header(); ?>

<?php
$paged = get_query_var('page') ? get_query_var('page') : 1;
$args = array(
	'post_type'      => 'product',
	'posts_per_page' => 4,
	'paged'          => $paged,
	'orderby'        => 'date',
	'order'          => 'DESC',
);
$query = new WP_Query($args);
?>

<div class="product-list">
	<?php
	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();
			global $product;
	?>
			<div class="product-item">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('medium'); ?>
					<h2><?php the_title(); ?></h2>
					<p class="price"><?php echo wc_price($product->get_price()); ?></p>
				</a>
			</div>
		<?php
		endwhile;
		wp_reset_postdata();
		?>
</div> <!-- Đóng div product-list -->

<!-- Hiển thị phân trang -->
<div class="pagination">
	<?php
		echo paginate_links(array(
			'total'   => $query->max_num_pages,
			'current' => max(1, get_query_var('page')),
			'format'  => '?page=%#%'
		));
	?>
</div>

<?php
	else :
		echo '<p>Không có sản phẩm nào.</p>';
	endif;
?>

<?php get_footer(); ?>
<script src="<?= get_theme_file_uri() . '/assets/css/archive-product.css'; ?>"></script>