<?php
$header = get_sub_field('header');
$tabs = get_sub_field('tabs');
?>

<div class="tab-system">
    <div class="tab-system__inner">
        <h2 class="tab-system__header"><?php echo $header ?></h2>
        <div class="tab-system__tabs">
            <ul>
                <?php
                $counter = 0;
                foreach($tabs as $t) { ?>
                    <li>
                        <a href="#" <?php if($counter == 0) { echo 'aria-selected="true"'; } else { echo 'aria-selected="false"'; } ?>>
                            <?php echo $t['header'] ?>
                        </a>
                    </li>
                <?php $counter++; } ?>
            </ul>
        </div>
        <div class="tab-system__panels">
            <?php
            $counter = 0;
            foreach($tabs as $t) {
                $header = $t['header'];
                $imageID = $t['image'];
                $image = wp_get_attachment_image_src($imageID, 'full');
                $copy = $t['copy'];
                $quote = $t['quote'];
                $name = $t['name'];
                $title = $t['title']; ?>
                <div class="tab-system__panel" <?php if($counter == 0) { echo 'aria-hidden="false"'; } else { echo 'aria-hidden="true" style="display: none;"'; } ?> aria-labelledby="<?php echo $t['header'] ?>">
                    <div class="tab-system__panel-image">
                        <img src="<?php echo $image[0] ?>" />
                    </div>
                    <div class="tab-system__panel-content">
                        <p class="tab-system__panel-header" tabindex="0"><?php echo $header ?></p>
                        <div class="tab-system__panel-copy">
                            <p tabindex="0"><?php echo $copy ?></p>
                        </div>
                        <?php if($quote) { ?><p class="tab-system__panel-quote" tabindex="0"><?php echo $quote ?></p><?php } ?>
                        <?php if($name) { ?><p class="tab-system__panel-name" tabindex="0"><?php echo $name ?></p><?php } ?>
                        <?php if($title) { ?><p class="tab-system__panel-title" tabindex="0"><?php echo $title ?></p><?php } ?>
                    </div>
                </div>
            <?php $counter++; } ?>
        </div>
        <div class="tab-system__slider-nav">
            <div class="tab-system__slider-handle"></div>
        </div>
    </div>
</div>
