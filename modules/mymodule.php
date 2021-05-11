<section id="hero" class="container-margin">
    <h2 class="visually-hidden">Seite Banner</h2>
    <?php

    if (get_field('header_image')) { ?>
        <img src="<?php echo get_field('header_image')['sizes']['large'] ?>" loading=“lazy” alt="Kopfbild">
    <?php } else { ?>
        <img src="<?php echo get_template_directory_uri() . "/assets/img/use/hero-home.jpg" ?>" loading=“lazy” alt="Kopfbild">
    <?php  } ?>


    <?php if (have_rows('optional_header_content')) : ?>
        <?php while (have_rows('optional_header_content')) : the_row(); ?>

            <?php if (get_sub_field('optional_header_title')) { ?>

                <div class="header-optional-content">
                    <p> <?php echo get_sub_field('optional_header_title'); ?></p>
                    <p> <?php echo get_sub_field('optional_header_author'); ?></p>
                </div>
            <?php } ?>
        <?php endwhile; ?>
    <?php endif; ?>
</section>