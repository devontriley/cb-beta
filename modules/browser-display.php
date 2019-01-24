<?php
$imageID = get_sub_field('image');
$image = wp_get_attachment_image_src($imageID, 'full');
$imageAlt = get_post_meta($imageID, '_wp_attachment_image_alt', true);
?>

<div class="browser-display">
    <div class="browser-display__inner">
        <div class="browser-display__ui">
            <svg viewBox="0 0 1135 33">
                <use xlink:href="#browser-display"></use>
            </svg>
        </div>
        <div class="browser-display__image">
            <img src="<?php echo $image[0] ?>" alt="<?php echo $imageAlt ?>" />
        </div>
    </div>
</div>
