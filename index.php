<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

include get_template_directory() . '/global-templates/index-check.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

?>
<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr($tenet_container); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part('global-templates/left-sidebar-check'); ?>

			<main class="site-main archive-mode" id="main">
				<div class="row" data-masonry='{"percentPosition": true , "isOriginLeft" : <?php echo !is_rtl() ?> }'>
					<?php
					if (have_posts()) {

						// Start the Loop.
						while (have_posts()) {
							// if ($i == 0) echo '<div class="row">';
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

							// echo '</div>'; // col
							// $i++;
							// if we're at the end close the row
							// if ($i == $total) {
							// 	echo '</div>';
							// } else {
							// 	/** 
							// 	 * Perform modulus calculation to check whether $i / 2 is whole number
							// 	 * if true close row and open a new one
							// 	 */
							// 	if ($i % $columns == 0) {
							// 		echo '</div><div class="row">';
							// 	}
							// }
							echo "</div>";
						}
					} else {
						get_template_part('loop-templates/content', 'none');
					}
						?>
							</div>
			</main><!-- #main -->

			<!-- The pagination component -->
			<?php tenet_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part('global-templates/right-sidebar-check'); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
