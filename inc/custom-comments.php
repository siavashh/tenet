<?php

/**
 * Comment layout
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;



// Add Bootstrap classes to comment form fields.
add_filter('comment_form_default_fields', 'tenet_bootstrap_comment_form_fields');

if (!function_exists('tenet_bootstrap_comment_form_fields')) {
	/**
	 * Add Bootstrap classes to WP's comment form default fields.
	 *
	 * @param array $fields {
	 *     Default comment fields.
	 *
	 *     @type string $author  Comment author field HTML.
	 *     @type string $email   Comment author email field HTML.
	 *     @type string $url     Comment author URL field HTML.
	 *     @type string $cookies Comment cookie opt-in field HTML.
	 * }
	 *
	 * @return array
	 */
	function tenet_bootstrap_comment_form_fields($fields)
	{

		// $replace = array(
		// 	'<p class="' => '<div class="form-floating col-md-4 mb-2 ',
		// 	'<input'     => '<input class="form-control" ',
		// 	'</p>'       => '</div>',
		// );

		// if (isset($fields['author'])) {
		// 	$fields['author'] = strtr($fields['author'], $replace);

		// }
		// if (isset($fields['email'])) {
		// 	$fields['email'] = strtr($fields['email'], $replace);
		// }
		// if (isset($fields['url'])) {
		// 	$fields['url'] = strtr($fields['url'], $replace);
		// }

		$replace = array(
			'<p class="' => '<div class="form-check ',
			'<input'     => '<input class="form-check-input" ',
			'<label'     => '<label class="form-check-label"',
			'</p>'       => '</div></div>',
		);
		// if (isset($fields['cookies'])) {
		// 	$fields['cookies'] = strtr($fields['cookies'], $replace);
		// }

		unset($fields['author']);
		unset($fields['email']);
		unset($fields['url']);
		if (isset($fields['cookies'])) {
			$cookies = strtr($fields['cookies'], $replace);
		}
		unset($fields['cookies']);
		$args = wp_parse_args($fields);
		if (!isset($args['format'])) {
			$args['format'] = current_theme_supports('html5', 'comment-form') ? 'html5' : 'xhtml';
		}
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$html5    = 'html5' === $args['format'];


		$fields['author'] = '<div class="row"><div class="col-md mb-3"><div class="form-floating comment-form-author">' .
			'<input class="form-control" id="author" name="author" type="text"
			value="" 
			placeholder="Name"
			size="30"' . $aria_req . ' />
			<label for="author">' . esc_html__('Name *', 'tenet')  . '</label> </div> </div>';

		$fields['email']  = '<div class="col-md mb-3"><div class="form-floating comment-form-email">' .
			'<input class="form-control" id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') .
			'value="' . esc_attr($commenter['comment_author_email']) . '"
			 placeholder="Email"
			 size="30"' . $aria_req . ' /> 
			 <label for="email">' . esc_html__('Email *', 'tenet')  . '</label> </div> </div></div>';

		$fields['url'] = '<div class="row"><div class="col-md"><div class="form-floating  comment-form-url">' .
			'<input class="form-control" id="url" name="url" type="text"
		value="' . esc_attr($commenter['comment_author_url']) . '" 
		placeholder="Website" 
		size="30"' . $aria_req . ' />
		<label for="url">' . esc_html__('url', 'tenet') . ($req ? '*' : '') . '</label> </div></div>';


		$fields['cookies'] = $cookies;

		return $fields;
	}
} // End of if function_exists( 'tenet_bootstrap_comment_form_fields' )

// Add Bootstrap classes to comment form submit button and comment field.
add_filter('comment_form_defaults', 'tenet_bootstrap_comment_form');

if (!function_exists('tenet_bootstrap_comment_form')) {
	/**
	 * Adds Bootstrap classes to comment form submit button and comment field.
	 *
	 * @param string[] $args Comment form arguments and fields.
	 *
	 * @return string[]
	 */
	function tenet_bootstrap_comment_form($args)
	{
		$replace = array(
			'<p class="' => '<div class="form-floating ',
			'<textarea'  => '<textarea class="form-control" ',
			'</p>'       => '</div>',
		);

		if (isset($args['comment_field'])) {
			$args['comment_field'] =  sprintf(
				'<div class="form-floating mb-3">%s %s</div>',
				'<textarea class="form-control" id="comment" placeholder="Comment" name="comment" maxlength="65525" required="required"></textarea>',
				'<label for="comment">' . esc_html__('Write your comment here', 'tenet') . '</label>'
			);
		}
		if (isset($args['class_submit'])) {
			$args['class_submit'] = 'btn btn-secondary';
		}
		return $args;
	}
} // End of if function_exists( 'tenet_bootstrap_comment_form' ).

// Add note if comments are closed.
add_action('comment_form_comments_closed', 'tenet_comment_form_comments_closed');

if (!function_exists('tenet_comment_form_comments_closed')) {
	/**
	 * Displays a note that comments are closed if comments are closed and there are comments.
	 */
	function tenet_comment_form_comments_closed()
	{
		if (get_comments_number() && post_type_supports(get_post_type(), 'comments')) {
?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'tenet'); ?></p>
		<?php
		}
	}
} // End of if function_exists( 'tenet_comment_form_comments_closed' ).

add_action('comment_form_before_fields', 'tenet_comment_form_before_fields');

if (!function_exists('tenet_comment_form_before_fields')) {
	function tenet_comment_form_before_fields()
	{
		?>
		<div class="">
		<?php
	}
}

add_action('comment_form_after_fields', 'tenet_comment_form_after_fields');

if (!function_exists('tenet_comment_form_after_fields')) {
	function tenet_comment_form_after_fields()
	{
		?>
		</div>
<?php
	}
}
