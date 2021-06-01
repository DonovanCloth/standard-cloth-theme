<?php

function clotheme_scripts()
{

    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        // wp_register_script(
        //     'slick',
        //     '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
        //     array('jquery'),
        //     '1.0.0',
        //     true
        // );
        // wp_enqueue_script('slick');

        // wp_register_script(
        //     'slick-config',
        //     get_template_directory_uri() . '/assets/js/slick-config.js',
        //     array('jquery'),
        //     '1.0.0',
        //     true
        // );
        // wp_enqueue_script('slick-config');

        wp_register_script(
            'mainscript',
            get_template_directory_uri() . '/assets/js/main.min.js',
            ['jquery'],
            time(),
            true
        );
        wp_enqueue_script('mainscript');
    }
}
