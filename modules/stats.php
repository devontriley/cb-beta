<?php
$header = get_sub_field('header');
$stats = get_sub_field('stats');
?>

<div class="project-stats">
    <div class="project-stats__inner">
        <h2 class="project-stats__header"><?php echo $header ?></h2>
        <div class="project-stats__stats">
            <?php foreach($stats as $s) { ?>
                <div class="project-stats__stat">
                    <div>
                        <div class="project-stats__stat-value"><?php echo $s['value'] ?></div>
                        <div class="project-stats__stat-text"><?php echo $s['text'] ?></div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
