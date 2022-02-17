<?php

/**
 * The template for displaying search results pages
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

// $tenet_container = get_theme_mod( 'tenet_container_type' );
$tenet_container = "container"

?>

<div class="wrapper" id="search-wrapper">

	<div class="<?php echo esc_attr($tenet_container); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<!-- <?php //get_template_part('global-templates/left-sidebar-check'); 
					?> -->
			<div class="col-lg-12 ">
				<main class="site-main" id="main">


					<?php if (have_posts()) : ?>

						<header class="page-header">

							<h1 class="page-title">
								<?php
								printf(
									/* translators: %s: query term */
									esc_html__('Search Results for: %s', 'tenet'),
									'<span>' . get_search_query() . '</span>'
								);
								?>
							</h1>

						</header><!-- .page-header -->
						<div class="searchform">
							<?php get_search_form(); ?>
						</div>
						<?php /* Start the Loop */ ?>
						<?php
						// Start the loop.
						while (have_posts()) {
							if ($i == 0) echo '<div class="row">';
						?>
							<div class="col-md-6">
							<?php
							the_post();

							/*
								* Include the Post-Format-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Format name) and that will be used instead.
								*/
							get_template_part('loop-templates/content', get_post_format());

							echo '</div>'; // col
							$i++;
							// if we're at the end close the row
							if ($i == $total) {
								echo '</div>';
							} else {
								/** 
								 * Perform modulus calculation to check whether $i / 2 is whole number
								 * if true close row and open a new one
								 */
								if ($i % 2 == 0) {
									echo '</div><div class="row">';
								}
							}
						}
							?>

						<?php else : ?>

							<?php get_template_part('loop-templates/content', 'none'); ?>

						<?php endif; ?>

				</main><!-- #main -->

				<?php
				// Display the pagination component.
				tenet_pagination();
				// Do the right sidebar check.
				// get_template_part('global-templates/right-sidebar-check');
				?>

				<!-- Do the right sidebar check -->
				<?php //get_template_part('global-templates/right-sidebar-check'); 
				?>

			</div><!-- .row -->

		</div><!-- #content -->

	</div><!-- #search-wrapper -->

	<?php
	get_footer();
