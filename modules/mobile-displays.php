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
                    $imageID = $i['image'];
                    $image = wp_get_attachment_image_src($imageID, 'full');
                    $imageAlt = get_post_meta($imageID, '_wp_attachment_image_alt', true); ?>
                    <div class="mobile-displays__image-wrap">
                        <div class="mobile-displays__ui">
                            <img src="<?php bloginfo('template_directory'); ?>/compiled/assets/images/case_studies/Desktop/Project_Mobile_Display.svg" />
                        </div>
                        <div class="mobile-displays__image">
                            <img src="<?php echo $image[0] ?>" alt="<?php echo $altText ?>" />
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</div>
