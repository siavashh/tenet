<?php

/**
 * Sidebar setup for footer full
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$tenet_container = get_theme_mod('tenet_container_type');

?>

<?php if (is_active_sidebar('footerfull')) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper" id="wrapper-footer-full">

		<div class="<?php echo esc_attr($tenet_container); ?>" id="footer-full-content" tabindex="-1">

			<div class="row">

				<?php dynamic_sidebar('footerfull'); ?>

			</div>

		</div>

	</div><!-- #wrapper-footer-full -->

<?php
endif;
