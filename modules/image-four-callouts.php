<?php
$title = get_sub_field('title');
$callouts = get_sub_field('callouts');
$images = get_sub_field('images');
?>

<div class="image-four-callouts">
    <div class="image-four-callouts__inner">
        <h2 class="image-four-callouts__header"><?php echo $title ?></h2>
        <div class="image-four-callouts__image">
            <?php foreach($images as $i) {
                $image = $i['image'];
                $imageURL = $image['url'];
                $srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
                $sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
                $alt = $image['alt']; ?>
                <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $alt ?>" />
            <?php } ?>
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