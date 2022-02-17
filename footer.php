<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('tenet_container_type');
$socialtype = get_theme_mod('tenet_socials_settings_type');


?>

<?php get_template_part('sidebar-templates/sidebar', 'footerfull'); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_attr($container); ?>">

		<div class="row">
			<div class="col-md-12">
				<div class="container">
					<footer class="site-footer" id="colophon">

						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'socials',
								'container_class' => 'social-nav ' . $socialtype,
								'container_id'    => 'socialNav',
								'menu_class'      => 'social-navbar-nav',
								'fallback_cb'     => '',
								'menu_id'         => 'socialMenu',
								'depth'           => 1,

							)
						);
						?>

						<div class="site-info">

							<?php tenet_site_info(); ?>

						</div><!-- .site-info -->


					</footer><!-- #colophon -->
				</div>
			</div>
			<!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>


</body>

</html>