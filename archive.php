<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

if (is_rtl()) {
	$masonConfig = '{"percentPosition": true , isOriginLeft: false}';
} else {
	$masonConfig = '{"percentPosition": true }';
}
include get_template_directory() . '/global-templates/index-check.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
?>

<div class="wrapper" id="archive-wrapper">
	<div class="<?php echo esc_attr($tenet_container); ?>" id="content" tabindex="-1">
		<div class="row">
			<!-- Do the left sidebar check -->
			<?php get_template_part('global-templates/left-sidebar-check');
			?>
			<main class="site-main archive-mode" id="main">
				<div class="row" data-masonry="<?php echo $masonConfig; ?>">
					<div class="mb-4 <?php echo esc_attr($tenet_colClasses); ?>">
						<header class="post boxy side-header">
							<div class="entry-content">
								<div class="side-avatar">
									<?php
									if (!empty($curauth->ID)) {
										echo get_avatar($curauth->ID);
									} ?>
								</div>
								<?php
								the_archive_title('<h1 class="entry-title borderb dark-border">', '</h1>');
								?>

								<?php
								the_archive_description('<div class="taxonomy-description">', '</div>');
								?>
							</div>
						</header>
					</div>
					<?php
					if (have_posts()) {
					?>
						<?php
						// Start the loop.
						while (have_posts()) {
						?>
							<div class="mb-4 <?php echo esc_attr($tenet_colClasses); ?>">
						<?php
							the_post();

							/*
									* Include the Post-Format-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Format name) and that will be used instead.
									*/
							get_template_part('loop-templates/content', get_post_format());

							echo '</div>'; // col
						}
						echo '</div>';
					} else {
						get_template_part('loop-templates/content', 'none');
					}
						?>
			</main><!-- #main -->
			<?php
			// Display the pagination component.
			tenet_pagination();
			// Do the right sidebar check.
			get_template_part('global-templates/right-sidebar-check');
			?>
		</div><!-- row -->
	</div><!-- #container -->
</div><!-- #archive-wrapper -->

<?php
get_footer();
