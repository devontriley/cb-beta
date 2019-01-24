<?php
$moduleTitle = get_sub_field('title');
$teamMembers = new WP_Query([
    'post_type' => 'team',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);
?>

<div class="team-profiles">
    <div class="team-profiles__inner">
        <h2 class="team-profiles__header">
            <?php echo $moduleTitle ?>
        </h2>
        <ul class="team-profiles__slider">
            <?php
            if($teamMembers)
            {
                foreach($teamMembers->posts as $t)
                {
                    $name = $t->post_title;
                    $title = get_field('title', $t->ID);
                    $headshotID = get_field('headshot', $t->ID);
                    $headshot = wp_get_attachment_image_src($headshotID, 'full');
                    ?>
                    <li>
                        <div class="team-profiles__headshot">
                            <img src="<?php echo $headshot[0] ?>" />
                        </div>
                        <h3 class="team-profiles__name"><?php echo $name ?></h3>
                        <p class="team-profiles__title"><?php echo $title ?></p>
                    </li>
                <?php }
            }
            ?>
        </ul>
        <div class="team-profiles__slider-nav">
            <div class="team-profiles__slider-handle"></div>
        </div>
    </div>
</div>

<div class="team-profiles__modal">
    <div class="team-profiles__modal-inner">
        <?php
        if($teamMembers)
        {
            foreach($teamMembers->posts as $t)
            {
                $name = $t->post_title;
                $title = get_field('title', $t->ID);
                $headshotID = get_field('headshot', $t->ID);
                $headshot = wp_get_attachment_image_src($headshotID, 'full');
                ?>
                <div class="team-profiles__modal-member">
                    <div class="team-profiles__modal-image">
                        <img src="<?php echo $headshot[0] ?>" alt="<?php echo $name ?>" />
                    </div>
                    <div class="team-profiles__modal-bio">
                        <a href="#" class="team-profiles__modal-close">
                            <img src="<?php echo bloginfo('template_directory'); ?>/compiled/assets/images/about_us/SVG/Lightbox_Close.svg" />
                        </a>
                        <h3 class="team-profiles__modal-bio-name">
                            <?php echo $name ?>
                        </h3>
                        <p class="team-profiles__modal-bio-title">
                            <?php echo $title ?>
                        </p>
                        <div class="team-profiles__modal-bio-copy">
                            <p>
                                Maureen led major rare disease brands at Genzyme; at CB, she has led the agency and its clients to unprecedented growth through her unique insights, experience, and humor. Maureen led major rare disease brands at Genzyme; at CB, she has led the agency and its clients to unprecedented growth through her unique insights, experience, and humor.
                            </p>
                        </div>
                        <a href="#" class="team-profiles__modal-next btn">
                            Next
                            <svg class="arrow arrow-left" viewBox="0 0 33 21" width="33px" height="21px">
                                <use xlink:href="#left-arrow"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php }
        }
        ?>
    </div>
</div>

