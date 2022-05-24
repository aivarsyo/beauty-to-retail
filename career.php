<?php

/*
 Template Name: Career
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

    <?php
    // getting brands posts
    $args = array(
        'post_type' => 'all_jobs',
        'orderby'    => 'ID',
        'post_status' => 'publish',
        'order'    => 'DESC',
        'posts_per_page' => -1 // this will retrive all the post that is published 
    );
    $result = new WP_Query($args);
    ?>

    <section class="jobs" style="background-color: <?php the_field("background_color") ?>;">
        <?php if ($result->have_posts()) : ?>

            <?php while ($result->have_posts()) : $result->the_post(); ?>

                <a class="one-job" href="<?php echo get_permalink(); ?>">
                    <p class="one-job__location"><?php the_field("location_category") ?></p>
                    <h3 class="one-job__title"><?php echo esc_html(get_the_title()); ?></h3>
                    <p class="one-job__preview"><?php the_field("preview") ?></p>
                    <div class="one-job__more">
                        <p>Read more</p>
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 31.49 31.49" style="enable-background:new 0 0 31.49 31.49;" xml:space="preserve">
                            <path style="fill:#1E201D;" d="M21.205,5.007c-0.429-0.444-1.143-0.444-1.587,0c-0.429,0.429-0.429,1.143,0,1.571l8.047,8.047H1.111
	C0.492,14.626,0,15.118,0,15.737c0,0.619,0.492,1.127,1.111,1.127h26.554l-8.047,8.032c-0.429,0.444-0.429,1.159,0,1.587
	c0.444,0.444,1.159,0.444,1.587,0l9.952-9.952c0.444-0.429,0.444-1.143,0-1.571L21.205,5.007z" />
                        </svg>
                    </div>
                </a>


            <?php endwhile; ?>
        <?php else : ?>
            <div class="no-jobs">
                <p><?php the_field("no_jobs") ?></p>
            </div>
        <?php endif;
        wp_reset_postdata(); ?>
    </section>

</main>

<?php

get_footer();

?>