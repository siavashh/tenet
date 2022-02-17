<?php

/**
 * Tenet Theme Customizer
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('tenet_customize_register')) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function tenet_customize_register($wp_customize)
	{
		$wp_customize->get_setting('blogname')->transport         = 'postMessage';
		$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
		$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';


		// Google Analytics settings

		$wp_customize->add_setting(
			// $id
			'site_google_analytics_code',
			// $args
			array(
				'default' => 'G-xxxxxxxxxx',
				'type' => 'option', // you can also use 'theme_mod'
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				// $wp_customize object
				$wp_customize,
				// $id
				'site_google_analytics_code',
				// $args
				array(
					'settings'      => 'site_google_analytics_code',
					'section'       => 'title_tagline',
					'label'         => __('Google Analytics code', 'tenet'),
					'description'   => __('Put your Google Analytics code here.', 'tenet'),
					'type'          => 'text',
					'priority'      => 10,
				)
			)
		);

		require get_template_directory() . '/inc/theme-settings/layout-setting.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require get_template_directory() . '/inc/theme-settings/color-themes-setting.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}
add_action('customize_register', 'tenet_customize_register');

if (!function_exists('tenet_theme_customize_register')) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function tenet_theme_customize_register($wp_customize)
	{

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function tenet_theme_slug_sanitize_select($input, $setting)
		{

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key($input);

			// Get the list of possible select options.
			$choices = $setting->manager->get_control($setting->id)->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return (array_key_exists($input, $choices) ? $input : $setting->default);
		}

		$wp_customize->add_setting('themecheck_checkbox_setting_id', array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'tenet_sanitize_checkbox',
		));

		$wp_customize->add_control('tenet_checkbox_setting_id', array(
			'type' => 'checkbox',
			'section' => 'custom_section', // Add a default or your own section
			'label' => __('Custom Checkbox', 'tenet'),
			'description' => __('This is a custom checkbox input.', 'tenet'),
		));

		function tenet_sanitize_checkbox($checked)
		{
			// Boolean check.
			return ((isset($checked) && true == $checked) ? true : false);
		}
	}
} // End of if function_exists( 'tenet_theme_customize_register' ).
add_action('customize_register', 'tenet_theme_customize_register');
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if (!function_exists('tenet_customize_preview_js')) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function tenet_customize_preview_js()
	{
		wp_enqueue_script(
			'tenet_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array('customize-preview'),
			'20130508',
			true
		);
	}
}
add_action('customize_preview_init', 'tenet_customize_preview_js');

/*
** Customizer Styles
*/
function tenet_admin_style()
{
	wp_enqueue_style('tenet-admin-css', get_template_directory_uri() . '/css/admin-style.css', array(), '1.0.0');
}
add_action('customize_controls_enqueue_scripts', 'tenet_admin_style');



/**
 * Writes the custom colors 'head' element of the document
 * by reading the value(s) from the theme mod value in the options table.
 */
function tenet_customizer_css()
{
	$socialRadius = get_theme_mod('tenet_socials_settings_radius') . "px;";
	$primary = get_theme_mod('primary_color', 'default');
	if ($primary != 'default' && $primary != '') {
		$primary = "--tenet-primary-color:"  . get_theme_mod('primary_color') . ";";
		$primaryDarken = "--tenet-primary-darken:"  . tenetAdjustBrightness(get_theme_mod('primary_color'), -30) . ";";
	} else {
		$primary = '';
		$primaryDarken = '';
	}

	$secondary = get_theme_mod('secondary_color', 'default');
	if ($secondary != 'default' && $secondary != '') {
		$secondary = "--tenet-secondary-color:"  . get_theme_mod('secondary_color') . ";";
		$secondaryDarken = "--tenet-secondary-darken:"  . tenetAdjustBrightness(get_theme_mod('secondary_color'), -30) . ";";
	} else {
		$secondary = '';
		$secondaryDarken = '';
	}

	$bodyBg = 'background-color:' . esc_html(get_theme_mod('body_background_color')) . ';';
	$bodyC  = esc_html(get_theme_mod('body_font_color')) ? 'color:' . esc_html(get_theme_mod('body_font_color')) . ';' : '';
?>

	<style type="text/css">
		<?php
		if (!empty($bodyBg) || !empty($bodyC) || !empty($primary) || !empty($primaryDarken) || !empty($secondary) || !empty($secondaryDarken)) {
			printf(
				'
				body{%1$s%2$s%3$s%4$s%5$s%6$s}',
				esc_html($bodyBg),
				esc_html($bodyC),
				esc_html($primary),
				esc_html($primaryDarken),
				esc_html($secondary),
				esc_html($secondaryDarken)

			);
		}

		if (!empty($bodyFC = esc_html(get_theme_mod('body_font_color')))) {
			printf(
				'
				.footer-widget.widget_popular_post_widget ol li a h3,.widget.widget_popular_post_widget ol li a h3 {color:%s;}
				',
				esc_html($bodyFC)
			);
		}
		if (!empty($titleFC = esc_html(get_theme_mod('body_font_color')))) {
			printf(
				'
				h1,h2,h3,h4,h5,h6{color:%s;}
				',
				esc_html($titleFC)
			);
		}

		if (!empty($headerBC = esc_html(get_theme_mod('header_background_color')))) {
			printf(
				'
				.bg-header{background-color: %s;}

				',
				esc_html($headerBC)
			);
		}

		if (!empty($footerBC = esc_html(get_theme_mod('footer_background_color')))) {
			printf(
				'
				#wrapper-footer-full{background-color: %s;}

			',
				esc_html($footerBC)
			);
		}

		$socialBC = get_theme_mod('socials_background_color');
		$socialC = get_theme_mod('socials_font_color');
		if (!empty($socialBC) || !empty($socialC)) {
			$socialBC = !empty($socialBC) ? "background-color:" . $socialBC . ";" : '';
			$socialC = !empty($socialC) ? "color:" . $socialC . ";" : '';
			printf('
				.site-footer #socialNav .social-navbar-nav li a {%1$s%2$s}
				', esc_html($socialBC), esc_html($socialC));
		}

		if (!empty($socialRadius) && get_theme_mod('tenet_socials_settings_radius') != 25) {
			printf(
				'
				.site-footer .social-navbar-nav li a {
					border-radius: %s
				}

			',
				esc_html($socialRadius)
			);
		}

		?>
	</style>
<?php
} // end tenet_customizer_css

add_action('wp_head', 'tenet_customizer_css');

function tenetAdjustBrightness($hex, $steps)
{
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color   = hexdec($color); // Convert to decimal
		$color   = max(0, min(255, $color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}
