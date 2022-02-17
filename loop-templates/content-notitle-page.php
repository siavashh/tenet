<?php

/**
 * Partial template for content in page.php
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<?php tenet_thumbnail(get_the_ID()) ?>
<!-- <div class="fullpage-box"> -->

<div class="container main-content">
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php the_title('<header class="entry-header"><h1 class="entry-title">', '</h1></header>');
		?>


		<div class="entry-content">

			<?php the_content(); ?>
			<div class="clearfix"></div>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __('Pages:', 'tenet'),
					'after'  => '</div>',
				)
			);
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php edit_post_link(__('Edit', 'tenet'), '<span class="edit-link">', '</span>'); ?>

		</footer><!-- .entry-footer -->

	</article><!-- #post-## -->
</div>
<!-- </div> -->