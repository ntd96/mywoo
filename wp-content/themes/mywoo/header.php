<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header">
        <div class="container" style="height: 100%;">

            <!-- Hiển thị Logo -->
            <div class="site-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo get_theme_file_uri() . '/assets/images/logook2.png' ?>" alt="Ninisesi">
                    </a>
                <?php endif; ?>
            </div>



            <div class="info-woo-header">
                <!-- Phần này xử lí icon user login/logout -->
                <?php if (is_user_logged_in()) : ?>
                    <?php $current_user = wp_get_current_user(); ?>
                    <div class="user-menu">
                        <div class="user-toggle">
                            <svg width="18" height="18" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.99952 8C4.79727 8 2.98828 6.19608 2.98828 4C2.98828 1.80392 4.79727 0 6.99952 0C9.20176 0 11.0108 1.80392 11.0108 4C11.0108 6.19608 9.20176 8 6.99952 8ZM6.99952 1.01961C5.34783 1.01961 4.01075 2.35294 4.01075 4C4.01075 5.64706 5.34783 6.98039 6.99952 6.98039C8.6512 6.98039 9.98828 5.64706 9.98828 4C9.98828 2.35294 8.6512 1.01961 6.99952 1.01961Z" fill="#2D2D2D"></path>
                                <path d="M13.5281 15.9998H0.47191C0.157303 15.9998 0 15.7645 0 15.5292V12.0782C0 11.5292 0.235955 11.0586 0.707865 10.8233C4.48315 8.47036 9.59551 8.47036 13.3708 10.8233C13.764 11.0586 14.0787 11.6076 14.0787 12.0782V15.5292C14 15.7645 13.764 15.9998 13.5281 15.9998ZM1.02247 14.9802H13.0562V12.0782C13.0562 11.9213 12.9775 11.7645 12.8202 11.686C9.35955 9.5684 4.7191 9.5684 1.25843 11.686C1.10112 11.7645 1.02247 11.9213 1.02247 12.0782V14.9802Z" fill="#2D2D2D"></path>
                            </svg>
                            <span class="user-name"><?php echo esc_html(empty($current_user->display_name) ? $current_user->user_login : $current_user->display_name); ?></span>
                        </div>
                        <ul class="user-dropdown">
                            <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">My Account</a></li>
                            <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Logout</a></li>
                        </ul>
  
                <?php else : ?>
                    <a href="<?php echo home_url('/login') ?>">
                        <svg width="18" height="18" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99952 8C4.79727 8 2.98828 6.19608 2.98828 4C2.98828 1.80392 4.79727 0 6.99952 0C9.20176 0 11.0108 1.80392 11.0108 4C11.0108 6.19608 9.20176 8 6.99952 8ZM6.99952 1.01961C5.34783 1.01961 4.01075 2.35294 4.01075 4C4.01075 5.64706 5.34783 6.98039 6.99952 6.98039C8.6512 6.98039 9.98828 5.64706 9.98828 4C9.98828 2.35294 8.6512 1.01961 6.99952 1.01961Z" fill="#2D2D2D"></path>
                            <path d="M13.5281 15.9998H0.47191C0.157303 15.9998 0 15.7645 0 15.5292V12.0782C0 11.5292 0.235955 11.0586 0.707865 10.8233C4.48315 8.47036 9.59551 8.47036 13.3708 10.8233C13.764 11.0586 14.0787 11.6076 14.0787 12.0782V15.5292C14 15.7645 13.764 15.9998 13.5281 15.9998ZM1.02247 14.9802H13.0562V12.0782C13.0562 11.9213 12.9775 11.7645 12.8202 11.686C9.35955 9.5684 4.7191 9.5684 1.25843 11.686C1.10112 11.7645 1.02247 11.9213 1.02247 12.0782V14.9802Z" fill="#2D2D2D"></path>
                        </svg>
                    </a>
                <?php endif; ?>

                <div class="line-head"></div>

                <!-- Giỏ hàng icon -->
                <a href="" id="cart-toggle">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 256 256" enable-background="new 0 0 256 256" xml:space="preserve">
                        <metadata> Svg Vector Icons : http://www.onlinewebfonts.com/icon </metadata>
                        <g>
                            <g>
                                <g>
                                    <path fill="#000000" d="M10,37.5v3.4L27.9,41c17.5,0.1,17.9,0.1,19.9,1.2c2.5,1.3,4.6,4.2,5.3,7.2c0.3,1.2,5.2,28,10.8,59.4c11.5,64,10.5,60.1,15.3,63l2.3,1.4h62.8h62.8l2-1.1c2.3-1.2,4.6-3.6,5.4-5.7c0.3-0.8,7.6-25,16.1-53.8C244.2,67.3,246.2,60,246,58.1c-0.5-4.6-3.3-8-7.8-9.3c-2.6-0.8-22.4-0.9-92.3-0.3l-43.5,0.3v3.4v3.3l67-0.3l67.1-0.4l1.4,1.5c0.8,0.8,1.5,1.9,1.5,2.3c0,1.1-30.9,105.2-31.7,106.5c-0.2,0.5-0.9,1.1-1.4,1.4c-0.6,0.3-21.3,0.5-62.2,0.5c-58.4,0-61.4,0-62.4-0.9c-1-0.8-2-6.1-11.6-59.5C58.7,42,59.2,44.2,54.8,39.9c-1.2-1.2-3.7-3-5.5-3.8l-3.2-1.6l-18.1-0.1L10,34.2V37.5L10,37.5z" />
                                    <path fill="#000000" d="M91.1,186.2c-8.7,2.8-14.7,11.9-13.1,20.1c1.3,7.1,6.6,12.9,13.7,14.9c7.8,2.3,16.8-2.2,20.7-10.1c1.2-2.6,1.4-3.4,1.4-7.4c0-4.2-0.1-4.8-1.6-7.8c-1.9-3.8-5.3-7.1-9.2-8.9C99.8,185.6,94.2,185.2,91.1,186.2z M102.3,194c3.2,2,4.9,5.4,4.9,9.7c0,3.9-1.1,6.4-3.7,8.7c-3.4,3.1-8.7,3.6-13.3,1.4c-7.9-3.8-7.7-16.6,0.4-20.4C94.1,191.8,99.1,192,102.3,194z" />
                                    <path fill="#000000" d="M189.6,186.4c-5.2,1.8-9,5.4-11.4,10.5c-1.1,2.3-1.3,3.4-1.3,6.8c0,3.6,0.2,4.5,1.5,7.2c1.9,3.8,5.7,7.7,9.6,9.4c2.3,1.1,3.4,1.3,6.9,1.3c3.4,0,4.5-0.2,6.9-1.3c3.8-1.8,7.7-5.6,9.6-9.4c1.3-2.8,1.5-3.6,1.5-7.2c0-3.6-0.2-4.5-1.5-7.3c-3.1-6.5-9.1-10.6-16-10.8C193,185.6,191.1,185.9,189.6,186.4z M199.4,193c2.8,1,5.7,4.1,6.6,7.1c0.7,2.6,0.4,6.7-0.7,8.9c-2.1,4.2-5.2,5.9-10.3,5.9c-5.4,0-8.4-1.9-10.5-6.5c-1.9-4.2-1.1-9.2,2-12.7C189.4,192.5,194.5,191.4,199.4,193z" />
                                </g>
                            </g>
                        </g>
                    </svg>
                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>

                <div class="line-head"></div>

                <!-- Button Humberger -->
                <button class="menu-toggle">
                    <svg class="icon-open" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 6H21M3 12H21M3 18H21" stroke="#333" stroke-width="1" stroke-linecap="round" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Slide Cart -->
    <div id="slide-cart" class="cart-panel">
        <div class="cart-header">
            <p class="count"><?= WC()->cart->get_cart_contents_count() ?></p>
            <h4>Shopping Cart</h4>
            <button id="close-cart">&times;</button>
        </div>
        <div class="cart-content">
            <?php if (WC()->cart->is_empty()) : ?>
                <p class="empty-cart-message">Không có sản phẩm nào trong giỏ hàng.</p>
            <?php else : ?>
                <?php woocommerce_mini_cart(); ?>
            <?php endif; ?>
        </div>
        <?php if (!WC()->cart->is_empty()) : ?>
            <div class="cart-footer">
                <a href="<?php echo wc_get_cart_url(); ?>" class="view-cart">View Cart</a>
                <a href="<?php echo wc_get_checkout_url(); ?>" class="checkout">Check Out</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Slide Menu Chính -->
    <nav class="main-navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class'     => 'nav-menu',
            'container'      => false,
            'fallback_cb'    => false
        ));
        ?>
        <svg class="icon-close" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 6L18 18M6 18L18 6" stroke="#333" stroke-width="2" stroke-linecap="round" />
        </svg>
    </nav>

    <div id="overlay"></div>

    <!-- Bắt đầu Nội dung Chính -->
    <main class="site-main">