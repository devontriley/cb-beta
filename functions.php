<?php
define("VERSION", "1.0");

// Remove Default WP Actions
require_once(__DIR__ . '/functions/remove_wordpress_defaults.php');

// Enqueue CSS/JS
require_once(__DIR__ . '/functions/enqueue_scripts.php');

// Active Campaign AJAX Request
require_once(__DIR__ . '/functions/active_campaign_api.php');

// Custom Image Sizes
require_once(__DIR__ . '/functions/custom_image_sizes.php');

// Register menus
require_once(__DIR__ . '/functions/register_menus.php');

// Register Custom Post Types
require_once(__DIR__ . '/functions/custom_post_types.php');

// Register Ajax variable
require_once(__DIR__ . '/functions/ajax_variable.php');

// Color periods red
require_once(__DIR__ . '/functions/filter-content.php');

// TinyMCE
require_once(__DIR__ . '/functions/tinymce.php');

// Ajax load more posts
require_once(__DIR__ . '/functions/ajax_load_more.php');

// Custom component functions
require_once(__DIR__ . '/functions/components.php');

// Advanced Custom Fields
require_once(__DIR__ . '/functions/acf.php');

// Custom TinyMCE buttons
require_once(__DIR__ . '/functions/custom_tinymce_buttons.php');

// Miscellaneous tweaks
require_once(__DIR__ . '/functions/miscellaneous.php');
