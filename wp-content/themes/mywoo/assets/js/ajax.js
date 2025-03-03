jQuery(document).ready(function ($) {
    // -- Xứ lí ajax Login
    $('#login-form').submit(function (e) {
        e.preventDefault();
        let username = $('#username').val();
        let password = $('#password').val();
        let remember = $('#remember').is(':checked');

        let formData = {
            'log-username': username,
            'log-password': password,
            'log-remember': remember,
            'action': 'custom_login',
            'security': ajax_object.security
        }
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                $('#spinner').show()
            },
            success: function (res) {
                if (res.success) {
                    let countdown = 3;
                    $.fancybox.open(`<div class="custom-popup success">${res.data.message}, chuyển hướng về trang chủ sau: <span class="countdown-login">${countdown}</span>s</div>`, {
                        modal: true, smallBtn: false
                    });
                    let timer = setInterval(() => {
                        countdown--;
                        $('.countdown-login').text(countdown);
                        if (countdown == 0) {
                            window.location.href = res.data.redirect;
                            clearInterval(timer);
                        }
                    }, 1000)
                } else {
                    $.fancybox.open(`<div class="custom-popup error">${res.data.message}</div>`);
                }
            },
            complete: function () {
                $('#spinner').hide();
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        });
    })

    // Xử lí ajax register form
    $('#register-form').on('submit', function (e) {
        e.preventDefault();
        let username = $('#reg-username').val();
        let email = $('#reg-email').val();
        let pw = $('#reg-password').val();
        let display_name = $('#reg-display-name').val();
        let phone = $('#reg-phone').val();
        let formData = {
            'reg-username': username,
            'reg-email': email,
            'reg-password': pw,
            'reg-display-name': display_name,
            'reg-phone': phone,
            'action': 'custom_register',
            'security': ajax_object.security
        }
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: formData,
            dataType: 'json',
            beforeSend: function () {
                $('#spinner').show()
            },
            success: function (res) {
                console.log(res);
                if (res.success) {
                    $.fancybox.open(
                        `
                    <div class="custom-popup success">
                        ${res.data.message}
                    </div>
                    `
                    )
                    window.location.href = res.data.redirect;
                } else {
                    $.fancybox.open(
                        `
                    <div class="custom-popup error">
                        ${res.data.message}
                    </div>
                    `
                    )
                }
            },
            complete: function () {
                $('#spinner').hide();
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        })
    });
})