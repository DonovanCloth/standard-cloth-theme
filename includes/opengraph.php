<?php

//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype($output) {
    return $output .
        ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

add_action('wp_head', 'clotheme_load_open_graph');

function clotheme_load_open_graph() {
    global $post;

    // Default
    $clotheme_site_logo =
        get_stylesheet_directory_uri() . '/assets/img/logo-open-graph.png';

    // If Home
    if (is_front_page()) {
        echo '<meta property="og:type" content="website" />';
        echo '<meta property="og:url" content="' . get_bloginfo('url') . '" />';
        echo '<meta property="og:title" content="' .
            esc_attr(get_bloginfo('name')) .
            '" />';
        echo '<meta property="og:image" content="' .
            $clotheme_site_logo .
            '" />';
        echo '<meta property="og:description" content="' .
            esc_attr(get_bloginfo('description')) .
            '" />';
    }

    // If Single
    elseif (is_singular()) {
        echo '<meta property="og:type" content="article" />';
        echo '<meta property="og:url" content="' . get_permalink() . '" />';
        echo '<meta property="og:title" content="' .
            esc_attr(get_the_title()) .
            '" />';
        if (has_post_thumbnail($post->ID)) {
            $clotheme_thumbnail = wp_get_attachment_image_src(
                get_post_thumbnail_id($post->ID),
                'large'
            );
            echo '<meta property="og:image" content="' .
                esc_attr($clotheme_thumbnail[0]) .
                '" />';
        } else {
            echo '<meta property="og:image" content="' .
                $clotheme_site_logo .
                '" />';
        }
        echo '<meta property="og:description" content="' .
            esc_attr(get_the_excerpt()) .
            '" />';
    }
}

?>
