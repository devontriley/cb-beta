<?php
$title = get_sub_field('title');
$blocks = get_sub_field('text_blocks');
?>

<div class="text-grid">
    <div class="text-grid__inner">
        <h2 class="text-grid__header"><?php echo $title ?></h2>
        <?php if($blocks) { ?>
        <ul class="text-grid__blocks">
            <?php foreach($blocks as $b) { ?>
                <li class="text-grid__block">
                    <div class="text-grid__block-copy">
                        <h3><?php echo $b['title'] ?></h3>
                        <p><?php echo $b['copy'] ?></p>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <nav class="text-grid__drag-nav">
            <div class="text-grid__drag-handle"></div>
        </nav>
        <?php } ?>
    </div>
</div>