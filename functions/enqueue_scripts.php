<?php
// Enqueue CSS
add_action('wp_enqueue_scripts', 'enqueue_css');
function enqueue_css()
{
    wp_enqueue_style('main-css', get_template_directory_uri()."/compiled/main.css", null, VERSION, false);
}

// Enqueue JS
add_action('wp_enqueue_scripts', 'enqueue_js');
function enqueue_js()
{
    wp_enqueue_script('main-js', get_template_directory_uri()."/compiled/js/main.js", null, VERSION, true);

    $nonce = wp_create_nonce( 'wp_rest' );
    wp_localize_script('main-js', 'active_campaign_nonce', array('ac_nonce' => $nonce) );
}
?>