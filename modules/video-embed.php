<?php
$videoID = get_sub_field('video_id');
$poster = get_sub_field('video_poster_image');
$posterURL = $poster['url'];
$posterSrcset = wp_get_attachment_image_srcset($poster['ID'], 'full');
$posterSizes = wp_get_attachment_image_sizes($poster['ID'], 'full');
$posterAlt = $poster['alt'];
$logo = get_sub_field('logo');
$logoURL = $logo['url'];
$logoAlt = $logo['alt'];
$header = get_sub_field('header');
$copy = get_sub_field('copy');
?>

<div class="video-embed">
    <div class="video-embed__inner">
        <?php if($logo || $header || $copy) { ?>
        <div class="video-embed__content">
            <?php if($logo) { ?>
                <div class="video-embed__logo">
                    <img src="<?php echo $logoURL ?>" alt="<?php echo $logoAlt ?>" />
                </div>
            <?php } ?>
            <?php if($header) { ?>
                <h3 class="video-embed__header">
                    <?php echo $header ?>
                </h3>
            <?php } ?>
            <?php if($copy) { ?>
                <div class="video-embed__copy">
                    <?php echo $copy ?>
                </div>
            <?php } ?>
        </div>
        <?php } ?>

        <?php if($videoID) { ?>
        <div class="video-embed__video">
            <div class="video-embed__video-placeholder" data-id="<?php echo $videoID ?>">
                <?php echo $videoID ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>