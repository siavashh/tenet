<?php

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

add_filter('body_class', 'tenet_body_classes');

if (!function_exists('tenet_body_classes')) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function tenet_body_classes($classes)
	{
		// Adds a class of group-blog to blogs with more than 1 published author.
		if (is_multi_author()) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if (!is_singular()) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}

if (function_exists('tenet_adjust_body_class')) {
	/*
	 * tenet_adjust_body_class() deprecated in v0.9.4. We keep adding the
	 * filter for child themes which use their own tenet_adjust_body_class.
	 */
	add_filter('body_class', 'tenet_adjust_body_class');
}

// Filter custom logo with correct classes.
add_filter('get_custom_logo', 'tenet_change_logo_class');

if (!function_exists('tenet_change_logo_class')) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return string
	 */
	function tenet_change_logo_class($html)
	{

		$html = str_replace('class="custom-logo"', 'class="img-fluid"', $html);
		$html = str_replace('class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html);
		$html = str_replace('alt=""', 'title="Home" alt="logo"', $html);

		return $html;
	}
}

if (!function_exists('tenet_post_nav')) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function tenet_post_nav()
	{
		// Don't print empty markup if there's nowhere to navigate.
		$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
		$next     = get_adjacent_post(false, '', false);

		if (!$next && !$previous) {
			return;
		}
?>
		<nav class="container navigation post-navigation">
			<h2 class="sr-only"><?php esc_html_e('Post navigation', 'tenet'); ?></h2>
			<div class="nav-links row">
				<?php
				$hasThumbClass = " has-thumbnail";
				if ($previous) {
					$prevThumbnail = "";
					if (has_post_thumbnail($previous->ID)) {
						$prevThumbnail = '<div class="entry-thumbnail">' . get_the_post_thumbnail($previous->ID, array(300, 100)) . '</div>';
					}
					previous_post_link('<article class="col-xl-6 col-lg-12 nav-previous' . $hasThumbClass . '">%link</article>', $prevThumbnail . _x('<header class="entry-header"><div class="entry-meta before-title"><span class="badge rounded-pill">Previous post</span></div><h3 class="entry-title"> %title</h3> </header>', 'Prev post link', 'tenet'));
				}
				if ($next) {
					$nextThumbnail = "";
					if (has_post_thumbnail($next->ID)) {
						$nextThumbnail = '<div class="entry-thumbnail">' . get_the_post_thumbnail($next->ID, array(300, 100)) . '</div>';
					} else {
						$hasThumbClass = " no-thumbnail";
					}
					next_post_link('<article class="col-xl-6 col-lg-12 nav-next' . $hasThumbClass . '">%link</article>', $nextThumbnail  . _x('<header class="entry-header"><div class="entry-meta before-title"><span class="badge rounded-pill">Next post</span></div><h3 class="entry-title"> %title</h3> </header>', 'Next post link', 'tenet'));
				}
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
	<?php
	}
}

if (!function_exists('tenet_pingback')) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function tenet_pingback()
	{
		if (is_singular() && pings_open()) {
			echo '<link rel="pingback" href="' . esc_url(get_bloginfo('pingback_url')) . '">' . "\n";
		}
	}
}
add_action('wp_head', 'tenet_pingback');

if (!function_exists('tenet_mobile_web_app_meta')) {
	/**
	 * Add mobile-web-app meta.
	 */
	function tenet_mobile_web_app_meta()
	{
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr(get_bloginfo('name')) . ' - ' . esc_attr(get_bloginfo('description')) . '">' . "\n";
	}
}
add_action('wp_head', 'tenet_mobile_web_app_meta');

if (!function_exists('tenet_default_body_attributes')) {
	/**
	 * Adds schema markup to the body element.
	 *
	 * @param array $atts An associative array of attributes.
	 * @return array
	 */
	function tenet_default_body_attributes($atts)
	{
		$atts['itemscope'] = '';
		$atts['itemtype']  = 'http://schema.org/WebSite';
		return $atts;
	}
}
add_filter('tenet_body_attributes', 'tenet_default_body_attributes');

// Escapes all occurances of 'the_archive_description'.
add_filter('get_the_archive_description', 'tenet_escape_the_archive_description');

