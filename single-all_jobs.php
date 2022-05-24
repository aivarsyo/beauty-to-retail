<?php

get_header();

?>

<main>

    <section class="jobs jobs-one" style="background-color: <?php the_field("background_color_job", "option") ?>;">

        <div class="one-job single-job" href="<?php echo get_permalink(); ?>">
            <p class="one-job__location"><?php the_field("location_category") ?></p>
            <h1 class="one-job__title"><?php echo esc_html(get_the_title()); ?></h1>

            <?php if (have_rows("job_description")) : ?>
                <?php while (have_rows("job_description")) : the_row(); ?>
                    <p class="single-job__subtitle"><?php the_sub_field("subtitle") ?></p>
                    <div class="single-job__info"><?php the_sub_field("description") ?></div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>

    </section>

</main>

<?php

get_footer();

?>