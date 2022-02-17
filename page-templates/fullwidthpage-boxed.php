<?php

/**
 * Template Name: Full Width Page BOXY Mode
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 * This templated wrap all content in a box (when boxed setting is selected.) if you want to use this template for custom homepages and use posts lists, it's better to use "Full width page" template
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();


if (is_front_page()) {
	get_template_part('global-templates/hero');
}
?>

<div class="wrapper full-width-page-wrapper" id="full-width-page-wrapper">

	<!-- <div class="container-fluid" id="content"> -->
	<div class="container-fluid" id="content">
		<div class="row">

			<div class="col-lg-12 content-area" id="primary">

				<main class="site-main single-mode" id="main" role="main">

					<?php
					while (have_posts()) {
						the_post();
						get_template_part('loop-templates/content', 'boxy-notitle-page');

						if (comments_open() || get_comments_number()) {
							// comments_template();
							get_template_part('comments', 'fullwidth');
						}
					}
					?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- #content -->

</div><!-- #full-width-page-wrapper -->

<?php
get_footer();
