<?php

/**
 * The template for displaying the author pages
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
include get_template_directory() . '/global-templates/index-check.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
$container = get_theme_mod('tenet_container_type');
?>

<div class="wrapper" id="author-wrapper">

	<div class="<?php echo esc_attr($tenet_container); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part('global-templates/left-sidebar-check'); ?>

			<main class="site-main archive-mode" id="main">


				<?php
				if (get_query_var('author_name')) {
					$curauth = get_user_by('slug', get_query_var('author_name'));
				} else {
					$curauth = get_userdata(intval($author));
				}
				?>
				<div class="row" data-masonry='{"percentPosition": true, isOriginLeft: false }'>
					<div class="mb-4 <?php echo esc_attr($tenet_colClasses); ?>">
						<header class="post boxy side-header">
							<div class="entry-content">
								<div class="side-avatar">
									<?php
									if (!empty($curauth->ID)) {
										echo get_avatar($curauth->ID);
									} ?>
								</div>
								<h2 class="entry-title borderb dark-border">
									<?php
									echo esc_html($curauth->display_name);
									?>
								</h2>


								<?php if (!empty($curauth->user_url) || !empty($curauth->user_description)) : ?>
									<dl>
										<?php if (!empty($curauth->user_description)) : ?>
											<?php
											printf(
												'<dt>About %1$s </dt><dd>%2$s</dd>',
												esc_html($curauth->display_name, 'tenet'),
												esc_html($curauth->user_description)
											)
											?>
										<?php endif; ?>
									</dl>
								<?php endif; ?>
								<div class="author-socials">

									<?php if (!empty($curauth->user_url)) : ?>
										<li class="author-website">
											<a href="<?php echo esc_url($curauth->user_url); ?>"><i class="fa fa-link"></i></a>
										</li>
									<?php endif; ?>

								</div>
							</div>
						</header>
					</div>
					<!-- The Loop -->
					<?php
					if (have_posts()) {
						while (have_posts()) {
					?>
							<div class="mb-4 <?php echo esc_attr($tenet_colClasses); ?>">
						<?php
							the_post();
							get_template_part('loop-templates/content', get_post_format());
							echo "</div>";
						}
					} else {
						get_template_part('loop-templates/content', 'none');
					}
						?>
						<!-- End Loop -->
							</div>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php tenet_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part('global-templates/right-sidebar-check'); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

</div><!-- #author-wrapper -->

<?php
get_footer();
