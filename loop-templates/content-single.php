<?php

/**
 * Single post partial template
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$headerbefore = get_theme_mod('single_header_position') == "before-thumb" ? true : false;
?>

<article <?php post_class('boxy'); ?> id="post-<?php the_ID(); ?>">

	<?php if ($headerbefore) {
		tenet_single_header();
	} ?>

	<?php tenet_single_thumbnail($post) ?>

	<?php if (!$headerbefore) {
		tenet_single_header();
	} ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __('Pages:', 'tenet'),
				'after'  => '</div>',
			)
		);
		get_template_part('inc/template', 'social-share');
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php tenet_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->