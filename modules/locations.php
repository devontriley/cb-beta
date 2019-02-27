<?php
$header = colorPeriodsRed(get_sub_field('header'));
$location1 = get_sub_field('location_1');
$location1Map = get_sub_field('location_1_map_link');
$location2 = get_sub_field('location_2');
$location2Map = get_sub_field('location_2_map_link');
$image1 = get_sub_field('image_1');
$image1URL = $image1['url'];
$image1Srcset = wp_get_attachment_image_srcset($image1['ID'], 'full');
$image1Sizes = wp_get_attachment_image_sizes($image1['ID'], 'full');
$image1Alt = $image1['alt'];
$image2 = get_sub_field('image_2');
$image2URL = $image2['url'];
$image2Srcset = wp_get_attachment_image_srcset($image2['ID'], 'full');
$image2Sizes = wp_get_attachment_image_sizes($image2['ID'], 'full');
$image2Alt = $image2['alt'];
?>

<div class="locations">
    <div class="locations__inner">
        <h2 class="locations__header"><?php echo $header ?></h2>
        <div class="locations__image">
            <img src="<?php echo $image1URL ?>" srcset="<?php echo $image1Srcset ?>" sizes="<?php echo $image1Sizes ?>" alt="<?php echo $image1Alt ?>" />
            <img src="<?php echo $image2URL ?>" srcset="<?php echo $image2Srcset ?>" sizes="<?php echo $image2Sizes ?>" alt="<?php echo $image2Alt ?>" />
        </div>
        <div class="locations__locations-container">
            <div class="locations__location">
                <span class="copy"><?php echo $location1 ?></span>
                <a href="<?php echo $location1Map ?>" target="_blank" class="btn gtm__location-boston">
                    <span>Maps</span>
                    <svg class="arrow arrow-right" viewBox="0 0 32 14">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </div>
            <div class="locations__location">
                <span class="copy"><?php echo $location2 ?></span>
                <a href="<?php echo $location2Map ?>" target="_blank" class="btn gtm__location-oak">
                    <span>Maps</span>
                    <svg class="arrow arrow-right" viewBox="0 0 32 14">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
