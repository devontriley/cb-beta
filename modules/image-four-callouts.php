<?php
$title = colorPeriodsRed(get_sub_field('title'));
$items = get_sub_field('items');

if($items) { ?>

    <div class="image-four-callouts">
        <div class="image-four-callouts__inner">
            <h2 class="image-four-callouts__header"><?php echo $title ?></h2>
            <div class="image-four-callouts__image">
                <?php foreach ($items as $i) {
                    $image = $i['image'];
                    $imageURL = $image['url'];
                    $srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
                    $sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
                    $alt = $image['alt']; ?>
                    <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $alt ?>"/>
                <?php } ?>
            </div>
            <ul class="image-four-callouts__callouts">
                <?php
                $counter = 0;
                foreach ($items as $i) { ?>
                    <li class="<?php if ($counter == 0) {
                        echo 'active';
                    } ?>">
                        <div>
                            <?php echo $i['callout'] ?>
                        </div>
                    </li>
                    <?php $counter++;
                } ?>
            </ul>
            <div class="image-four-callouts__mobile-controls">
                <div class="prev">
                    <svg viewbox="0 0 25 16" width="25">
                        <use xlink:href="#arrow-left"></use>
                    </svg>
                </div>
                <div class="next">
                    <svg viewbox="0 0 25 16" width="25">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>

<?php } ?>