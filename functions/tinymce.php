<?php
function set_tinymce_buttons( $initArray ) {
    $initArray['theme_advanced_buttons1'] .= ',anchor';
    return $initArray;
}
add_filter('tiny_mce_before_init', 'set_tinymce_buttons');
?>