<?php
$title = get_sub_field('title');
$copy = get_sub_field('copy');
$image = get_sub_field('image');
$imageURL = $image['url'];
$srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
$sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
$alt = $image['alt'];
$imageLeft = get_sub_field('image_left');
?>

<div class="module-50-50 <?php if($imageLeft) { echo 'image-left'; } ?>">
    <div class="module-50-50__inner">
        <div class="module-50-50__copy">
            <?php if($title) { ?><h2><?php echo $title ?></h2><?php } ?>
            <?php echo $copy ?>
        </div>
        <div class="module-50-50__image">
            <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $alt ?>" />
        </div>
    </div>
</div>
