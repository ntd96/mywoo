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

    // Xử lí ajax add to cart
    $('.add-to-cart-btn').on('click', function (e) {
        e.preventDefault();
        let productID = $(this).data('product-id');
        let data = {
            'action': 'custom_add_to_cart',
            'security': ajax_object.security,
            'product_id': productID
        };
        let button = $(this);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: data,
            dataType: 'json',
            beforeSend: function () {
                button.find('.icon-add-to-cart').hide();
                button.append('<div class="spinner-woo-card-loop"></div>');
            },
            success: function (res) {
                let cartCount = $('.cart-count');
                if (res.success) {
                    cartCount.text(res.data.cart_count);
                    $('#slide-cart .cart-content').html(res.data.mini_cart);
                } else {
                    alert(res.message || 'Có lỗi xảy ra!');
                }
            },
            complete: function () {

                button.find('.spinner-woo-card-loop').fadeOut(200, function () {
                    $(this).remove();
                    let checkmark = $(`<div class="checkmark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>

                            </div>`).hide();
                    button.append(checkmark);
                    checkmark.fadeIn(250);
                });

            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        })
    });

    // Xử lí ajax update quantity cart
    $('.qty-minus, .qty-plus').on('click', function () {

        // Tìm thằng cha lớn nhất
        let cartItem = $(this).closest('.cart-item');
        // Lấy attribute data từ thằng cha
        let cartItemKey = cartItem.data('cart-item');
        // Tìm input number
        let input = cartItem.find('.cart-qty');
        // Ep thành num
        let currentQty = parseInt(input.val());
        // calculate, néu plus thì + 1, ngược lại - 1
        let newQty = currentQty + ($(this).hasClass('qty-plus') ? 1 : -1);
        if (newQty < 1) return; // Nhỏ hơn 1 thì cook
        updateQtyCart(cartItemKey, newQty, input);
    });

    // Xử lí ajax remove quanity cart
    $('.custom-mini-cart .remove').on('click', function () {
        let cartItem = $(this).closest('.cart-item');
        let cartKeyItem = cartItem.data('cart-item');
        let button = $(this);
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            dataType: 'json',
            data: {
                action: 'remove_cart_quantity',
                cart_key_item: cartKeyItem,
                security: ajax_object.security
            },
            beforeSend: function () {
                button.append('<div class="spinner-woo-card-loop"></div>');

            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    cartItem.remove();
                    $('.cart-total').html(response.data.cart_total);
                    $('.cart-count').text(response.data.cart_count);
                    $('.cart-header .count').text(response.data.cart_count);
    
                }

            },
            complete: function () {
                button.find('.spinner-woo-card-loop').fadeOut(200);
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        })

    });

    // Tái sử dụng update quantity
    function updateQtyCart(cartItemKey, quantity, input) {
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'update_cart_quantity',
                cart_item_key: cartItemKey,
                quantity: quantity,
                nonce: ajax_object.security
            },
            dataType: 'json',
            success: function (res) {
                input.val(quantity);
                $('.cart-total').html(res.data.cart_total);
                $('.cart-count').text(res.data.cart_count);
                $('.cart-header .count').text(res.data.cart_count);
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        });
    };

})
