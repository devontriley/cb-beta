<?php
$videoID = get_sub_field('video_id');
$poster = get_sub_field('video_poster_image');
$logoID = get_sub_field('logo');
$logo = ($logoID) ? wp_get_attachment_image_src($logoID, 'full') : null;
$header = get_sub_field('header');
$copy = get_sub_field('copy');
?>

<div class="video-embed">
    <div class="video-embed__inner">
        <?php if($logo || $header || $copy) { ?>
        <div class="video-embed__content">
            <?php if($logo) { ?>
                <div class="video-embed__logo">
                    <img src="<?php echo $logo[0] ?>" />
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