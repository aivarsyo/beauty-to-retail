<!-- Mājaslapu veidoja digitālā aģentūra "Rounda" - rounda.dk -->

<!DOCTYPE html>
<html lang="en">

<head>
    <?php wp_head(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0"/>
    <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/src/assets/images/og-image.png">
    <meta charset="UTF-8">
</head>

<body>

    <header>

 <a class="logo-wrapper" href="<?php echo home_url(); ?>">
<img src="<?php the_field("logo", "option") ?>" alt="logo">
</a>

<div class="burger">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 22.4 12.7" width="100%" height="100%" style="enable-background:new 0 0 22.4 12.7;" xml:space="preserve">
            <style type="text/css">
                .st0 {
                    fill: none;
                    stroke: #343434;
                    stroke-width: 1;
                    stroke-miterlimit: 10;
                }
            </style>
            <line class="st0 topLine" x1="0" y1="0.4" x2="22.4" y2="0.4" />
            <line class="st0 middleLine" x1="0" y1="6.7" x2="22.4" y2="6.7" />
            <line class="st0 bottomLine" x1="0" y1="12.4" x2="22.4" y2="12.4" />
        </svg>
</div>


    <?php
        wp_nav_menu(array(
            'theme_location' => 'my-custom-menu',
            'container_class' => 'menu-wrapper'
        ));
        ?>

    </header>

    <div class="transparent-cover"></div>