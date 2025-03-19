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
    $(document).on('click', '.add-to-cart-btn', function (e) {
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
                button.prop('disabled', false);
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
                button.prop('disabled', true);
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        })
    });

    // Xử lí ajax update quantity cart
    $(document).on('click', '.qty-minus, .qty-plus', function () {
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
        updateQtyCart(cartItemKey, newQty, input, cartItem);
    });

    // Xử lí ajax remove quanity cart
    $(document).on('click', '.custom-mini-cart .remove', function () {
        let cartItem = $(this).closest('.cart-item');
        let cartKeyItem = cartItem.data('cart-item');
        removeItemCart(cartItem, cartKeyItem)
    });



    // Hàm Rmove Item từ Minicart
    function removeItemCart(cartItem, cartKeyItem) {
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
                showSpin(cartItem);
            },
            success: function (response) {
                if (response.success) {
                    cartItem.remove();
                    $('.cart-total').html(response.data.cart_total);
                    $('.cart-count').text(response.data.cart_count);
                    $('.cart-header .count').text(response.data.cart_count);
                }
            },
            complete: function () {
                removeSpin(cartItem);
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        })
    }

    // Tái sử dụng update quantity
    function updateQtyCart(cartItemKey, quantity, input, cartItem) {
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'update_cart_quantity',
                cart_item_key: cartItemKey,
                quantity: quantity,
                security: ajax_object.security
            },
            dataType: 'json',
            beforeSend: function () {
                showSpin(cartItem);
            },
            success: function (res) {
                input.val(quantity);
                $('.cart-total').html('Total: ' + res.data.cart_total);
                $('.cart-count').text(res.data.cart_count);
                $('.cart-header .count').text(res.data.cart_count);
            },
            complete: function () {
                removeSpin(cartItem);
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        });
    };


    // ------------- START ARCHIVE PRODUCT --------------

    // Sort
    $(document).on('click', '.sort-options li', function () {
        let sort = $(this).data('sort');
        $(this).addClass('active');
        loadProducts({ sort: sort })
    });

    // Phân trang 
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let sort = $('.sort-options li.active').data('sort') || 'newest'; // Sort
        let selectCat = getSelectedCategories(); // Category
        let selectTag = getSelectedTags(); // Tags
        let selectSize = getSelectedSize(); // Size
        let selectedColor = getSelectedColor(); // Color
        let getPrice = getMinPrice(); // Price
        loadProducts({
            page: page,
            sort: sort,
            category: selectCat,
            tag: selectTag,
            size: selectSize,
            color: selectedColor,
            price: getPrice
        });
    })

    // FIlter submit
    $('.filter-archive-product .filter-form').on('submit', function (e) {
        e.preventDefault();
        let selectCat = getSelectedCategories();
        let selectTag = getSelectedTags();
        let selectSize = getSelectedSize();
        let selectedColor = getSelectedColor();
        let getPrice = getMinPrice();
        console.log(getPrice);

        loadProducts({ category: selectCat, tag: selectTag, size: selectSize, color: selectedColor, price: getPrice });
    });

    // Hàm lấy danh sách category đã chọn
    function getSelectedCategories() {
        let categories = [];
        $('input[name="filter_cats[]"]:checked').each(function () {
            categories.push($(this).val());
        });
        return categories;
    };

    // Hàm lấy danh sách tags đã chọn
    function getSelectedTags() {
        let tagSelected = [];
        $("input[name='filter_tags[]']:checked").each(function () {
            tagSelected.push($(this).val());
        });
        return tagSelected;
    };

    // Hàm lấy danh sách size
    function getSelectedSize() {
        let selectedSize = [];
        $("input[name='filter_size[]']:checked").each(function () {
            selectedSize.push($(this).val());
        });
        return selectedSize;
    }

    // Hàm lấy danh sách color
    function getSelectedColor() {
        let selectedColor = [];
        $("input[name='filter_color[]']:checked").each(function () {
            selectedColor.push($(this).val());
        });
        return selectedColor;
    }

    // Hàm lấy min price
    function getMinPrice() {
        let price = {};
        slider.noUiSlider.on("update", function (values) {
            var min = parseInt($("#minValue").text())
            var max = parseInt($("#maxValue").text())
            price = { min, max };
        });
        return price;
    }

    getSelectedColor();

    function loadProducts({
        page = 1,
        sort = 'newest',
        category = [],
        tag = [],
        size = [],
        color = [],
        price = {}
    } = {}) {
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'load_archive_products',
                page,
                sort,
                category,
                tag,
                size,
                color,
                min: price.min,
                max: price.max,
                security: ajax_object.security
            },
            beforeSend: function () {
                $('.post-type-archive-product .site-main').append('<div class="spinner-woo-card-loop middle"></div>');
            },
            success: function (response) {
                $('.archive-product .product-list').fadeOut(200, function () {
                    $(this).html(response.data.html).fadeIn(200);
                    $('html, body').animate({ scrollTop: $('.archive-product .product-list').offset().top }, 'slow');
                });
                $('.archive-product .pagination').fadeOut(200, function () {
                    $(this).html(response.data.pagination).fadeIn(200);
                });
            },
            complete: function () {
                $('.post-type-archive-product .site-main').find('.spinner-woo-card-loop').fadeOut(200);

                // CLose sidebar nếu user filter thành công
                $('.product-sidebar').removeClass('active');
                $('#overlay').removeClass('active');
            },
            error: function (xhr, status, error) {
                console.log("Lỗi AJAX:", status, error);
                console.log("Phản hồi từ server:", xhr.responseText);
            }
        });
    }

    loadProducts();

    // ------------- END ARCHIVE PRODUCT --------------


    function showSpin(div) {
        div.append('<div class="spinner-woo-card-loop"></div>')
    }
    function removeSpin(div) {
        div.find('.spinner-woo-card-loop').fadeOut(200);
    }

})
