<?php

function getStyle()
{
    wp_enqueue_script('main-js', get_theme_file_uri('./dist/js/main.1.0.0.js'), NULL, '1.0', true);
    wp_enqueue_style('theme_main_styles', get_stylesheet_uri('./style.css'));
    wp_enqueue_style('avenir_book', get_stylesheet_directory_uri() . '/fonts/avenir-book.css');
    wp_enqueue_style('avenir_light', get_stylesheet_directory_uri() . '/fonts/avenir-light.css');
    wp_enqueue_style('avenir_medium', get_stylesheet_directory_uri() . '/fonts/avenir-medium.css');
    wp_enqueue_style('freight_big_book', get_stylesheet_directory_uri() . '/fonts/freight-big-book-pro-regular.css');

    if (is_404()) {
        wp_enqueue_script('error-js', get_theme_file_uri('./dist/js/404.1.0.0.js'), NULL, '1.0', true);
    }
}

add_action('wp_enqueue_scripts', 'getStyle');

function features()
{
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'features');

function comicpress_copyright()
{
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
    SELECT
    YEAR(min(post_date_gmt)) AS firstdate,
    YEAR(max(post_date_gmt)) AS lastdate
    FROM
    $wpdb->posts
    WHERE
    post_status = 'publish'
    ");
    $output = '';
    if ($copyright_dates) {
        $copyright = "&copy; " . $copyright_dates[0]->firstdate;
        if ($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= '-' . $copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }
    return $output;
}

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'     => 'Extra settings',
        'menu_title'    => 'Extra settings',
        'menu_slug'     => 'beauty-to-retail-general-settings',
        'capability'    => 'edit_posts',
        'redirect'        => false
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Header',
        'menu_title'    => 'Header',
        'parent_slug'    => 'beauty-to-retail-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Footer',
        'menu_title'    => 'Footer',
        'parent_slug'    => 'beauty-to-retail-general-settings',
    ));
}

// create menu

function wpb_custom_new_menu()
{
    register_nav_menu('my-custom-menu', __('My Custom Menu'));
}
add_action('init', 'wpb_custom_new_menu');


// exclude drafts and private pages from menu

function exclude_draft_nav_items($items, $menu, $args)
{
    global $wpdb;

    //add your custom posttypes to this array
    $allowed_posttypes = array('post', 'page');

    $sql = "SELECT ID FROM {$wpdb->prefix}posts WHERE (post_status!='publish') AND ID=%d && post_type=%s";

    foreach ($items as $k => $item) {
        if (in_array($item->object, $allowed_posttypes)) {
            $query = $wpdb->prepare($sql, $item->object_id, $item->object);
            $result = $wpdb->get_var($query);

            if ($result) unset($items[$k]);
        }
    }

    return $items;
}

add_filter('wp_get_nav_menu_items', 'exclude_draft_nav_items', 10, 3);

// enables featured image on posts

add_theme_support('post-thumbnails');


// filter categories when custom post is viewed in admin panel

add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy()
{
    global $typenow;

    $args = array(
        'public'   => true,
        '_builtin' => false,
    );

    $output = 'names';
    $operator = 'and';

    $post_types = get_post_types($args, $output, $operator);


    foreach ($post_types  as $post_type) {

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $item) {
            $taxonomy = $item->name;
        }
        if ($typenow == $post_type) {
            $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
            $info_taxonomy = get_taxonomy($taxonomy);
            wp_dropdown_categories(array(
                'show_option_all' => sprintf(__('Show all %s', 'textdomain'), $info_taxonomy->label),
                'taxonomy'        => $taxonomy,
                'name'            => $taxonomy,
                'orderby'         => 'name',
                'selected'        => $selected,
                'show_count'      => true,
                'hide_empty'      => false,
            ));
        };
    }
}

// when the filtered category is applied, it fetches all the posts
// relevant to that category

add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query)
{
    global $pagenow;

    $args = array(
        'public'   => true,
        '_builtin' => false,
    );

    $output = 'names';
    $operator = 'and';

    $post_types = get_post_types($args, $output, $operator);


    foreach ($post_types  as $post_type) {

        $taxonomies = get_object_taxonomies($post_type, 'objects');

        foreach ($taxonomies as $item) {
            $taxonomy = $item->name;
        }

        $q_vars    = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
            $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
            $q_vars[$taxonomy] = $term->slug;
        }
    }
}
