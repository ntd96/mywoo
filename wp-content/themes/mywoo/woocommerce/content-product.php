<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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

if (!defined('ABSPATH')) {
    exit;
}

global $product;
?>
<div class="custom-content-product">
    <a href="<?php the_permalink(); ?>" class="product-link">
        <div class="thumb">
            <?php echo $product->get_image(); ?>
            <!-- Icon Add to Cart -->
            <div class="add-to-cart-btn" data-product-id="<?php echo $product->get_id(); ?>">
                <svg class="icon-add-to-cart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297.78668 398.66666" height="398.66666" width="297.78668" id="svg2" version="1.1" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xml:space="preserve">
                    <metadata id="metadata8">
                        <rdf>
                            <work rdf:about="">
                                <format>image/svg+xml</format>
                                <type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></type>
                            </work>
                        </rdf>
                    </metadata>
                    <defs id="defs6"></defs>
                    <g transform="matrix(1.3333333,0,0,-1.3333333,0,398.66667)" id="g10">
                        <g transform="scale(0.1)" id="g12">
                            <path id="path14" style="fill-opacity:1;fill-rule:nonzero;stroke:none" d="M 2233.36,2432.71 H 0 V 0 h 2233.36 v 2432.71 z m -220,-220 V 220 H 220.004 V 2212.71 H 2013.36"></path>
                            <path xmlns="http://www.w3.org/2000/svg" id="path16" style="fill-opacity:1;fill-rule:nonzero;stroke:none" d="m 1116.68,2990 v 0 C 755.461,2990 462.637,2697.18 462.637,2335.96 V 2216.92 H 1770.71 v 119.04 c 0,361.22 -292.82,654.04 -654.03,654.04 z m 0,-220 c 204.58,0 376.55,-142.29 422.19,-333.08 H 694.492 C 740.117,2627.71 912.102,2770 1116.68,2770"></path>
                            <path xmlns="http://www.w3.org/2000/svg" id="path18" style="fill-opacity:1;fill-rule:nonzero;stroke:none" d="M 1554.82,1888.17 H 678.543 v 169.54 h 876.277 v -169.54"></path>
                        </g>
                    </g>
                </svg>
            </div>
        </div>
        <div class="content">
            <h2><?php echo mywoo()->custom_get_title($product); ?></h2>
            <p class="price">
                <?php echo mywoo()->custom_display_product_price($product); ?>
            </p>
        </div>
    </a>
</div>