<?php

/**
 * The sidebar containing the main widget area
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!is_active_sidebar('left-sidebar')) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$tenet_sidebar_pos = get_theme_mod('tenet_sidebar_position');
if ('both' === $tenet_sidebar_pos && is_active_sidebar('right-sidebar') && is_active_sidebar('left-sidebar')) : ?>
	<div class="col-md-6 col-lg-3 col-xl-2 widget-area both-sides" id="left-sidebar" role="complementary">
	<?php elseif ('left' === $tenet_sidebar_pos && is_active_sidebar('left-sidebar')) : ?>
		<div class="col-md-12 col-lg-4 widget-area left-only" id="left-sidebar" role="complementary">
		<?php endif; ?>
		<!-- <span class="btn btn-toggle left-sidebar-toggle"><i class="fa fa-times"></i></span> -->
		<?php dynamic_sidebar('left-sidebar'); ?>

		</div><!-- #left-sidebar -->