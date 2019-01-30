<?php
$image = get_sub_field('image');
$imageURL = $image['url'];
$srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
$sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
$alt = $image['alt'];
?>

<div class="browser-display">
    <div class="browser-display__inner">
        <div class="browser-display__ui">
            <svg viewBox="0 0 1135 33">
                <use xlink:href="#browser-display"></use>
            </svg>
        </div>
        <div class="browser-display__image">
            <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $alt ?>" />
        </div>
    </div>
</div>
