<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (WC()->cart && ! WC()->cart->is_empty()) : ?>

	<div class="custom-mini-cart" id="custom-mini-cart">
		<ul>
			<?php
			$datas = WC()->cart->get_cart();
			foreach ($datas as $item):
				$product = $item['data'];
				$product_id = $product->get_id();
				$title = $product->get_name();
				$thumbnail = wp_get_attachment_url($product->get_image_id(), 'thumbnail');
				$price = WC()->cart->get_product_price($product);
				$quantity = $item['quantity'];
			?>
				<li class="cart-item" data-cart-item="<?php echo esc_attr($item['key']); ?>">
					<div class="thumb">
						<img src="<?= esc_url($thumbnail); ?>" alt="<?= esc_attr($title); ?>">
					</div>
					<div class="details">
						<h4 class="title"><?= esc_html($title); ?></h4>
						<p class="price"><?php echo $price; ?></p>
						<div class="quantity">
							<button class="qty-minus">-</button>
							<input type="number" class="cart-qty" value="<?php echo esc_attr($quantity); ?>" readonly>
							<button class="qty-plus">+</button>
						</div>
					</div>
					<div class="remove">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
							<path d="M170.5 51.6L151.5 80l145 0-19-28.4c-1.5-2.2-4-3.6-6.7-3.6l-93.7 0c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80 368 80l48 0 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-8 0 0 304c0 44.2-35.8 80-80 80l-224 0c-44.2 0-80-35.8-80-80l0-304-8 0c-13.3 0-24-10.7-24-24S10.7 80 24 80l8 0 48 0 13.8 0 36.7-55.1C140.9 9.4 158.4 0 177.1 0l93.7 0c18.7 0 36.2 9.4 46.6 24.9zM80 128l0 304c0 17.7 14.3 32 32 32l224 0c17.7 0 32-14.3 32-32l0-304L80 128zm80 64l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0l0 208c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-208c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
						</svg>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		<div class="cart-total">
			<strong>Total:</strong> <?php echo WC()->cart->get_cart_total(); ?>
		</div>
	</div>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>