<footer>

<section class="contact" id="footer-contact" style="background-color: <?php the_field("background_color", "option") ?>;">
    <h4 class="contact__title">CONTACT</h4>
    <?php if (have_rows("contact", "option")) : ?>
            <?php while (have_rows("contact", "option")) : the_row(); ?>
            <div class="contact__block"><?php the_sub_field("block") ?></div>
            <?php endwhile; ?>
        <?php endif; ?>

        <?php echo do_shortcode('[wpforms id="99" title="false"]')?>
</section>

<img class="logo-footer" src="<?php the_field("logo", "option") ?>" alt="logo">

</footer>

<?php wp_footer(); ?>
</body>

</html>