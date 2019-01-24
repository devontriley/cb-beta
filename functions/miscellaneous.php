<?php
// Use single template for multiple custom post types
//add_filter('template_include', function($template) {
//    $types = array('career', 'event', 'news');
//    $templateName = 'single.php';
//
//    if (is_singular($types)){
//        return get_stylesheet_directory() . '/' . $templateName;
//    } else {
//        return $template;
//    }
//});

// Remove <img> size attributes from embedded images
add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );
function remove_image_size_attributes($html) {
    return preg_replace( '/(width|height)="\d*"/', '', $html );
}

// Add SVG to mime types
add_filter('upload_mimes', 'cc_mime_types');
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
?>