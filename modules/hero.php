<?php
$header = get_sub_field('header');
$copy = get_sub_field('copy');

/* Work Page */
$includeWorkFilter = get_sub_field('include_work_filter');
if($includeWorkFilter) {
    $workTerms = get_terms('work_categories');
}

/* Careers Page */
$includeCareers = get_sub_field('include_careers');
if($includeCareers) {
    $careers = new WP_Query([
        'post_type' => 'career',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ]);
}

/* Career Apply Button */
$applyURL = get_field('apply_url');

$subheader = get_sub_field('subheader');
$subheader_copy = get_sub_field('subheader_copy');
$large_page_title = get_sub_field('large_page_title');
$imageID = get_sub_field('image');
if($imageID) {
    $image = wp_get_attachment_image_src($imageID, 'full');
    $imageAlt = get_post_meta($imageID, '_wp_attachment_image_alt', true);
}
$video = get_sub_field('video');
?>

<div class="module-hero <?php if($includeWorkFilter) echo 'include-work-filter'; ?>">
    <div class="module-hero__inner">
        <div class="module-hero__header">
            <h1><?php echo $header ?></h1>
            <h2><?php echo $copy ?></h2>
            <?php if($applyURL) { ?>
                <a href="<?php echo $applyURL; ?>" class="btn" target="_blank">
                    <span>Apply for this position</span>
                    <svg class="arrow arrow-right" viewBox="0 0 32 14">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            <?php } ?>
        </div>

        <?php if($subheader || $subheader_copy) { ?>
        <div class="module-hero__subheader">
            <h3><?php echo $subheader ?></h3>
            <p class="module-hero__subheader-copy"><?php echo $subheader_copy ?></p>
            <span class="module-hero__large-page-title"><?php echo $large_page_title ?></span>
        </div>
        <?php } ?>

        <?php if($includeCareers) { ?>
            <div class="module-hero__subheader careers">
                <h3>Current openings.</h3>
                <ul>
                <?php foreach($careers->posts as $career) { ?>
                    <li><a href="<?php echo get_permalink($career->ID) ?>"><?php echo $career->post_title ?> ></a></li>
                <?php } ?>
                </ul>
                <p>Don't see the opening you're looking for? <a href="contact-us">Contact us!</a></p>
            </div>
        <?php } ?>

        <?php if($includeWorkFilter) { ?>
            <div class="module-hero__work-filter">
                <label>Filter Work By:</label>
                <select>
                    <option value="" selected>All</option>
                    <?php foreach($workTerms as $t) { ?>
                        <option value="<?php echo $t->term_id ?>"><?php echo $t->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>

        <?php if($subheader || $subheader_copy) { ?>
        <svg viewBox="0 0 317 469" class="module-hero__thumbprint">
            <use xlink:href="#thumbprint-icon"></use>
        </svg>
        <?php } ?>
    </div>

    <?php if($image) { ?>
        <img src="<?php echo $image[0] ?>" alt="<?php echo $imageAlt ?>" class="module-hero__image" />
    <?php } ?>

    <?php if($video) { ?>
        NEED TO LOAD HTML5 VIDEO HERE
    <?php } ?>
</div>
