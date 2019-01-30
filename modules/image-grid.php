<?php
$images = get_sub_field('images');
$callout = get_sub_field('callout_text');
?>

<div class="image-grid">
    <div class="image-grid__inner">
        <div class="image-grid__left">
            <div class="image-grid__image image-1">
                <?php foreach($images[0] as $image) {
                    foreach($image as $i) {
                        $iArr = $i['image'];
                        $imageURL = $iArr['url'];
                        $srcset = wp_get_attachment_image_srcset($iArr['ID'], 'full');
                        $sizes = wp_get_attachment_image_sizes($iArr['ID'], 'full');
                        $alt = $iArr['alt']; ?>
                        <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $alt ?>" />
                <?php }
                } ?>
            </div>
            <div class="image-grid__image image-2">
                <?php foreach($images[2] as $image) {
                    foreach($image as $i) {
                        $iArr = $i['image'];
                        $imageURL = $iArr['url'];
                        $srcset = wp_get_attachment_image_srcset($iArr['ID'], 'full');
                        $sizes = wp_get_attachment_image_sizes($iArr['ID'], 'full');
                        $alt = $iArr['alt']; ?>
                        <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $alt ?>" />
                    <?php }
                } ?>
            </div>
        </div>
        <div class="image-grid__right">
            <div class="image-grid__image image-3">
                <?php foreach($images[1] as $image) {
                    foreach($image as $i) {
                        $iArr = $i['image'];
                        $imageURL = $iArr['url'];
                        $srcset = wp_get_attachment_image_srcset($iArr['ID'], 'full');
                        $sizes = wp_get_attachment_image_sizes($iArr['ID'], 'full');
                        $alt = $iArr['alt']; ?>
                        <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $alt ?>" />
                    <?php }
                } ?>
            </div>
            <div class="image-grid__callout">
                <p><?php echo $callout ?></p>
            </div>
        </div>
    </div>
</div>
