<?php
add_action('wp_ajax_nopriv_wp_query', 'wp_query');
add_action('wp_ajax_wp_query', 'wp_query');

function wp_query()
{
    $data = json_decode(file_get_contents('php://input'));
    $action = $data->action;
    $payload = $data->payload;

    // Have to recreate args array, tax_query wasn't working because of the nested array which doesn't seem to work by sending array with object inside
    $args = array(
        'post_type' => $payload->post_type,
        'orderby' => $payload->orderby,
        'order' => $payload->order
    );

    if($payload->tax_query[0]->terms)
    {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $payload->tax_query[0]->taxonomy,
                'field' => $payload->tax_query[0]->field,
                'terms' => $payload->tax_query[0]->terms
            )
        );
    }

    $query = new WP_Query($args);

    $posts = $query->posts;

    // Add additional data for specific requests
    if($payload->post_type == 'work')
    {
        foreach($posts as $p)
        {
            $image = $p->thumbnail;
            $imageID = wp_get_attachment_image_src($image, 'full');
            $terms = wp_get_post_terms($p->ID, 'work_categories');

            $p->client_name = $p->client_name;
            $p->thumbnail = $imageID[0];
            $p->permalink = get_permalink($p);
            $p->terms = $terms;
        }
    }

    echo json_encode($posts);

    wp_die();
}
?>