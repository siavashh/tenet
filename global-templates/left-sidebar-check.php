<?php

/**
 * Left sidebar check
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$tenet_sidebar_pos = get_theme_mod('tenet_sidebar_position');

if ('left' === $tenet_sidebar_pos && is_active_sidebar('left-sidebar')) {
	get_template_part('sidebar-templates/sidebar', 'left');
	echo '<div class="col-lg-8 content-area" id="primary">';
} elseif ('right' === $tenet_sidebar_pos && is_active_sidebar('right-sidebar')) {
	echo '<div class="col-lg-8 content-area" id="primary">';
} elseif ('none' === $tenet_sidebar_pos || !(is_active_sidebar('left-sidebar' &&  is_active_sidebar('right-sidebar')))) {
	echo '<div class="col-lg content-area" id="primary">';
} else { // Both sides
	echo '<div class="col-lg-6 col-md-12 content-area" id="primary">';
}
