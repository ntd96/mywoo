<!-- popup login -->
<!-- Key: #login-popup -->
<div id="login-popup" style="display: none; max-width: 400px;">
    <form id="custom-login-form" method="post">
        <label for="user">Username</label>
        <input type="text" name="log" id="user" required>

        <label for="pass">Password</label>
        <input type="password" name="pwd" id="pass" required>

        <label>
            <input type="checkbox" name="rememberme" value="forever"> Remember Me
        </label>

        <button type="submit">Login</button>
        <div id="spinner" style="display: none;"></div>
        <div id="login-message"></div> <!-- Hiển thị thông báo -->
    </form>
</div>