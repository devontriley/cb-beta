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
                    $image = get_field('headshot', $t->ID);
                    $imageURL = $image['url'];
                    $srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
                    $sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
                    $alt = $image['alt'];
                    ?>
                    <li>
                        <div class="team-profiles__headshot">
                            <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $imageAlt ?>" />
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
                $bio = get_field('bio', $t->ID);
                $image = get_field('headshot', $t->ID);
                $imageURL = $image['url'];
                $srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
                $sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
                $alt = $image['alt']; ?>
                <div class="team-profiles__modal-member">
                    <div class="team-profiles__modal-image">
                        <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $imageAlt ?>" />
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
                                <?php echo $bio ?>
                            </p>
                        </div>
                        <a href="#" class="team-profiles__modal-next btn">
                            <span>Next</span>
                            <svg class="arrow arrow-right" viewBox="0 0 32 14">
                                <use xlink:href="#arrow-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php }
        }
        ?>
    </div>
</div>

