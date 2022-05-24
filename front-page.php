<?php

/*
 Template Name: Home
*/

get_header();

?>

<main>

    <h1 class="top-title home-title"><?php the_field("top_title") ?></h1>

    <section class="slider">
        <?php if (have_rows("slider")) : ?>
            <?php while (have_rows("slider")) : the_row(); ?>
                <div class="slide-wrapper">
                    <?php if (get_row_layout() == 'image') :
                        $image = get_sub_field('image'); ?>
                        <?php echo wp_get_attachment_image($image['ID'], 'full'); ?>
                    <?php elseif (get_row_layout() == 'video') : ?>
                        <?php the_sub_field("video") ?>
                        <div class="slide-wrapper__grippy"></div>
                        <div class="slide-wrapper__grippy"></div>
                    <?php else : ?>
                        <!-- nothing -->
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>

    <section class="ticker" style="background-color: <?php the_field("background_color") ?>;">
        <?php if (have_rows("logos_slider")) : ?>
            <?php while (have_rows("logos_slider")) : the_row(); ?>
            <?php $image = get_sub_field('image'); ?>
                <a class="logo-slide-wrapper" href="<?php the_sub_field("link") ?>" target="_blank">
                <?php echo wp_get_attachment_image($image['ID'], 'full', "", [ "class" => "logo-slide-wrapper__img" ]); ?>
                </a>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>

    <section class="brand-section">
        <?php if (have_rows("brand_section")) : ?>
            <?php while (have_rows("brand_section")) : the_row(); ?>
                <h2 class="brand-title"><?php the_sub_field("title") ?></h2>
                <?php if (have_rows("services")) : ?>
                    <?php while (have_rows("services")) : the_row(); ?>
                        <div class="one-service">
                            <h3 class="one-service__title"><?php the_sub_field("service_title") ?></h3>
                            <p class="one-service__desc"><?php the_sub_field("service_description") ?></p>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>

    </section>
</main>

<?php

get_footer("contact");

?>