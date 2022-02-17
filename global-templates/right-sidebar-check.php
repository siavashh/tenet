<?php

/**
 * Right sidebar check
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

</div><!-- #closing the primary container from /global-templates/left-sidebar-check.php -->

<?php
$tenet_sidebar_pos = get_theme_mod('tenet_sidebar_position');

if ('both' === $tenet_sidebar_pos) {
	get_template_part('sidebar-templates/sidebar', 'left');
	get_template_part('sidebar-templates/sidebar', 'right');
} else if ('right' === $tenet_sidebar_pos) {
	get_template_part('sidebar-templates/sidebar', 'right');
}
