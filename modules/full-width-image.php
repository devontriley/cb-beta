<?php
$image = get_sub_field('image');
$imageURL = $image['url'];
$srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
$sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
$alt = $image['alt'];
$fileType = get_post_mime_type($image['ID']);
?>

<div class="full-width-image <?php if($fileType == 'image/svg+xml') { ?>svg<?php } ?>">
    <div class="full-width-image__inner">
        <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $imageAlt ?>" class="full-width-image__image" />
    </div>
</div>