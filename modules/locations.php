<?php
$header = get_sub_field('header');
$location1 = get_sub_field('location_1');
$location1Map = get_sub_field('location_1_map_link');
$location2 = get_sub_field('location_2');
$location2Map = get_sub_field('location_2_map_link');
$image = get_sub_field('image');
$imageURL = $image['url'];
$srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
$sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
$alt = $image['alt'];
?>

<div class="locations">
    <div class="locations__inner">
        <h2 class="locations__header"><?php echo $header ?></h2>
        <div class="locations__image">
            <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $imageAlt ?>" />
        </div>
        <div class="locations__locations-container">
            <div class="locations__location">
                <?php echo $location1 ?><br />
                <a href="<?php echo $location1Map ?>" class="btn">
                    <span>Maps</span>
                    <svg class="arrow arrow-right" viewBox="0 0 32 14">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </div>
            <div class="locations__location">
                <?php echo $location2 ?><br />
                <a href="<?php echo $location2Map ?>" class="btn">
                    <span>Maps</span>
                    <svg class="arrow arrow-right" viewBox="0 0 32 14">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
