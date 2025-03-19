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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.css">
<?php get_header(); ?>

<?php


?>

<div class="archive-product">
	<?php woocommerce_breadcrumb(); ?>

	<!-- FILTER - SORT -->
	<div class="filter-sort">
		<!-- Group 1 -->
		<div class="group-1">
			<div class="filter">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
					<path d="M0 416c0 17.7 14.3 32 32 32l54.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 448c17.7 0 32-14.3 32-32s-14.3-32-32-32l-246.7 0c-12.3-28.3-40.5-48-73.3-48s-61 19.7-73.3 48L32 384c-17.7 0-32 14.3-32 32zm128 0a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM320 256a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm32-80c-32.8 0-61 19.7-73.3 48L32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l246.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48l54.7 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-54.7 0c-12.3-28.3-40.5-48-73.3-48zM192 128a32 32 0 1 1 0-64 32 32 0 1 1 0 64zm73.3-64C253 35.7 224.8 16 192 16s-61 19.7-73.3 48L32 64C14.3 64 0 78.3 0 96s14.3 32 32 32l86.7 0c12.3 28.3 40.5 48 73.3 48s61-19.7 73.3-48L480 128c17.7 0 32-14.3 32-32s-14.3-32-32-32L265.3 64z" />
				</svg>
				<span> Lọc sản phẩm </span>
			</div>
		</div>

		<!-- Group 2 -->
		<div class="group-2">
			<div class="view-options">
				<div class="option-btn" data-view="grid-large">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="50.000000pt" height="50.000000pt" viewBox="0 0 50.000000 50.000000" preserveAspectRatio="xMidYMid meet">
						<g transform="translate(0.000000,50.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
							<path d="M60 440 c-11 -11 -20 -29 -20 -40 0 -26 34 -60 60 -60 26 0 60 34 60 60 0 26 -34 60 -60 60 -11 0 -29 -9 -40 -20z" />
							<path d="M210 440 c-11 -11 -20 -29 -20 -40 0 -26 34 -60 60 -60 26 0 60 34 60 60 0 11 -9 29 -20 40 -11 11 -29 20 -40 20 -11 0 -29 -9 -40 -20z" />
							<path d="M360 440 c-11 -11 -20 -29 -20 -40 0 -11 9 -29 20 -40 11 -11 29 -20 40 -20 26 0 60 34 60 60 0 11 -9 29 -20 40 -11 11 -29 20 -40 20 -11 0 -29 -9 -40 -20z" />
							<path d="M60 290 c-11 -11 -20 -29 -20 -40 0 -26 34 -60 60 -60 26 0 60 34 60 60 0 26 -34 60 -60 60 -11 0 -29 -9 -40 -20z" />
							<path d="M210 290 c-11 -11 -20 -29 -20 -40 0 -26 34 -60 60 -60 26 0 60 34 60 60 0 11 -9 29 -20 40 -11 11 -29 20 -40 20 -11 0 -29 -9 -40 -20z" />
							<path d="M360 290 c-11 -11 -20 -29 -20 -40 0 -11 9 -29 20 -40 11 -11 29 -20 40 -20 26 0 60 34 60 60 0 11 -9 29 -20 40 -11 11 -29 20 -40 20 -11 0 -29 -9 -40 -20z" />
							<path d="M60 140 c-11 -11 -20 -29 -20 -40 0 -26 34 -60 60 -60 26 0 60 34 60 60 0 26 -34 60 -60 60 -11 0 -29 -9 -40 -20z" />
							<path d="M210 140 c-11 -11 -20 -29 -20 -40 0 -26 34 -60 60 -60 26 0 60 34 60 60 0 26 -34 60 -60 60 -11 0 -29 -9 -40 -20z" />
							<path d="M360 140 c-11 -11 -20 -29 -20 -40 0 -11 9 -29 20 -40 11 -11 29 -20 40 -20 26 0 60 34 60 60 0 26 -34 60 -60 60 -11 0 -29 -9 -40 -20z" />
						</g>
					</svg>
				</div>
				<div class="option-btn active" data-view="grid-medium">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="50.000000pt" height="50.000000pt" viewBox="0 0 50.000000 50.000000" preserveAspectRatio="xMidYMid meet">
						<g transform="translate(0.000000,50.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
							<path d="M52 448 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M162 448 c-17 -17 -15 -53 3 -68 8 -7 25 -10 40 -6 29 7 44 49 25 71 -15 18 -51 20 -68 3z" />
							<path d="M272 448 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M382 448 c-17 -17 -15 -53 3 -68 22 -19 64 -4 71 25 4 15 1 32 -6 40 -15 18 -51 20 -68 3z" />
							<path d="M52 338 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M162 338 c-17 -17 -15 -53 3 -68 22 -19 64 -4 71 25 4 15 1 32 -6 40 -15 18 -51 20 -68 3z" />
							<path d="M272 338 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M382 338 c-17 -17 -15 -53 3 -68 8 -7 25 -10 40 -6 29 7 44 49 25 71 -15 18 -51 20 -68 3z" />
							<path d="M52 228 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M162 228 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M272 228 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M382 228 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M52 118 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M162 118 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
							<path d="M272 118 c-17 -17 -15 -53 3 -68 22 -19 64 -4 71 25 4 15 1 32 -6 40 -15 18 -51 20 -68 3z" />
							<path d="M382 118 c-17 -17 -15 -53 3 -68 38 -31 96 27 65 65 -15 18 -51 20 -68 3z" />
						</g>
					</svg>
				</div>
				<div class="option-btn" data-view="list">
					<svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="50.000000pt" height="50.000000pt" viewBox="0 0 50.000000 50.000000" preserveAspectRatio="xMidYMid meet">
						<g transform="translate(0.000000,50.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
							<path d="M10 445 c-26 -32 13 -81 48 -59 22 14 27 41 12 59 -16 19 -44 19 -60 0z" />
							<path d="M120 420 c0 -19 7 -20 190 -20 183 0 190 1 190 20 0 19 -7 20 -190 20 -183 0 -190 -1 -190 -20z" />
							<path d="M10 275 c-26 -32 13 -81 48 -59 9 6 18 19 20 28 8 38 -43 61 -68 31z" />
							<path d="M120 250 c0 -19 7 -20 190 -20 183 0 190 1 190 20 0 19 -7 20 -190 20 -183 0 -190 -1 -190 -20z" />
							<path d="M10 105 c-26 -32 13 -81 48 -59 9 6 18 19 20 28 8 38 -43 61 -68 31z" />
							<path d="M120 80 c0 -19 7 -20 190 -20 183 0 190 1 190 20 0 19 -7 20 -190 20 -183 0 -190 -1 -190 -20z" />
						</g>
					</svg>
				</div>
			</div>
			<div class="sort">
				Sắp xếp theo
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
					<path d="M201.4 137.4c12.5-12.5 32.8-12.5 45.3 0l160 160c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L224 205.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l160-160z" />
				</svg>
				<ul class="sort-options">
					<li data-sort="newest">Mới nhất</li>
					<li data-sort="oldest">Cũ nhất</li>
					<li data-sort="high_to_low">Giá cao nhất</li>
					<li data-sort="low_to_high">Giá thấp nhất</li>
				</ul>
			</div>
		</div>

	</div>
	<!-- NAV SIDE BAR -->
	<div class="product-sidebar">
		<?php get_template_part('sidebar-filter-archive', 'product'); ?>
	</div>
	<div id="overlay"></div>

	<!-- CONTENT LIST -->
	<div class="product-list">


	</div>

	<!-- PAGINATION -->
	<div class="pagination">

	</div>
</div>


<?php get_footer(); ?>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
<script defer src="<?= get_theme_file_uri() . '/assets/js/archive-product.js'; ?>"></script>