<?php get_header() ?>

<?php include(__DIR__ . '/modules/modules.php'); ?>

<?php
$workQuery = new WP_Query([
    'post_type' => 'work',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);
$work = $workQuery->posts;
$prev = null;
$next = null;
$counter = 0;
foreach($work as $w)
{
    if($w->ID == $post->ID)
    {
        if($counter == 0) {
            $prev = $work[count($work) - 1];
            $next = $work[$counter + 1];
        } else if($counter == count($work) - 1) {
            $prev = $work[$counter - 1];
            $next = $work[0];
        } else {
            $prev = $work[$counter - 1];
            $next = $work[$counter + 1];
        }
    }
    $counter++;
}
?>

<div class="work-nav">
    <div class="work-nav__inner">
        <div class="work-nav__prev">
            <a href="<?php echo get_permalink($prev->ID); ?>">
                <svg viewBox="0 0 32 14">
                    <use xlink:href="#arrow-left"></use>
                </svg>
                <span>Previous</span>
            </a>
        </div>
        <div class="work-nav__all">
            <a href="<?php echo bloginfo('url'); ?>/our-work">
                <svg viewBox="0 0 31 31">
                    <use xlink:href="#case-studies-grid"></use>
                </svg>
                <span>View All Work</span>
            </a>
        </div>
        <div class="work-nav__next">
            <a href="<?php echo get_permalink($next->ID); ?>">
                <svg viewBox="0 0 32 14">
                    <use xlink:href="#arrow-right"></use>
                </svg>
                <span>Next</span>
            </a>
        </div>
    </div>
</div>

<?php get_footer() ?>
