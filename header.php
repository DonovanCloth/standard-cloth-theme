<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
        <?php
        wp_title('');
        if (wp_title('', false)) {
            echo ' :';
        }
        ?>
        <?php bloginfo('name'); ?>
    </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php wp_head(); ?>

    <link rel="stylesheet" href="https://use.typekit.net/qhe3vbb.css">

</head>

<body <?php body_class(); ?>>


    <header>
        <div class="header-wrapper">

            <div class="logo-container">
                <a href="/" class="logo">
                    <h1 class="visually-hidden">Title here</h1>
                    <?php echo file_get_contents(get_template_directory_uri() . '/assets/img/svg/logo-full.svg') ?>
                </a>
            </div>
            <div>
                <nav class="nav" role="navigation">
                    <h2 class="visually-hidden">Navigation</h2>
                    <?php clotheme_nav();
                    ?>
                </nav>

                <div class="hamburger-btn"><span class="bar first-bar"></span><span class="bar second-bar"></span><span class="bar third-bar"></span></div>

                <div class="opacity-layer"></div>
            </div>

        </div>
    </header>