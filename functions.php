<?php
/*
 *  Author: cloth. kreativbureau
 *  URL: cloth.be
 */

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

add_action('after_setup_theme', 'clotheme_setup');

function clotheme_setup()
{
    // Theme Support

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form']);

    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');

    add_image_size('large', 1600, '', true); // Large Thumbnail
    add_image_size('medium', 800, '', true); // Medium Thumbnail
    add_image_size('small', 400, '', true); // Small Thumbnail

    // Localisation Support
    load_theme_textdomain('clotheme', get_template_directory() . '/languages');
}

/*------------------------------------*\
	OpenGraph
\*------------------------------------*/

require_once get_template_directory() . '/includes/opengraph.php';

/*------------------------------------*\
	Navigation
\*------------------------------------*/

require_once get_template_directory() . '/includes/nav.php';

/*------------------------------------*\
	Styles & Scripts
\*------------------------------------*/

require_once get_template_directory() . '/includes/styles.php';
add_action('wp_enqueue_scripts', 'clotheme_styles'); // Add Theme Stylesheet

require_once get_template_directory() . '/includes/scripts.php';
add_action('init', 'clotheme_scripts'); // Add Scripts

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

require_once get_template_directory() . '/includes/cpt.php';
// add_action('init', 'create_post_type_clotheme'); // Add Custom Post Type


/*------------------------------------*\
	ACF
\*------------------------------------*/

require_once get_template_directory() . '/includes/acf.php';

add_action('wp_enqueue_scripts', 'load_dashicons_front_end');
function load_dashicons_front_end()
{
    wp_enqueue_style('dashicons');
}

/*------------------------------------*\
    Option Page
\*------------------------------------*/

// require_once get_template_directory() . '/includes/option.php';
// add_action('init', 'create_post_type_options'); // Add Option Page

if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

/*------------------------------------*\
	Helper Functions
\*------------------------------------*/

// Remove Emojis

add_filter('emoji_svg_url', '__return_false');
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, ['wpemoji']);
    } else {
        return [];
    }
}

// Remove Comments

require_once get_template_directory() . '/includes/comments.php';

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme

add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove invalid rel attribute values in the categorylist

add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Remove wp_head() injected Recent Comment styles

add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', [
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style',
    ]);
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin

add_action('init', 'clotheme_pagination'); // Add our Pagination
function clotheme_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links([
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
    ]);
}

// Custom Excerpts

// Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
function clotheme_index($length)
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function clotheme_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function clotheme_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Remove Admin bar

add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet

add_filter('style_loader_tag', 'clotheme_style_remove'); // Remove 'text/css' from enqueued stylesheet
function clotheme_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail

add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images
function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', '', $html);
    return $html;
}

add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)

//Remove Gutenberg Block Library CSS from loading on the frontend

add_action('wp_enqueue_scripts', 'clotheme_remove_wp_block_library_css', 100);
function clotheme_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
}

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
