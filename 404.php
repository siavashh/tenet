<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('tenet_container_type');
?>

<div class="wrapper" id="error-404-wrapper">

	<div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main single-mode" id="main">

					<section class="error-404 not-found">

						<article class="boxy post not-found">
							<header class="entry-header">

								<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'tenet'); ?></h1>

							</header><!-- .page-header -->
							<div class="entry-content">
								<div class="symbol404">404</div>

								<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'tenet'); ?></p>

								<?php get_search_form(); ?>

								<div class="row">
									<div class="widget-count-4 col-md-3">
										<?php the_widget('WP_Widget_Recent_Posts'); ?>
									</div>
									<div class="widget-count-4 col-md-3">
										<?php if (tenet_categorized_blog()) : // Only show the widget if site has multiple categories. 
										?>

											<div class="widget widget_categories">

												<h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'tenet'); ?></h2>

												<ul>
													<?php
													wp_list_categories(
														array(
															'orderby'  => 'count',
															'order'    => 'DESC',
															'show_count' => 1,
															'title_li' => '',
															'number'   => 10,
														)
													);
													?>
												</ul>

											</div><!-- .widget -->

										<?php endif; ?>
									</div>
									<div class="widget-count-4 col-md-3">

										<?php

										/* translators: %1$s: smiley */
										$archive_content = '<p>' . sprintf(esc_html__('Try looking in the monthly archives. %1$s', 'tenet'), convert_smilies(':)')) . '</p>';
										the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
										?>
									</div>
									<div class="widget-count-4 col-md-3">
										<?php
										the_widget('WP_Widget_Tag_Cloud');
										?>
									</div>
								</div>
							</div>
						</article>

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #error-404-wrapper -->

<?php
get_footer();
