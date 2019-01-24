<?php
add_action('after_setup_theme', 'remove_wordpress_defaults');

function remove_wordpress_defaults() {
    // Remove WP emoji styles
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );

    // Remove WP Generator link
    remove_action('wp_head', 'wp_generator');

    // Remove REST api
    remove_action( 'wp_head', 'rest_output_link_wp_head');
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0);

    // Remove EditURI/RSD link
    remove_action('wp_head', 'rsd_link');

    // Remove Windows Live Writer Link
    remove_action('wp_head', 'wlwmanifest_link');

    // Remove Shortlinks
    remove_action('wp_head', 'wp_shortlink_wp_head');
}

// remove default wysiwyg
add_action('admin_init', 'remove_default_editor');
function remove_default_editor() {
    $types = array('page');

    foreach($types as $type) {
        remove_post_type_support($type, 'editor');
    }
}

// Remove wp-embed.min.js
add_action( 'wp_footer', 'my_deregister_scripts' );
function my_deregister_scripts() {
    wp_deregister_script( 'wp-embed' );
}

// Remove appearance -> customize menu
add_action( 'admin_menu', 'remove_customize', 999 );
function remove_customize() {
    $customize_url_arr = array();
    $customize_url_arr[] = 'customize.php'; // 3.x
    $customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
    $customize_url_arr[] = $customize_url; // 4.0 & 4.1
    if ( current_theme_supports( 'custom-header' ) && current_user_can( 'customize') ) {
        $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'header_image', $customize_url ); // 4.1
        $customize_url_arr[] = 'custom-header'; // 4.0
    }
    if ( current_theme_supports( 'custom-background' ) && current_user_can( 'customize') ) {
        $customize_url_arr[] = add_query_arg( 'autofocus[control]', 'background_image', $customize_url ); // 4.1
        $customize_url_arr[] = 'custom-background'; // 4.0
    }
    foreach ( $customize_url_arr as $customize_url ) {
        remove_submenu_page( 'themes.php', $customize_url );
    }
}

// Remove appearance -> editor menu
add_action('admin_init', 'remove_theme_submenu', 100);
function remove_theme_submenu() {
    //remove_menu_page('themes.php');
    remove_submenu_page('themes.php', 'theme-editor.php');
}

// Disable support for comments and trackbacks in post types
add_action('admin_init', 'df_disable_comments_post_types_support');
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}

// Close comments on the front-end
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
function df_disable_comments_status() {
    return false;
}

// Hide existing comments
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}

// Remove comments page in menu
add_action('admin_menu', 'df_disable_comments_admin_menu');
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}

// Redirect any user trying to access comments page
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}

// Remove comments metabox from dashboard
add_action('admin_init', 'df_disable_comments_dashboard');
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}

// Remove comments links from admin bar
add_action('init', 'df_disable_comments_admin_bar');
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
?>