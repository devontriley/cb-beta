<?php
$args = [
    'post_type' => 'work',
    'orderby' => 'menu_order',
    'order' => 'ASC'
];
$work = new WP_Query($args);
?>

<div class="work-grid">
    <div class="work-grid__inner">
        <?php if($work->posts) { ?>
        <div class="work-grid__items">
            <?php foreach($work->posts as $w) {
                $imageID = $w->thumbnail;
                $image = wp_get_attachment_image_src($imageID, 'full'); ?>
            <div class="work-grid__item">
                <a href="<?php echo get_permalink($w->ID) ?>" class="cover-link"></a>
                <p class="work-grid__item-tag">Capability Tag</p>
                <header>
                    <p class="work-grid__item-client"><?php echo $w->client_name ?></p>
                    <p class="work-grid__item-copy"><?php echo $w->post_title ?></p>
                </header>
                <img class="work-grid__item-image" src="<?php echo $image[0] ?>" />
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>