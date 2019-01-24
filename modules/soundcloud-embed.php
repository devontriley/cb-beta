<?php
$soundCloudID = get_sub_field('soundcloud_id');
$header = get_sub_field('header');
$logoID = get_sub_field('logo');
$logo = ($logoID) ? wp_get_attachment_image_src($logoID, 'full') : null;
$copy = get_sub_field('copy');
?>

<div class="soundcloud-embed">
    <div class="soundcloud-embed__inner">
        <?php if($logo) { ?>
        <div class="soundcloud-embed__logo-mobile">
            <img src="<?php echo $logo[0] ?>" />
        </div>
        <?php } ?>
        <div class="soundcloud-embed__container">
            <iframe width="100%" height="500" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/635170155&color=%23ff5500&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=true"></iframe>
        </div>
        <div class="soundcloud-embed__content">
            <?php if($logo) { ?>
            <div class="soundcloud-embed__logo">
                <img src="<?php echo $logo[0] ?>" />
            </div>
            <?php } ?>
            <h3 class="soundcloud-embed__header">
                <?php echo $header ?>
            </h3>
            <div class="soundcloud-embed__copy">
                <?php echo $copy ?>
            </div>
        </div>
    </div>
</div>
