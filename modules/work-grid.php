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
                $image = get_field('thumbnail', $w->ID);
                $imageURL = $image['url'];
                $srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
                $sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
                $alt = $image['alt']; ?>
            <div class="work-grid__item">
                <a href="<?php echo get_permalink($w->ID) ?>" class="cover-link"></a>
                <p class="work-grid__item-tag">Capability Tag</p>
                <header>
                    <p class="work-grid__item-client"><?php echo $w->client_name ?></p>
                    <p class="work-grid__item-copy"><?php echo $w->post_title ?></p>
                </header>
                <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $imageAlt ?>" class="work-grid__item-image" />
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>