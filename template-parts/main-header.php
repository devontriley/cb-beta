<?php $mainNav = wp_get_nav_menu_items('main-nav'); ?>

<nav class="mobile-nav">
    <div class="mobile-nav__logo">
        <svg viewBox="0 0 198 38">
            <use xlink:href="#cb-logo"></use>
        </svg>
        <a href="#" class="mobile-nav__close">
            X
        </a>
    </div>

    <ul class="mobile-nav__nav">
        <?php foreach($mainNav as $nav) : ?>
            <li class="mobile-nav__nav-item">
                <a class="mobile-nav__nav-link" href="<?php echo $nav->url ?>"><?php echo $nav->title ?></a>
            </li>
        <?php endforeach; ?>
    </ul>

    <ul class="mobile-nav__sm">
        <li class="mobile-nav__sm-item">
            <a href="#" class="mobile-nav__sm-link">
                <svg viewBox="0 0 24 24" width="24" class="mobile-nav__sm-svg">
                    <use xlink:href="#facebook-icon"></use>
                </svg>
            </a>
        </li>
        <li class="mobile-nav__sm-item">
            <a href="#" class="mobile-nav__sm-link">
                <svg viewBox="0 0 24 24" width="24" class="mobile-nav__sm-svg">
                    <use xlink:href="#twitter-icon"></use>
                </svg>
            </a>
        </li>
        <li class="mobile-nav__sm-item">
            <a href="#" class="mobile-nav__sm-link">
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
                555 Address Ave<br />
                Boston, MA 05555<br />
                (555) 555-5555
            </p>
        </div>
        <div class="mobile-nav__location">
            <p class="mobile-nav__location-state">SFO</p>
            <p class="mobile-nav__location-address">
                555 Address Ave<br />
                San Fransisco, CA 05555<br />
                (555) 555-5555
            </p>
        </div>
    </div>
</nav>

<header class="main-header">
    <div class="main-header__logo">
        <a href="<?php echo bloginfo('url'); ?>">
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
                if($nav->classes) {
                    $classes = '';
                    foreach ($nav->classes as $c) {
                        $classes .= $c . ' ';
                    }
                } ?>
                <li class="main-nav__item <?php echo $classes ?>">
                    <a class="main-nav__link" href="<?php echo $nav->url ?>"><?php echo $nav->title ?></a>
                </li>
            <?php endforeach; ?>
            <li>
                <a href="#" class="btn">
                    <span>Work With Us</span>
                    <svg class="arrow arrow-right" viewBox="0 0 32 14">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</header>