<?php

/*
 Template Name: Team
*/

get_header();
?>

<main>

    <?php if (have_rows("top_description")) : ?>
        <?php while (have_rows("top_description")) : the_row(); ?>

            <h1 class="top-title"><?php the_sub_field("big_title") ?></h1>
            <?php 
            $sub_title = get_sub_field("sub_title");
            if($sub_title) : ?>
            <h2 class="sub-title"><?php the_sub_field("sub_title")?></h2>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>

<section class="team">
<?php if (have_rows("people")) : ?>
        <?php while (have_rows("people")) : the_row(); ?>
        <?php $image = get_sub_field('image'); ?>
        <div class="one-person">
        <?php echo wp_get_attachment_image($image['ID'], 'full', "", [ "class" => "one-person__image" ]); ?>
        <h4 class="one-person__name"><?php the_sub_field("name")?></h4>
        <p class="one-person__position"><?php the_sub_field("position")?></p>
        <a class="one-person__link" href="<?php the_sub_field("link")?>" target="_blank" title="<?php the_sub_field("link")?>"><?php the_field("name_links")?></a>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>

</main>




<?php

get_footer();

?>