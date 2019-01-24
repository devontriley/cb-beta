<?php
add_action('wp_head', 'wordpress_ajaxurl');

function wordpress_ajaxurl() { ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
<?php } ?>