<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!function_exists('tenet_posted_on')) {
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function tenet_posted_on($short = false)
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}
		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date('c')),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date('c')),
			esc_html(get_the_modified_date())
		);
		$posted_on   = apply_filters(
			'tenet_posted_on',
			sprintf(
				'<span class="posted-on">%s</span>',
				apply_filters('tenet_posted_on_time', $time_string)
			)
		);
		$byline      = apply_filters(
			'tenet_posted_by',
			sprintf(
				__('<span class="byline"><span class="mini-thumbnail">%1$s</span>by <span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span></span>', 'tenet'),
				get_avatar(get_the_author_meta('ID'), $size = 30),
				esc_url(get_author_posts_url(get_the_author_meta('ID'))),
				esc_html(get_the_author())
			)
		);
		if ($short) {
			echo $posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			echo  $byline . $posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

if (!function_exists('tenet_single_thumbnail')) {
	/**
	 * Prints the post thumbnail HTML if exists, if not
	 */
	function tenet_single_thumbnail($post)
	{
		if (has_post_thumbnail()) {
			// $categories_list = get_the_category_list(' ');

			$i = 0;
			$categories_list = '';
			foreach ((get_the_category()) as $cat) {
				$categories_list .= '<a href="' . get_category_link($cat->cat_ID) . '"> ' . $cat->cat_name . '</a>' . ' ';
				if (++$i == 5) break;
			}


			if ($categories_list && tenet_categorized_blog()) {
				printf('<div class="single-thumbnail">' . get_the_post_thumbnail($post->ID, 'full') . '<span class="cat-links">%s</span>' . '</div>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
}
if (!function_exists('tenet_entry_footer')) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function tenet_entry_footer($short = false, $nolink = false)
	{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$cats = '';
			/* translators: %s: Categories of current post */
			// if (!$short) {
			// 	$cats = get_the_category_list(esc_html__(', ', 'tenet'));
			// 	if ($cats && tenet_categorized_blog()) {
			// 		printf('<span class="cat-links">' . $cats . '</span>'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			// 	}
			// } 
			if ($short) {
				$categories_list = get_the_category();
				$i = 0;
				if (count($categories_list) > 2) {
					$lastCat = 3;
				} else {
					$lastCat = count($categories_list);
				}
				foreach ($categories_list as $cat) {
					if ($nolink) {
						$cats .= esc_html($cat->name);
					} else {
						$cats .= '<a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a>';
					}
					$cats .= ', ';
					if (++$i == $lastCat) {
						$cats = rtrim($cats, ", ");
						break;
					}
				}
				if ($cats && tenet_categorized_blog()) {
					printf('<span class="cat-links">%s</span>', $cats); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			/* translators: used between list items, there is a space after the comma */

			if (!$short) {
				$tags_list = get_the_tag_list('', ' ');
				$i = 0;
				if (!has_post_thumbnail()) {
					$categories_list = '';
					foreach ((get_the_category()) as $cat) {
						$categories_list .= '<a href="' . get_category_link($cat->cat_ID) . '"> ' . $cat->cat_name . '</a>' . ' ';
						if (++$i == 3) break;
					}
					if ($categories_list) {

						if ($tags_list) {
							printf('<span class="tag-links">' . $categories_list . $tags_list .  '</span>'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
					}
				} else {
					if ($tags_list) {
						printf('<span class="tag-links">'  . $tags_list .  '</span>'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
				}
			}
			// else {
			// 	$Y = 3; // for instance
			// 	ob_start();
			// 	$tags_list = get_the_category();
			// 	// if (count($tags_list) + 1 < $Y) {
			// 	// 	$Y = count($tags_list) - 1;
			// 	// }
			// 	if ($tags_list) {
			// 		$tags = implode('<li', array_slice(explode('<li', ob_get_clean()), 0, $Y + 1));
			// 		printf('<span class="tags-links">' . esc_html__(', %s', 'tenet') . '</span>', $tags); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			// 	}
			// }
		}
		if (!$short) {
			if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
				echo '<span class="comments-link">';
				comments_popup_link(esc_html__('Leave a comment', 'tenet'), esc_html__('1 Comment', 'tenet'), esc_html__('% Comments', 'tenet'));
				echo '</span>';
			}
		}
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__(' Edit %s', 'tenet'),
				the_title('<span class="sr-only">"', '"</span>', false)
			),
			'<span class="edit-link">',
			'</span>'
		);
		echo '<div class="entry-footer-divider small"></div>';
	}
}


if (!function_exists('tenet_categorized_blog')) {
	/**
	 * Returns true if a blog has more than 1 category.
	 *
	 * @return bool
	 */
	function tenet_categorized_blog()
	{
		$all_the_cool_cats = get_transient('tenet_categories');
		if (false === $all_the_cool_cats) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories(
				array(
					'fields'     => 'ids',
					'hide_empty' => 1,
					// We only need to know if there is more than one category.
					'number'     => 2,
				)
			);
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count($all_the_cool_cats);
			set_transient('tenet_categories', $all_the_cool_cats);
		}
		if ($all_the_cool_cats > 1) {
			// This blog has more than 1 category so tenet_categorized_blog should return true.
			return true;
		}
		// This blog has only 1 category so tenet_categorized_blog should return false.
		return false;
	}
}

add_action('edit_category', 'tenet_category_transient_flusher');
add_action('save_post', 'tenet_category_transient_flusher');

if (!function_exists('tenet_category_transient_flusher')) {
	/**
	 * Flush out the transients used in tenet_categorized_blog.
	 */
	function tenet_category_transient_flusher()
	{
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient('tenet_categories');
	}
}

if (!function_exists('tenet_body_attributes')) {
	/**
	 * Displays the attributes for the body element.
	 */
	function tenet_body_attributes()
	{
		/**
		 * Filters the body attributes.
		 *
		 * @param array $atts An associative array of attributes.
		 */
		$atts = array_unique(apply_filters('tenet_body_attributes', $atts = array()));
		if (!is_array($atts) || empty($atts)) {
			return;
		}
		$attributes = '';
		foreach ($atts as $name => $value) {
			if ($value) {
				$attributes .= sanitize_key($name) . '="' . esc_attr($value) . '" ';
			} else {
				$attributes .= sanitize_key($name) . ' ';
			}
		}
		echo trim($attributes); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}

if (!function_exists('tenet_thumbnail')) {
	function tenet_thumbnail($postID)
	{
		if (has_post_thumbnail($postID)) {
?>
			<div class="single-thumbnail">
				<?php

				the_post_thumbnail($postID, 'full');

				$categories_list = get_the_category_list(esc_html__(', ', 'tenet'));
				if ($categories_list && tenet_categorized_blog()) {
					printf('<span class="cat-links">%s</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</div>
<?php }
	}
}
