<?php

/*
 Template Name: Services
*/

get_header();

?>

<main>

<h1 class="top-title"><?php the_field("top_title_mixed") ?></h1>

<?php if (have_rows("one_service")) : ?>
    <section class="services">
        <?php while (have_rows("one_service")) : the_row(); ?>
<div class="single-service">
<img src="<?php the_sub_field("icon_image")?>" alt="Service icon">
<h2 class="single-service__name"><?php the_sub_field("service_title")?></h2>
<?php if (have_rows("service_points")) : ?>
<div class="service-points">
<?php while (have_rows("service_points")) : the_row(); ?>
<p class="service-point"><?php the_sub_field("service_point")?></p>
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