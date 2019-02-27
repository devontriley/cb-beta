<!-- Not home -->
<?php
if(!is_page(8)) {
    $hide = get_field('hide_next_page_section');
    $header = get_field('next_page_header');
    $copy = colorPeriodsRed(get_field('next_page_copy'));
    $link = get_field('next_page_button_text');
    $url = get_field('next_page_url');
    $image = get_field('next_page_image');
    $imageURL = $image['url'];
    $srcset = wp_get_attachment_image_srcset($image['ID'], 'full');
    $sizes = wp_get_attachment_image_sizes($image['ID'], 'full');
    $alt = $image['alt']; ?>
    <footer class="main-footer">
        <div class="main-footer__inner">
            <?php if(!$hide) { ?>
            <div class="main-footer__image-copy">
                <div class="main-footer__copy">
                    <p class="main-footer__copy-header"><?php echo $header ?></p>
                    <p class="main-footer__copy-text"><?php echo $copy ?></p>
                    <a href="<?php echo $url ?>" class="btn gtm__footer-btn_id_<?php echo get_the_ID() ?>">
                        <span><?php echo $link ?></span>
                        <svg class="arrow arrow-right" viewBox="0 0 32 14">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                </div>
                <div class="main-footer__image">
                    <img src="<?php echo $imageURL ?>" srcset="<?php echo $srcset ?>" sizes="<?php echo $sizes ?>" alt="<?php echo $alt ?>" />
                </div>
            </div>
            <?php } ?>

            <div class="main-footer__locations">
                <div class="main-footer__addresses">
                    <div class="main-footer__address">
                        <p class="main-footer__address-state">BOS</p>
                        <p class="main-footer__address-loc">
                            53 State Street, 24th Floor<br />
                            Boston, MA 02109<br />
                            (617) 225-0001
                        </p>
                    </div>
                    <div class="main-footer__address">
                        <p class="main-footer__address-state">OAK</p>
                        <p class="main-footer__address-loc">
                            300 Frank H Ogawa Plaza<br />
                            Oakland, CA 94612<br />
                            (617) 225-0001
                        </p>
                    </div>
                    <a href="<?php echo bloginfo('url') ?>/contact-us" class="btn">
                        <span>Work With Us</span>
                        <svg class="arrow arrow-right" viewBox="0 0 32 14">
                            <use xlink:href="#arrow-right"></use>
                        </svg>
                    </a>
                </div>
                <div class="main-footer__logo">
                    <a href="<?php echo bloginfo('url'); ?>" class="gtm__logo-footer">
<!--                        <svg viewBox="0 0 198 38">-->
<!--                            <use xlink:href="#cb-logo"></use>-->
<!--                        </svg>-->
                        <img src="<?php echo bloginfo('template_directory') ?>/compiled/assets/images/global/footer-cb-logo-tagline.svg" />
                    </a>
                </div>
            </div>

            <div class="main-footer__base">
                <div class="main-footer__links">
                    <ul class="main-footer__footer-links">
                        <li><a href="<?php echo bloginfo('url') ?>/privacy-policy" class="gtm__footer-privacy">Privacy</a></li>
                        <li><a href="<?php echo bloginfo('url') ?>/legal" class="gtm__footer-legal">Legal</a></li>
                        <li><a href="<?php echo bloginfo('url') ?>/careers" class="gtm__footer-careers">Careers</a></li>
                    </ul>
                    <ul class="main-footer__sm">
                        <li>
                            <a href="https://www.facebook.com/cambridgebiomarketing/" target="_blank" class="gtm__footer-facebook">
                                <svg viewBox="0 0 24 24" width="24">
                                    <use xlink:href="#facebook-icon"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/cambridgebmg" target="_blank" class="gtm__footer-twitter">
                                <svg viewBox="0 0 24 24" width="24">
                                    <use xlink:href="#twitter-icon"></use>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/cambridgebiomarketing/" target="_blank" class="gtm__footer-instagram">
                                <svg viewBox="0 0 24 24" width="24">
                                    <use xlink:href="#instagram-icon"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="main-footer__copyright">
                    <p>
                        © <?php echo date('Y'); ?> CAMBRIDGE BIOMARKETING GROUP, LLC.
                    </p>
                </div>
            </div>
        </div>
    </footer>
<?php } else { ?>
    <footer class="home-footer">
        <a href="<?php echo bloginfo('url'); ?>/careers">
            <img src="<?php echo bloginfo('template_directory') ?>/compiled/assets/images/home/SVG/Home_Careers.svg" class="home-footer__hiring-svg" />
        </a>

        <div class="home-footer__scroll">
            <p>Scroll to Explore</p>
            <div class="mouse"></div>
        </div>

<!--        <div class="home-footer__live-chat">-->
<!--            LIVE CHAT-->
<!--        </div>-->
    </footer>
<?php } ?>
