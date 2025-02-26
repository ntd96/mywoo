<?php

/**
 * Template Name: Custom Login
 */
?>

<link rel="stylesheet" href="<?php echo get_theme_file_uri() . '/assets/css/auth.css' ?>">
<?php get_header(); ?>

<div id="auth" class="auth">
    <div class="group">
        <div class="form-container login-form">
            <form id="login-form">
                <h2>Đăng nhập</h2>
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="log-username" required>
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="log-password" required>
                <label>
                    <input type="checkbox" id="remember" name="log-remember"> Ghi nhớ đăng nhập
                </label>
                <button type="submit">Đăng nhập</button>
            </form>
        </div>
        <div class="form-container register-form">
            <form id="register-form">
                <h2>Đăng ký</h2>
                <label for="reg-username">Tên đăng ký: <span>*</span> </label>
                <input type="text" id="reg-username" name="reg-username" required>
                <label for="reg-email">Email: <span>*</span></label>
                <input type="email" id="reg-email" name="reg-email" required>
                <label for="reg-password">Mật khẩu: <span>*</span></label>
                <input type="password" id="reg-password" name="reg-password" required>
                <label for="reg-display-name">Tên hiển thị:</label>
                <input type="text" id="reg-display-name" name="reg-display-name">
                <label for="reg-phone">Số điện thoại:</label>
                <input type="text" id="reg-phone" name="reg-phone">
                <button type="submit">Đăng ký</button>
            </form>
        </div>
        <div class="overlay">
            <h2>Welcome!</h2>
            <p>Click the button below to switch between login and register.</p>
            <button id="toggleBtn">Đăng ký</button>
        </div>

    </div>
</div>




<?php get_footer(); ?>
<script>
    jQuery(document).ready(function($) {
        $('#toggleBtn').click(function() {
            $('#auth').toggleClass('active');
            $(this).text($('#auth').hasClass('active') ? 'Đăng nhập' : 'Đăng ký');
        });

    });
</script>