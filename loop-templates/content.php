<?php

/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class('boxy'); ?> id="post-<?php the_ID(); ?>">


	<?php if (has_post_thumbnail()) { ?>
		<a href="<?php the_permalink() ?>">
			<div class="entry-thumbnail" style="background-image:url('<?php echo esc_attr(get_the_post_thumbnail_url($post->ID, 'large'));  ?>')"></div>
		</a>
	<?php } else { ?>
		<div class="mb-1 mt-2"></div>
	<?php } ?>

	<header class="entry-header">
		<div class="entry-tags">
			<?php tenet_entry_footer(true, false); ?>
			<?php if ('post' === get_post_type()) : ?>

				<div class="entry-meta">
					<?php tenet_posted_on(true); ?>
				</div><!-- .entry-meta -->

			<?php endif; ?>
		</div>
		<a href="<?php the_permalink() ?>">
			<?php
			the_title(
				sprintf('<h2 class="entry-title borderb dark-border">'),
				'</h2>'
			);
			?>
		</a>
	</header><!-- .entry-header -->
	<div class="entry-content">

		<?php the_excerpt();
		?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __('Pages:', 'tenet'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->