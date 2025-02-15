jQuery(document).ready(function ($) {
    // header
    $('[data-fancybox]').fancybox({
        touch: false
    });
    $('#custom-login-form').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize() + '&action=custom_ajax_login&security=' + custom_login.security;
        $.ajax({
            type: 'POST',
            url: custom_login.ajax_url,
            data: formData,
            dataType: 'json',
            beforeSend: function() {
                $('#spinner').show();
            },
            success: function(response) {
                $('#spinner').hide(); // Ẩn spinner thay vì remove
                if (response.status) {
                    $('#login-message').html(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                } else {
                    $('#login-message').html(response.message);
                }
            }
        });
    });
})