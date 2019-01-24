<?php
$images = get_sub_field('images');
if($images)
{
    $image1ID = $images[0]['image'];
    $image1 = wp_get_attachment_image_src($image1ID, 'full');

    $image2ID = $images[1]['image'];
    $image2 = wp_get_attachment_image_src($image2ID, 'full');

    $image3ID = $images[2]['image'];
    $image3 = wp_get_attachment_image_src($image3ID, 'full');
}
$callout = get_sub_field('callout_text');
?>

<div class="image-grid">
    <div class="image-grid__inner">
        <div class="image-grid__left">
            <div class="image-grid__image image-1">
                <img src="<?php echo $image1[0] ?>" alt="" />
            </div>
            <div class="image-grid__image image-2">
                <img src="<?php echo $image3[0] ?>" alt="" />
            </div>
        </div>
        <div class="image-grid__right">
            <div class="image-grid__image image-3">
                <img src="<?php echo $image2[0] ?>" alt="" />
            </div>
            <div class="image-grid__callout">
                <p><?php echo $callout ?></p>
            </div>
        </div>
    </div>
</div>
