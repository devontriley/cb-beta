<?php
$header = get_sub_field('header');
$images = get_sub_field('images');
?>

<div class="mobile-displays">
    <div class="mobile-displays__inner">
        <h2 class="mobile-displays__header">
            <?php echo $header ?>
        </h2>
        <div class="mobile-displays__images">
            <?php if($images) {
                foreach($images as $i) {
                    $image = $i['image'];
                    $imageURL = $image['url'];
                    $srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
                    $sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
                    $alt = $image['alt']; ?>
                    <div class="mobile-displays__image-wrap">
                        <div class="mobile-displays__ui">
                            <img src="<?php bloginfo('template_directory'); ?>/compiled/assets/images/case_studies/Desktop/Project_Mobile_Display.svg" />
                        </div>
                        <div class="mobile-displays__image">
                            <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $imageAlt ?>" />
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>
