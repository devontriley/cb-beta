<?php
$imageID = get_sub_field('image');
$image = wp_get_attachment_image_src($imageID, 'full');
?>

<div class="full-width-image">
    <img src="<?php echo $image[0] ?>" class="full-width-image__image" />
<!--    <svg class="full-width-svg__svg" viewBox="0 0 989 184">-->
<!--        <use xlink:href="#our-approach-svg"></use>-->
<!--    </svg>-->
</div>