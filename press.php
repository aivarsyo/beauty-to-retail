<?php

/*
 Template Name: Press
*/

get_header();

?>

<main>

    <section class="about-section">

        <div class="about-section__left">
            <p class="about-section__left__page"><?php echo get_the_title(); ?></p>
            <p class="about-section__left__title"><?php the_field("top_title") ?></p>
            <div class="about-section__left__des"><?php the_field("description") ?></div>
        </div>

        <div class="about-section__right">
            <?php the_post_thumbnail('full'); ?>
        </div>

    </section>

    <section class="press-slider">
        <?php if (have_rows("slider")) : ?>
            <?php while (have_rows("slider")) : the_row(); ?>
            <?php $image = get_sub_field('image'); ?>
                <a class="press-slider__wrapper" href="<?php the_sub_field("link") ?>" target="_blank">
                <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>


</main>

<?php

get_footer();

?>