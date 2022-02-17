<?php

/**
 * The template for displaying search forms
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_search_form();

wp_nav_menu(
	array(
		'theme_location'  => 'searchform',
		'container_class' => 'searchscreen-nav',
		'container_id'    => 'searchscreenNav',
		'menu_class'      => 'searchscreen-navbar-nav',
		'fallback_cb'     => '',
		'menu_id'         => 'searchscreenMenu',
		'depth'           => 1
	)
);
?>