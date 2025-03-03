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
            <p>Nếu bạn chưa có tài khoản, hãy đăng ký để bắt đầu nhé!</p>
            <button id="toggleBtn">Đăng ký</button>
        </div>

    </div>

</div>




<?php get_footer(); ?>
<script>
    jQuery(document).ready(function($) {
        // Lần đầu
        $('#auth').find('.form-container.login-form').addClass('activeS');
        $('#toggleBtn').addClass('register-active');
        $('#toggleBtn').click(function() {
            $('#auth').toggleClass('active');
            $('#auth .form-container').toggleClass('activeS');
            let isActive = $('#auth').hasClass('active');
            $(this).text(isActive ? 'Đăng nhập' : 'Đăng ký');
            $(this).siblings('p').text(isActive ?
                'Nếu bạn đã có tài khoản, hãy đăng nhập nhé!' :
                'Nếu bạn chưa có tài khoản, hãy đăng ký để bắt đầu nhé!'
            )

            if ($('#toggleBtn').text() == 'Đăng ký') {
                $('#toggleBtn').addClass('register-active');
            } else {
                $('#toggleBtn').removeClass('register-active');

            }
            let overlay = $('#auth .overlay');
            overlay.css('border-radius', !isActive ? '0 10px 10px 0' : '10px 0 0 10px');
        });
    });
</script>