<?php

/**
 * The template for displaying all single posts
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container = get_theme_mod('tenet_container_type');
// $sidebar_pos = get_theme_mod('tenet_sidebar_position');
// if ($sidebar_pos != 'none') {
//     if (
//         ($sidebar_pos == 'right' && is_active_sidebar('right-sidebar')) or
//         ($sidebar_pos == 'left' && is_active_sidebar('left-sidebar'))
//     ) {
//         $content_class = "col-md-8";
//     } else if ($sidebar_pos == 'both') {
//         if (is_active_sidebar('left-sidebar') xor is_active_sidebar('right-sidebar')) {
//             $content_class = 'col-md-8';
//         } elseif (is_active_sidebar('left-sidebar') && is_active_sidebar('right-sidebar')) {
//             $content_class = 'col-md-8 col-lg-6';
//         } else {
//             $content_class = 'col-md-12';
//         }
//     } else {
//         $content_class = 'col-md-12';
//     }
// } else {
//     $content_class = 'col-md-12';
// }

?>

<div class="wrapper" id="single-wrapper">
    <div class="container">
        <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

            <div class="row">
                <!-- Do the left sidebar check -->
                <?php get_template_part('global-templates/left-sidebar-check');
                ?>

                <main class="site-main single-mode" id="main">

                    <?php
                    while (have_posts()) {
                        the_post();
                        get_template_part('loop-templates/content', 'single');
                        tenet_post_nav();

                        // If comments are open or we have at least one comment, load up the comment template.
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                    }
                    ?>

                </main><!-- #main -->


                <!-- Do the right sidebar check -->
                <?php get_template_part('global-templates/right-sidebar-check'); ?>

            </div><!-- .row -->
        </div>

    </div><!-- #single-wrapper -->

    <?php
    get_footer();
