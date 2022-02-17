<?php

/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$bodyClasses = !is_front_page() ? "interior " : "";

$container = get_theme_mod('tenet_container_type');
$boxed = get_theme_mod('tenet_box_type', 'boxed-body') . ' ';
$bordertype = get_theme_mod('tenet_border_type', 'border-type-circle') . ' ';
$colorpalette = get_theme_mod('tenet_color_palette') . '';
$sticky = get_theme_mod('tenet_sticky_navbar');
if ($sticky == true) {
    $navbarClass = "fixed-top";
} else {
    $navbarClass = "";
}

$bodyClasses .= $boxed  . $bordertype . $colorpalette;
//TODO: NAVBAR customizer settings
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>


<body <?php body_class($bodyClasses); ?> <?php tenet_body_attributes(); ?>>
    <div class="body-cover"></div>
    
    <?php do_action('wp_body_open'); ?>
    <div class="site" id="page">

        <!-- ******************* The Navbar Area ******************* -->
        <div id="wrapper-navbar" class="bg-header">
            <div class="container-lg">
                <a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e('Skip to content', 'tenet'); ?></a>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 site-logo-col">
                    </div>
                </div>


                <nav id="main-nav" class="navbar navbar-light navbar-expand-lg <?php echo $navbarClass; ?>">

                    <h2 id="main-nav-label" class="sr-only">
                        <?php esc_html_e('Main Navigation', 'tenet'); ?>
                    </h2>

                    <?php if ('container' === $container) : ?>
                        <div class="container">
                        <?php endif; ?>


                        <button class="navbar-toggler btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'tenet'); ?>">
                            <i class="fa fa-bars"></i>
                        </button>

                        <?php if (!has_custom_logo()) { ?>

                            <?php if (is_front_page() && is_home()) : ?>

                                <h1 class="navbar-brand"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h1>

                            <?php else : ?>

                                <a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>

                            <?php endif; ?>

                        <?php
                        } else {
                            $tenet_custom_logo_id = get_theme_mod('custom_logo');
                            $tenet_logo_image = wp_get_attachment_image_src($tenet_custom_logo_id, 'full');

                        ?>
                            <a class="site-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url">
                                <img src="<?php echo esc_url($tenet_logo_image[0]) ?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>" width="100" />
                            </a>
                            <!-- Your site title as branding in the menu -->
                        <?php
                        }
                        ?>


                        <button class="btn btn-toggle navbar-close"><i class="fa fa-times"></i></button>
                        <!-- The WordPress Menu goes here -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'primary',
                                'container' => false,
                                'menu_class' => '',
                                'fallback_cb' => '__return_false',
                                'items_wrap' => '<ul id="%1$s" class="collapse navbar-collapse navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                                'depth' => 2,
                                'walker' => new tenet_bootstrap_5_wp_nav_menu_walker()
                            )
                        );
                        ?>
                        <ul class="navbar-nav search-nav">
                            <li class="nav-item">
                                <button type="button" class="nav-link search-toggle fa-rotate-90 search-toggle-button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </li>

                        </ul>
                        <?php if ('container' === $container) : ?>
                        </div><!-- .container -->
                    <?php endif; ?>

                </nav><!-- .site-navigation -->

            </div><!-- #wrapper-navbar end -->
        </div>
        <div class="big-search">
            <button class="btn btn-toggle search-toggle">
                <i class="fa fa-times"></i>
            </button>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-12">
                        <div class="search-title">
                            <h2><?php esc_html_e('Type and hit Enter to search', 'tenet') ?></h2>
                            <h4><?php esc_html_e('Press ESC to close', 'tenet') ?></h4>
                        </div>
                        <div class="search-form-wrap search-form-full">
                            <?php get_template_part('searchform', 'fullpage') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>