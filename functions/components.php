<?php
function button($buttonLabel, $buttonUrl) {
    $html =     '<div class="btn-wrapper">';
    $html .=    '<a class="btn" href="'. $buttonUrl .'">';
    $html .=    '<span>';
    $html .=    $buttonLabel;
    $html .=    '</span>';
    $html .=    '</a><!-- .btn -->';
    $html .=    '</div><!-- .btn-wrapper -->';
    echo $html;
}
?>