<?php

/*
 Template Name: About+Services
*/

get_header();

?>

<main>

    <section class="about-section">

        <div class="about-section__left">
            <h1 class="about-section__left__page"><?php echo get_the_title(); ?></h1>
            <h2 class="about-section__left__title"><?php the_field("top_title") ?></h2>
            <div class="about-section__left__des"><?php the_field("description") ?></div>
        </div>

        <div class="about-section__right">
        <style>
                .about-section__right img {
                    min-height: <?php the_field("image_size") ?>vh;
                }
            </style>
            <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full'); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/placeholder.jpeg" alt="placeholder" />
                    <?php endif; ?>
        </div>

    </section>

    <h1 class="top-title top-title-mixed"><?php the_field("top_title_mixed") ?></h1>

    <?php if (have_rows("one_service")) : ?>
        <section class="services" style="background-color: <?php the_field("background_color") ?>;">
            <?php while (have_rows("one_service")) : the_row(); ?>
                <div class="single-service">
                    <img src="<?php the_sub_field("icon_image") ?>" alt="Service icon">
                    <h2 class="single-service__name"><?php the_sub_field("service_title") ?></h2>
                    <?php if (have_rows("service_points")) : ?>
                        <div class="service-points">
                            <?php while (have_rows("service_points")) : the_row(); ?>
                                <p class="service-point"><?php the_sub_field("service_point") ?></p>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </section>
    <?php endif; ?>

    <img class="services-cover" src="<?php the_field("cover_photo") ?>" />

</main>

<?php

get_footer();

?>