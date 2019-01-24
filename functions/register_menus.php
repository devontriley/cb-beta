<?php
add_action( 'after_setup_theme', 'register_main_nav' );
function register_main_nav() {
    register_nav_menu( 'main-nav', __('Main Nav') );
}
?>