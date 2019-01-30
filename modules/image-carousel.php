<?php
$images = get_sub_field('images');
?>

<div class="image-carousel">
    <div class="image-carousel__inner">
        <div class="image-carousel__images">
            <?php foreach($images as $i) {
                $image = $i['image'];
                $imageURL = $image['url'];
                $srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
                $sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
                $alt = $image['alt']; ?>
                <div class="image-carousel__image">
                    <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $imageAlt ?>" />
                </div>
            <?php } ?>
        </div>
    </div>
</div>
