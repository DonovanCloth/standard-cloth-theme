<?php

    function clotheme_styles() {
        wp_register_style('mainstyle', get_template_directory_uri() . '/assets/css/main.css', [], '1.0', 'all' );
        wp_enqueue_style('mainstyle');

        // activate if needed
        // wp_register_style('swipercss', 'https://unpkg.com/swiper/swiper-bundle.min.css', [], '1.0', 'all');
        // wp_enqueue_style('swipercss');
    }
