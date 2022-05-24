<?php

/*
 Template Name: Isotope
*/

get_header();

$slug = get_post_field('post_name', get_post());
?>

<main>

    <?php if (have_rows("top_description")) : ?>
        <?php while (have_rows("top_description")) : the_row(); ?>

            <h1 class="top-title top-title-iso"><?php the_sub_field("big_title") ?></h1>
            <?php
            $sub_title = get_sub_field("sub_title");
            if ($sub_title) : ?>
                <h2 class="sub-title"><?php the_sub_field("sub_title") ?></h2>
            <?php endif; ?>

        <?php endwhile; ?>
    <?php endif; ?>

    <?php
    $orderby = 'name';
    $order = 'asc';
    $hide_empty = true;
    $cat_args = array(
        'hide_empty' => $hide_empty,
    );
    $post_categories = get_terms('' . $slug . '_categories', $cat_args);
    ?>

    <?php if (!empty($post_categories)) : ?>
        <section class="filters-wrapper">
            <!-- this part only shows up from 1024px and lower -->
            <div class="filters-section-modified">
                <div class="filters-section-modified__button-wrapper">
                    <div class="catButton">
                        <svg version="1.1" id="CatButton" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 211 211" style="enable-background:new 0 0 211 211;" xml:space="preserve">
                            <style type="text/css">
                                .st0 {
                                    fill: #FFFFFF;
                                }

                                .st1 {
                                    fill: #505056;
                                }

                                .st2 {
                                    fill: none;
                                    stroke: #505056;
                                    stroke-width: 7;
                                    stroke-miterlimit: 10;
                                }
                            </style>
                            <g>
                                <circle class="st0" cx="106" cy="105" r="99.5" />
                                <path class="st1" d="M106,9c52.93,0,96,43.07,96,96s-43.07,96-96,96s-96-43.07-96-96S53.07,9,106,9 M106,2C49.11,2,3,48.11,3,105
		s46.11,103,103,103s103-46.11,103-103S162.89,2,106,2L106,2z" />
                            </g>
                            <g id="CatOpen">
                                <g>
                                    <line class="st2" x1="33" y1="89" x2="179" y2="89" />
                                </g>
                                <line class="st2" x1="46.5" y1="122" x2="165.5" y2="122" />
                            </g>
                            <g id="CatClose">
                                <line class="st2" x1="62.88" y1="145.67" x2="152.96" y2="55.12" />
                                <line class="st2" x1="62.12" y1="55.09" x2="153.72" y2="145.7" />
                            </g>
                        </svg>
                    </div>
                    <p>CATEGORIES</p>
                </div>
                <div class="search-wrapper filters-section-modified__search">
                    <input type="text" class="quicksearch search1" placeholder="Search" />
                </div>
                <!-- ------------------------------------------- -->
            </div>
            <div id="filters" class="button-group">
                <button class="filter-btn is-checked" data-filter="*">Show all</button>
                <?php foreach ($post_categories as $key => $category) : ?>
                    <button class="filter-btn" data-filter=".<?php echo $category->slug ?>"><?php echo $category->name ?></button>
                <?php endforeach; ?>
                <div class="search-wrapper">
                    <input type="text" class="quicksearch search2" placeholder="Search" />
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- <div class="search-wrapper">
        <input type="text" id="quicksearch" placeholder="Search"/>
    </div> -->

    <?php
    // getting brands posts
    $args = array(
        'post_type' => 'all_' . $slug . '',
        'orderby'    => 'ID',
        'post_status' => 'publish',
        'order'    => 'DESC',
        'posts_per_page' => -1 // this will retrive all the post that is published 
    );
    $result = new WP_Query($args);
    ?>

    <?php if ($result->have_posts()) : ?>
        <div class="isotope-grid">
            <div class="gutter-sizer"></div>
            <?php while ($result->have_posts()) : $result->the_post(); ?>

                <?php
                // filters out the categories what each brand has
                $cats = array();
                foreach (get_the_terms($post->ID, '' . $slug . '_categories') as $c) {
                    $cat = get_category($c);
                    array_push($cats, $cat->slug);
                }

                if (sizeOf($cats) > 0) {
                    $post_categories = implode(' ', $cats);
                } else {
                    $post_categories = 'Not Assigned';
                }

                ?>

                <a href="<?php the_field("link") ?>" target="_blank" class="one-isotope-item <?php echo $post_categories ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('full'); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/src/assets/images/placeholder.jpeg" alt="placeholder" />
                    <?php endif; ?>
                    <h3 class="one-isotope-item__title"><?php the_title(); ?></h3>
                    <div class="overlay"></div>
                </a>


            <?php endwhile; ?>
        </div>
    <?php endif;
    wp_reset_postdata(); ?>



</main>




<?php

get_footer();

?>