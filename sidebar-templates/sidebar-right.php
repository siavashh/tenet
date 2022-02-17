<?php

/**
 * The right sidebar containing the main widget area
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

if (!is_active_sidebar('right-sidebar')) {
	return;
}

// when both sidebars turned on reduce col size to 3 from 4.
$tenet_sidebar_pos = get_theme_mod('tenet_sidebar_position');
?>

<?php if ('both' === $tenet_sidebar_pos && is_active_sidebar('right-sidebar') && is_active_sidebar('left-sidebar')) : ?>
	<div class="col-md-6 col-lg-3 col-xl-4 widget-area both-sides" id="right-sidebar" role="complementary">
	<?php else : ?>
		<div class="col-lg-4 widget-area right-only" id="right-sidebar" role="complementary">

			<!-- <aside data-customize-partial-id="widget[tenet-socials]" data-customize-partial-type="widget" data-customize-partial-placement-context="" data-customize-widget-id="recent-comments-2" id="recent-comments-2" class="widget widget_tenet_socials">
				<h3 class="widget-title">Follow me on socialmedia</h3>
				<ul id="recentcomments">

					<?php

					// $socialNetworks = ['facebook', 'instagram', 'twitter', 'youtube'];

					// foreach ($socialNetworks as $social) {
					// 	if (!empty(get_theme_mod('tenet_socials_' . $social))) {
					// 		echo '<li><a href="http://' . $social . ".com/" . get_theme_mod('tenet_socials_' . $social) . '"  class="' . $social . '_icon"> ' . get_theme_mod('tenet_socials_' . $social) . '</a></li>';
					// 	}
					// }


					?>
				</ul>
			</aside> -->





		<?php endif; ?>
		<?php dynamic_sidebar('right-sidebar'); ?>

		</div><!-- #right-sidebar -->