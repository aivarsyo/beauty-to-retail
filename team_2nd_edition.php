<?php

/*
 Template Name: Team 2nd Edition
*/

get_header();

?>

<main>

    <section class="about-section">

        <div class="about-section__left team-left">
            <h1 class="about-section__left__page"><?php echo get_the_title(); ?></h1>
            <h2 class="about-section__left__title"><?php the_field("top_title") ?></h2>
            <div class="about-section__left__des"><?php the_field("description") ?></div>
        </div>

        <div class="about-section__right team-right">
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

        <div class="team-members">
            <h3 class="team-members__title"><?php the_field("team_title") ?></h3>
            <div class="team-members__people">
                <?php if (have_rows("members")) : ?>
                    <?php while (have_rows("members")) : the_row(); ?>
                        <div class="team-members__people__one">
                            <p class="team-members__people__one__name"><?php the_sub_field("name") ?></p>
                            <p><?php the_sub_field("position") ?></p>
                            <a href="mailto: <?php the_sub_field("e-mail") ?>"><?php the_sub_field("e-mail") ?></a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

    </section>

</main>

<?php

get_footer();

?>