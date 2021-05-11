<?php

function clotheme_scripts() {

    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        // create swiper config.js if needed
        // wp_register_script(
        //     'swiperjs',
        //     'https://unpkg.com/swiper/swiper-bundle.min.js',
        //     [],
        //     '1.0.0',
        //     true
        // );
        // wp_enqueue_script('swiperjs');

        // wp_register_script(
        //     'swiper-config',
        //     get_template_directory_uri() . '/assets/js/swiper-config.js',
        //     [],
        //     '1.0.0',
        //     true
        // );
        // wp_enqueue_script('swiper-config');

        wp_register_script(
            'mainscript',
            get_template_directory_uri() . '/assets/js/main.min.js',
            ['jquery'],
            '1.0.0',
            true
        );
        wp_enqueue_script('mainscript');
    }


}
