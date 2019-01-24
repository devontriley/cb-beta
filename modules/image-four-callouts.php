<?php
$title = get_sub_field('title');
$imageID = get_sub_field('image');
$imageURL = wp_get_attachment_image_src($imageID, 'full');
$callouts = get_sub_field('callouts');
?>

<div class="image-four-callouts">
    <div class="image-four-callouts__inner">
        <h2 class="image-four-callouts__header"><?php echo $title ?></h2>
        <div class="image-four-callouts__image">
            <img src="<?php echo $imageURL[0] ?>" />
        </div>
        <ul class="image-four-callouts__callouts">
            <?php
            foreach($callouts as $c) { ?>
                <li>
                    <div>
                        <?php echo $c['text'] ?>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>