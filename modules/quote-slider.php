<?php
$quotes = get_sub_field('quotes');
?>

<div class="quote-slider">
    <div class="quote-slider__inner">
        <ul class="quote-slider__slider">
            <?php foreach($quotes as $q) {
                $imageID = wp_get_attachment_image_src($q['logo']);
                $image = $imageID[0]; ?>
                <li class="quote-slider__slide">
                    <div class="quote-slider__quote">
                        <?php echo $q['quote'] ?>
                    </div>
                    <div class="quote-slider__byline">
                        <?php echo $q['byline'] ?>
                    </div>
                    <img src="<?php echo $image ?>" class="quote-slider__logo" />
                </li>
            <?php } ?>
        </ul>
        <div class="quote-slider__arrows">
            <button class="quote-slider__prev">
                <svg viewBox="0 0 11 20">
                    <use xlink:href="#chevron-left"></use>
                </svg>
            </button>

            <button class="quote-slider__next">
                <svg viewBox="0 0 11 20">
                    <use xlink:href="#chevron-right"></use>
                </svg>
            </button>
        </div>
    </div>
</div>