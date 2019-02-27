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
        <ul class="image-carousel__nav">
            <?php for($i = 0; $i < count($images); $i++) { ?>
                <li <?php if($i === 0){ echo 'class="active"'; } ?>><a href="#"></a></li>
            <?php } ?>
        </ul>
    </div>
</div>
