<?php

/*
 Template Name: About
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

</main>

<?php

get_footer();

?>