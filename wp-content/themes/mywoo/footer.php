<footer class="site-footer">
    <div class="container">
        <!-- Cột 1: Logo hoặc thông tin website -->
        <div class="footer-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <h2><?php bloginfo('name'); ?></h2>
                </a>
            <?php endif; ?>
        </div>

        <!-- Cột 2: Menu Footer -->
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_class'     => 'footer-menu',
                'container'      => false,
                'fallback_cb'    => false
            ));
            ?>
        </nav>

    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>