<?php

/**
 * Check and setup theme's default settings
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('tenet_setup_theme_default_settings')) {
	/**
	 * Store default theme settings in database.
	 */
	function tenet_setup_theme_default_settings()
	{
		$defaults = tenet_get_theme_default_settings();
		$settings = get_theme_mods();
		foreach ($defaults as $setting_id => $default_value) {
			// Check if setting is set, if not set it to its default value.
			if (!isset($settings[$setting_id])) {
				set_theme_mod($setting_id, $default_value);
			}
		}
	}
}

if (!function_exists('tenet_get_theme_default_settings')) {
	/**
	 * Retrieve default theme settings.
	 *
	 * @return array
	 */
	function tenet_get_theme_default_settings()
	{
		$defaults = array(
			'tenet_posts_index_style' => 'default',   // Latest blog posts style.
			'tenet_sidebar_position'  => 'right',     // Sidebar position.
			'tenet_container_type'    => 'container', // Container width.
		);

		/**
		 * Filters the default theme settings.
		 *
		 * @param array $defaults Array of default theme settings.
		 */
		return apply_filters('tenet_theme_default_settings', $defaults);
	}
}

// This enables the function that lets you set new image sizes
add_theme_support('post-thumbnails');
// These are the new image sizes we cooked up
add_image_size('tenet_post-image', 600);
add_image_size('tenet_sidebar-image', 200);
// Now we register the size so it appears as an option within the editor
add_filter('image_size_names_choose', 'tenet_my_custom_image_sizes');
function tenet_my_custom_image_sizes($sizes)
{
	return array_merge($sizes, array(
		'post-image' => __('Post Images', 'tenet'),
	));
}