if (!function_exists('tenet_escape_the_archive_description')) {
	/**
	 * Escapes the description for an author or post type archive.
	 *
	 * @param string $description Archive description.
	 * @return string Maybe escaped $description.
	 */
	function tenet_escape_the_archive_description($description)
	{
		if (is_author() || is_post_type_archive()) {
			return wp_kses_post($description);
		}

		/*
		 * All other descriptions are retrieved via term_description() which returns
		 * a sanitized description.
		 */
		return $description;
	}
} // End of if function_exists( 'tenet_escape_the_archive_description' ).

// Escapes all occurances of 'the_title()' and 'get_the_title()'.
add_filter('the_title', 'tenet_kses_title');

// Escapes all occurances of 'the_archive_title' and 'get_the_archive_title()'.
add_filter('get_the_archive_title', 'tenet_kses_title');

if (!function_exists('tenet_kses_title')) {
	/**
	 * Sanitizes data for allowed HTML tags for post title.
	 *
	 * @param string $data Post title to filter.
	 * @return string Filtered post title with allowed HTML tags and attributes intact.
	 */
	function tenet_kses_title($data)
	{
		// Tags not supported in HTML5 are not allowed.
		$allowed_tags = array(
			'abbr'             => array(),
			'aria-describedby' => true,
			'aria-details'     => true,
			'aria-label'       => true,
			'aria-labelledby'  => true,
			'aria-hidden'      => true,
			'b'                => array(),
			'bdo'              => array(
				'dir' => true,
			),
			'blockquote'       => array(
				'cite'     => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'cite'             => array(
				'dir'  => true,
				'lang' => true,
			),
			'dfn'              => array(),
			'em'               => array(),
			'i'                => array(
				'aria-describedby' => true,
				'aria-details'     => true,
				'aria-label'       => true,
				'aria-labelledby'  => true,
				'aria-hidden'      => true,
				'class'            => true,
			),
			'code'             => array(),
			'del'              => array(
				'datetime' => true,
			),
			'ins'              => array(
				'datetime' => true,
				'cite'     => true,
			),
			'kbd'              => array(),
			'mark'             => array(),
			'pre'              => array(
				'width' => true,
			),
			'q'                => array(
				'cite' => true,
			),
			's'                => array(),
			'samp'             => array(),
			'span'             => array(
				'dir'      => true,
				'align'    => true,
				'lang'     => true,
				'xml:lang' => true,
			),
			'small'            => array(),
			'strong'           => array(),
			'sub'              => array(),
			'sup'              => array(),
			'u'                => array(),
			'var'              => array(),
		);
		$allowed_tags = apply_filters('tenet_kses_title', $allowed_tags);

		return wp_kses($data, $allowed_tags);
	}
} // End of if function_exists( 'tenet_kses_title' ).


/**
 * Estimated Reading Time
 *
 * Use by adding it to a hook like add_action( 'genesis_after_entry', 'tenet_estimated_reading_time' );
 *
 * @link http://briancray.com/posts/estimated-reading-time-web-design/
 * @return void
 */
function tenet_estimated_reading_time($post)
{
	// count the number of words
	$words = str_word_count(strip_tags($post));
	// rounding off and deviding per 200 words per minute
	$m = floor($words / 200);
	// rounding off to get the seconds
	$s = floor($words % 200 / (200 / 60));
	if ($s > 30) {
		$m++;
	}
	if ($m == 0) {
		$m = 1;
	};
	// calculate the amount of time needed to read
	$estimate = $m . ' Min' . ($m == 1 ? '' : 's') . ' read';
	// create output
	$output = '<span class="estimated-time">' . $estimate . '</span>';
	// return the estimate
	return $output;
}


function tenet_single_header()
{
	?>
	<header class="entry-header">

		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
		<div class="entry-meta">
			<?php tenet_posted_on(); ?>
			<?php esc_html(tenet_estimated_reading_time(get_the_content())); ?>
		</div><!-- .entry-meta -->


	</header><!-- .entry-header -->
<?php
}

add_filter('get_search_form', 'tenet_search_form_text');
function tenet_search_form_text($text) {
     $text = str_replace('<input type="submit" class="search-submit" value="Search" />', '<button type="submit" id="searchsubmit" name="submit" class="search-inline-button"><i class=" fa fa-search fa-rotate-90"></i></button>', $text); //set as value the text you want
     return $text;
}