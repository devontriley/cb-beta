<?php
$images = get_sub_field('images');
?>

<div class="image-carousel">
    <div class="image-carousel__inner">
        <div class="image-carousel__images">
            <?php foreach($images as $i) {
                $imageID = $i['image'];
                $image = wp_get_attachment_image_src($imageID, 'full'); ?>
                <div class="image-carousel__image">
                    <img src="<?php echo $image[0] ?>" />
                </div>
            <?php } ?>
        </div>
    </div>
</div>
