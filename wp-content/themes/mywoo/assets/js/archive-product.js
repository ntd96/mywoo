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



})