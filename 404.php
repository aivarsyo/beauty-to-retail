<?php

get_header();

?>

<main>

<section class="error-page">

<lottie-player
  autoplay
  loop
  mode="normal"
  src="<?php echo get_template_directory_uri().'/src/assets/images/404.json'; ?>"
>
</lottie-player>

<div class="error-page__text">
<p>We can't seem to find the page you're looking for.</p>
<p class="error-page__text__link">Visit the <a href="<?php echo home_url(); ?>">homepage</a></p>
</div>

</section>

</main>

<?php

get_footer();

?>