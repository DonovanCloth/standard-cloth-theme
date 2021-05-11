<?php

// Navigation

function register_cloth_menu()
{
    register_nav_menus([
        'header-menu' => __('Header Menu', 'clotheme'), // Main Navigation
        'lang-menu' => __('Language Menu', 'clotheme'), // Language Navigation
    ]);
}
add_action('init', 'register_cloth_menu');

// Create Navigation

function clotheme_nav()
{
    wp_nav_menu([
        'theme_location' => 'header-menu',
        'menu' => '',
        'container' => '',
        'container_class' => '',
        'container_id' => '',
        'menu_class' => 'nav',
        'menu_id' => '',
        'echo' => true,
        'fallback_cb' => 'wp_page_menu',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<ul class="nav-list">%3$s</ul>',
        'depth' => 0,
        'walker' => '',
    ]);
}

function clotheme_lang_nav()
{
    wp_nav_menu([
        'theme_location' => 'lang-menu',
        'menu' => '',
        'container' => '',
        'container_class' => '',
        'container_id' => '',
        'menu_class' => 'langnav-main',
        'menu_id' => '',
        'echo' => true,
        'fallback_cb' => 'wp_page_menu',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<ul class="lang-nav_list">%3$s</ul>',
        'depth' => 0,
        'walker' => '',
    ]);
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? [] : '';
}

add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
