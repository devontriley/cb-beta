<?php
$header = get_sub_field('header');
$location1 = get_sub_field('location_1');
$location1Map = get_sub_field('location_1_map_link');
$location2 = get_sub_field('location_2');
$location2Map = get_sub_field('location_2_map_link');
$imageID = get_sub_field('image');
if($imageID) $image = wp_get_attachment_image_src($imageID, 'full');
?>

<div class="locations">
    <div class="locations__inner">
        <h2 class="locations__header"><?php echo $header ?></h2>
        <div class="locations__image">
            <img src="<?php echo $image[0] ?>" />
        </div>
        <div class="locations__locations-container">
            <div class="locations__location">
                <?php echo $location1 ?>
                <a href="<?php echo $location1Map ?>">Maps</a>
            </div>
            <div class="locations__location">
                <?php echo $location2 ?>
                <a href="<?php echo $location2Map ?>">Maps</a>
            </div>
        </div>
    </div>
</div>
