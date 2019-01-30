<?php
$callouts = get_sub_field('callouts');
$callout1 = get_sub_field('callout_1');
$callout2 = ($callouts == 2) ? get_sub_field('callout_2') : null;
$image = get_sub_field('image');
$imageURL = $image['url'];
$srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
$sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
$alt = $image['alt'];
?>

<div class="image-callouts" data-callouts="<?php echo $callouts ?>">
    <div class="image-callouts__inner">
        <div class="image-callouts__callout1">
            <?php echo $callout1 ?>
        </div>
        <div class="image-callouts__image">
            <div class="image-callouts__image">
                <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $imageAlt ?>" />
            </div>
        </div>
        <?php if($callout2) { ?>
        <div class="image-callouts__callout2">
            <p><?php echo $callout2 ?></p>
        </div>
        <?php } ?>
    </div>
</div>
