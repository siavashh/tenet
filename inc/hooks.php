<?php

/**
 * Custom hooks
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('tenet_site_info')) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function tenet_site_info()
	{
		do_action('tenet_site_info');
	}
}

add_action('tenet_site_info', 'tenet_add_site_info');
if (!function_exists('tenet_add_site_info')) {
	/**
	 * Add site info content.
	 */
	function tenet_add_site_info()
	{
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s',
			esc_url(__('https://wordpress.org/', 'tenet')),
			sprintf(
				/* translators: WordPress */
				esc_html__('Proudly powered by %s', 'tenet'),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: 1: Theme name, 2: Theme author */
				esc_html__('With %1$s By %2$s.', 'tenet'),
				'<span class="fa fa-heart"></span>',
				'<a href="' . esc_url(__('https://tenet.ir', 'tenet')) . '">Siavash</a>'
			)
		);

		echo apply_filters('tenet_site_info_content', $site_info); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
