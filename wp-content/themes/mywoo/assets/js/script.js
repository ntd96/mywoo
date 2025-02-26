jQuery(document).ready(function ($) {
    // header
    $('[data-fancybox]').fancybox({
        touch: false
    });


    // -- Xứ lí ajax Login
    $('#login-form').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize() + '&action=custom_login&security=' + ajax_object.security;
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
                    $.fancybox.open(`<div class="custom-popup">${res.data.message}, chuyển hướng về trang chủ sau: <span class="countdown-login">${countdown}</span>s</div>`, {
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
                    $.fancybox.open(`<div class="custom-popup">${res.data.message}</div>`);
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

    // Xử lí tác

})