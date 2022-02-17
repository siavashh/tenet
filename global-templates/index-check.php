<?php
$tenet_container = get_theme_mod('tenet_container_type');
$tenet_sidebar_pos = get_theme_mod('tenet_sidebar_position');

// Get total posts
$tenet_total_posts = $GLOBALS['wp_query']->post_count;

if ('both' === $tenet_sidebar_pos && is_active_sidebar('right-sidebar') && is_active_sidebar('left-sidebar')) {
    // $columns = 2;
    $tenet_colClasses = "col-md-6 side-mode";
} else if ( // if site is in no sidebar mode OR two sides are deactivated
    'none' === $tenet_sidebar_pos &&
    !(is_active_sidebar('left-sidebar' &&  is_active_sidebar('right-sidebar')))
) {
    // $columns = 3;
    $tenet_colClasses = "col-lg-4";
} else {
    // $columns = 3;
    $tenet_colClasses = "col-lg-6 col-md-12 side-mode";
}
