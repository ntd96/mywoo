jQuery(document).ready(function ($) {

    // Toggle Sidebar
    $('.filter').on('click', function () {
        let productSidebar = $(this).closest('.filter-sort').siblings('.product-sidebar');
        productSidebar.toggleClass('active');
        $('#overlay').toggleClass('active');
    });
    $('#overlay').on('click', function () {
        $('.product-sidebar').removeClass('active');
    })

    // Toggle Sort
    $('.filter-sort .sort').on('click', function () {
        $(this).find('.sort-options').toggleClass('active');
        $(this).find('svg').toggleClass('active');
    })
    $(document).click('click', function (event) {
        if (!$(event.target).closest('.filter-sort .sort').length) {
            $('.sort-options').removeClass('active');
            $('.sort svg').removeClass('active');
        }
    })

    $('.option-btn').on('click', function () {
        $('.option-btn').removeClass('active');
        $(this).addClass('active');
        const viewType = $(this).data('view');
        $('.product-list').removeClass('grid-medium grid-large list')
            .addClass(viewType);
    });

    // $('#min-price, #max-price').on('input', function () {
    //     let min = $('#min-price').val();
    //     let max = $('#max-price').val();
    //     console.log(min, max);

    //     $('.price #price-value').text('$' + $(this).val());
    // });

    let slider = document.querySelector('.price #slider');

    noUiSlider.create(slider, {
        start: [0, 200],
        connect: true,
        range: { min: 0, max: 200 },
        step: 1,
    });
    slider.noUiSlider.on("update", function (values) {
        $("#minValue").text(Math.round(values[0]));
        $("#maxValue").text(Math.round(values[1]));
    });
    
})