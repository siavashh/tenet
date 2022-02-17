<?php

/**
 * Tenet functions and definitions
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Tenet's includes directory.
$tenet_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$tenet_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/theme-settings/radio-image-control.php',
	'/theme-settings/range-slider-control.php',
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/bootstrap_5_wp_nav_menu_walker.php',  // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/tenet/tenet/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if (class_exists('WooCommerce')) {
	$tenet_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if (class_exists('Jetpack')) {
	$tenet_includes[] = '/jetpack.php';
}

// Include files.
foreach ($tenet_includes as $tenet_file) {
	require_once $tenet_inc_dir . $tenet_file;
}


function tenet_legit_block_editor_styles()
{
	wp_enqueue_style('legit-editor-styles', get_theme_file_uri('/style-editor.css'), false, '2.3', 'all');
}
add_action('enqueue_block_editor_assets', 'tenet_legit_block_editor_styles');

add_filter('post_class', 'tenet_gwad_sticky_classes', 10, 3);
function tenet_gwad_sticky_classes($classes, $class, $post_id)
{

	// Bail if this is not a sticky post.
	if (!is_sticky()) {
		return $classes;
	}

	global $wp_query;
	$classes[] = 'sticky sticky-' . $post_id;

	return $classes;
}
