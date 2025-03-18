<?php

/**
 * 
 */

$categories = get_terms([
    'taxonomy' => 'product_cat',
    'hide_empty' => true
]);
$tags = get_terms(array(
    'taxonomy'   => 'product_tag', // WooCommerce Product Tags
    'hide_empty' => true,
));
$pa_size = get_terms([
    'taxonomy' => 'pa_size',
    'hide_empty' => false,
]);
$pa_color = get_terms([
    'taxonomy' => 'pa_color',
    'hide_empty' => false,
]);
debug_to_console($pa_color);
$color_map = [
    'black' => '#000000',
    'pink' => '#FFC0CB',
    'white' => '#FFFFFF',
];

?>

<div class="filter-archive-product">
    <form action="" class="filter-form">
        <!-- Categories -->
        <div class="categories">
            <h4>Categories:</h4>
            <?php if ($categories): ?>
                <?php foreach ($categories as $item): ?>
                    <input type="checkbox" name="filter_cats[]" value="<?= esc_attr($item->term_id); ?>">
                    <?= $item->name; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No categories yet!</p>
            <?php endif; ?>
        </div>
        <!-- Tags -->
        <div class="tags">
            <h4>Tags:</h4>
            <?php if ($tags): ?>
                <?php foreach ($tags as $item): ?>
                    <input type="checkbox" name="filter_tags[]" value="<?= esc_attr($item->term_id); ?>">
                    <?= $item->name; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No tags yet!</p>
            <?php endif; ?>
        </div>
        <!-- Size -->
        <div class="size">
            <h4>Size:</h4>
            <?php if ($pa_size): ?>
                <?php foreach (array_reverse($pa_size) as $item): ?>
                    <input type="checkbox" name="filter_size[]" value="<?= esc_attr($item->slug); ?>">
                    <?= $item->name; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Not Size yet!</p>
            <?php endif; ?>
        </div>
        <div class="color">
            <h4>Color:</h4>
            <?php if ($pa_color): ?>
                <?php foreach ($pa_color as $item): ?>
                    <?php $color = isset($color_map[$item->slug]) ? $color_map[$item->slug] : '#fff'; ?>
                    <input type="checkbox" name="filter_size[]" value="<?= esc_attr($item->slug); ?>">
                    <span class="color-box" style="background-color: <?php echo esc_attr($color); ?>;"></span>
                    <?= $item->name; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Not Size yet!</p>
            <?php endif; ?>
        </div>
        <button type="submit">Lọc</button>
    </form>

</div>