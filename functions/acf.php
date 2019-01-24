<?php
// Remove empty p tags from ACF wysiwyg
add_filter( 'acf/load_value/type=wysiwyg', 'remove_shortcode_p', 10, 3 );

function remove_shortcode_p( $value, $post_id, $field ) {
    $content = apply_filters('the_content',$value);
    $patt = '/<p>&nbsp;<\/p>/';
    $content = preg_replace( $patt, '', $content );
    return $content;
}
?>