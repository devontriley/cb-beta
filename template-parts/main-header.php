<?php $mainNav = wp_get_nav_menu_items('main-nav'); ?>

<nav class="mobile-nav">
    <div class="mobile-nav__logo">
        <a href="<?php echo bloginfo('url'); ?>">
            <svg class="logo" viewBox="0 0 198 38">
                <use xlink:href="#cb-logo"></use>
            </svg>
        </a>
        <a href="#" class="mobile-nav__close">
            <svg class="close" viewBox="0 0 14 14" width="14">
                <use xlink:href="#close-icon"></use>
            </svg>
        </a>
    </div>

    <ul class="mobile-nav__nav">
        <?php foreach($mainNav as $nav) : ?>
            <li class="mobile-nav__nav-item <?php if($nav->ID === $wp_query->ID){ echo 'active'; }?>">
                <a class="mobile-nav__nav-link gtm__main-nav__id_<?php echo $nav->ID ?>" href="<?php echo $nav->url ?>"><?php echo $nav->title ?></a>
            </li>
        <?php endforeach; ?>
        <li class="mobile-nav__nav-item <?php if($nav->ID === $wp_query->ID){ echo 'active'; }?>">
            <a class="mobile-nav__nav-link gtm__main-nav__id_<?php echo $nav->ID ?>" href="<?php echo bloginfo('url'); ?>/contact-us">Work With Us</a>
        </li>
    </ul>

    <ul class="mobile-nav__sm">
        <li class="mobile-nav__sm-item">
            <a href="https://www.facebook.com/cambridgebiomarketing/" class="mobile-nav__sm-link" target="_blank">
                <svg viewBox="0 0 24 24" width="24" class="mobile-nav__sm-svg">
                    <use xlink:href="#facebook-icon"></use>
                </svg>
            </a>
        </li>
        <li class="mobile-nav__sm-item">
            <a href="https://twitter.com/cambridgebmg" class="mobile-nav__sm-link" target="_blank">
                <svg viewBox="0 0 24 24" width="24" class="mobile-nav__sm-svg">
                    <use xlink:href="#twitter-icon"></use>
                </svg>
            </a>
        </li>
        <li class="mobile-nav__sm-item">
            <a href="https://www.instagram.com/cambridgebiomarketing/" target="_blank" class="mobile-nav__sm-link">
                <svg viewBox="0 0 24 24" width="24" class="mobile-nav__sm-svg">
                    <use xlink:href="#instagram-icon"></use>
                </svg>
            </a>
        </li>
    </ul>

    <div class="mobile-nav__locations">
        <div class="mobile-nav__location">
            <p class="mobile-nav__location-state">BOS</p>
            <p class="mobile-nav__location-address">
                53 State Street, 24th Fl<br />
                Boston, MA 02109<br />
                (617) 225-0001
            </p>
        </div>
        <div class="mobile-nav__location">
            <p class="mobile-nav__location-state">OAK</p>
            <p class="mobile-nav__location-address">
                300 Frank H Ogawa Plaza<br />
                Oakland, CA 94612<br />
                (617) 225-0001
            </p>
        </div>
    </div>
</nav>

<header class="main-header">
    <div class="main-header__logo">
        <a href="<?php echo bloginfo('url'); ?>" class="gtm__logo-header">
            <svg viewBox="0 0 198 38">
                <use xlink:href="#cb-logo"></use>
            </svg>
        </a>
    </div>

    <a href="#" class="main-header__hamburger" role="button">
        <svg viewBox="0 0 23 14" width="23">
            <use xlink:href="#hamburger-icon"></use>
        </svg>
    </a>

    <div class="main-header__main-nav">
        <ul class="main-nav__items">
            <?php foreach($mainNav as $nav) :
                $classes = '';
                if($nav->classes) {
                    foreach ($nav->classes as $c) {
                        $classes .= $c . ' ';
                    }
                }
                if($nav->object_id == $wp_query->get_queried_object_id()) {
                    $classes .= ' active';
                }
                ?>
                <li class="main-nav__item <?php echo $classes ?>">
                    <a class="main-nav__link gtm__main-nav__id_<?php echo $nav->ID ?>" href="<?php echo $nav->url ?>"><?php echo $nav->title ?></a>
                </li>
            <?php endforeach; ?>
            <li>
                <a href="<?php echo bloginfo('url'); ?>/contact-us" class="btn gtm__main-nav__id_18">
                    <span>Work with us</span>
                    <svg class="arrow arrow-right" viewBox="0 0 25 16">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</header>