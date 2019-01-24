<?php
$blueBackground = get_sub_field('blue_background');
$greyBackground = get_sub_field('grey_background');
$textAlign = get_sub_field('text_align');
$moduleAlignment = get_sub_field('module_alignment');
$header = get_sub_field('header');
$body = get_sub_field('body');
$body2 = get_sub_field('body_2');

/* Career Apply Button */
$applyURL = get_field('apply_url');
?>

<div class="basic-text <?php if($blueBackground){ echo 'blue-background'; }?> <?php if($greyBackground){ echo 'grey-background'; }?> <?php if($textAlign) { echo 'align-text-'.$textAlign; } ?> <?php if($moduleAlignment) { echo 'module-align-'.$moduleAlignment; } ?>">
    <div class="basic-text__inner" data-columns="<?php echo ($body2) ? '2' : '1' ?>">
        <?php if($header) { ?>
            <h3><?php echo $header ?></h3>
        <?php } ?>
        <div class="basic-text__columns">
            <?php if($body) { ?>
                <div class="basic-text__column" data-columns="<?php echo ($body2) ? '2' : '1' ?>">
                    <?php echo $body ?>
                    <?php if($applyURL) { ?>
                        <a href="<?php echo $applyURL; ?>" class="btn" target="_blank">
                            <span>Apply for this position</span>
                            <svg class="arrow arrow-right" viewBox="0 0 32 14">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </a>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if($body2) { ?>
                <div class="basic-text__column" data-columns="<?php echo ($body2) ? '2' : '1' ?>">
                    <?php echo $body2 ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>