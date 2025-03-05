<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="site-header">
        <div class="container">

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

            <!-- Hiển thị Menu Chính -->
            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'nav-menu',
                    'container'      => false,
                    'fallback_cb'    => false
                ));
                ?>
            </nav>

            <div class="info-woo-header">
                <!-- Phần này xử lí icon user login/logout -->
                <?php if (is_user_logged_in()) : ?>
                    <?php $current_user = wp_get_current_user(); ?>
                    <div class="user-menu">
                        <a href="#" class="user-toggle">
                            <i class="fa fa-user"></i>
                            <span class="user-name"><?php echo esc_html(empty($current_user->display_name) ? $current_user->user_login : $current_user->display_name); ?></span>
                        </a>
                        <ul class="user-dropdown">
                            <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">My Account</a></li>
                            <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">Logout</a></li>
                        </ul>
                    </div>
                <?php else : ?>
                    <a href="<?php echo home_url('/login') ?>">
                        <i class="fa fa-user"></i> Login
                    </a>
                <?php endif; ?>
                <div class="line-head"></div>
                <!-- Phần này là phần cart -->
                <a href="<?php echo wc_get_cart_url(); ?>">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </a>
                <div class="line-head"></div>
                <!-- Button Humberger -->
                <button class="menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- Nút Toggle Menu  -->

        </div>
    </header>

    <!-- Bắt đầu Nội dung Chính -->
    <main class="site-main">