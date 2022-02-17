<?php
// Theme layout settings.
$wp_customize->add_section(
    'tenet_theme_layout_options',
    array(
        'title'       => __('Theme Layout Settings', 'tenet'),
        'capability'  => 'edit_theme_options',
        'description' => __('Container width and sidebar defaults', 'tenet'),
        'priority'    => apply_filters('tenet_theme_layout_options_priority', 160),
    )
);
$wp_customize->add_setting(
    'tenet_box_type',
    array(
        'default'           => 'boxed-body',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'tenet_theme_slug_sanitize_select',
        'capability'        => 'edit_theme_options',
    )
);
if (!function_exists('tenet_box_type_array')) :
    /*
     * Function to get blog categories
     */
    function tenet_box_type_array()
    {
        $container_type = array(
            'boxed-body'  => get_template_directory_uri() . '/img/boxed.png',
            'unboxed-body'  => get_template_directory_uri() . '/img/unboxed.png'
        );
        return $container_type;
    }
endif;

$wp_customize->add_control(
    new tenet_new_Image_Radio_Control(
        $wp_customize,
        'tenet_box_type',
        array(
            'label'       => __('Boxed/Unboxed mode', 'tenet'),
            'description' => __('Choose boxed mode or unbox', 'tenet'),
            'section'     => 'tenet_theme_layout_options',
            'settings'    => 'tenet_box_type',
            'type'        => 'radio',
            'choices' => tenet_box_type_array(),
            'priority'    => apply_filters('tenet_box_type_priority', 10),
        )
    )
);



$wp_customize->add_setting(
    'tenet_container_type',
    array(
        'default'           => 'container',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'tenet_theme_slug_sanitize_select',
        'capability'        => 'edit_theme_options',
    )
);
if (!function_exists('tenet_container_type_array')) :
    /*
     * Function to get blog categories
     */
    function tenet_container_type_array()
    {
        $container_type = array(
            'container'  => get_template_directory_uri() . '/img/fixed-width-container.png',
            'container-fluid'  => get_template_directory_uri() . '/img/full-width-container.png'
        );
        return $container_type;
    }
endif;

$wp_customize->add_control(
    new tenet_new_Image_Radio_Control(
        $wp_customize,
        'tenet_container_type',
        array(
            'label'       => __('Container Width', 'tenet'),
            'description' => __('Choose between Bootstrap\'s container and container-fluid', 'tenet'),
            'section'     => 'tenet_theme_layout_options',
            'settings'    => 'tenet_container_type',
            'type'        => 'radio',
            'choices' => tenet_container_type_array(),
            'priority'    => apply_filters('tenet_container_type_priority', 10),
        )
    )
);

$wp_customize->add_setting(
    'tenet_sidebar_position',
    array(
        'default'           => 'right',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
        'capability'        => 'edit_theme_options',
    )
);


if (!function_exists('tenet_blog_sidebar_position_array')) :

    function tenet_blog_sidebar_position_array()
    {

        $sidebar_positions = array(
            'right'  => get_template_directory_uri() . '/img/right-sidebar.png',
            'left' => get_template_directory_uri() . '/img/left-sidebar.png',
            'both'  => get_template_directory_uri() . '/img/two-sidebar.png',
            'none'  => get_template_directory_uri() . '/img/no-sidebar.png',
        );

        return $sidebar_positions;
    }
endif;


$wp_customize->add_control(new tenet_new_Image_Radio_Control(
    $wp_customize,
    'tenet_sidebar_position',
    array(
        'choices' => tenet_blog_sidebar_position_array(),
        'label' => __('Blog and Archive Sidebar', 'tenet'),
        'description'       => __(
            'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
            'tenet'
        ),
        'section' => 'tenet_theme_layout_options',
        'settings' => 'tenet_sidebar_position',
        'type' => 'radio',
        'priority'          => apply_filters('tenet_sidebar_position_priority', 20),
    )
));

// Post header position

$wp_customize->add_setting(
    'single_header_position',
    array(
        'default'           => 'after-thumb',
        'type'              => 'theme_mod',
        'sanitize_callback' => 'tenet_theme_slug_sanitize_select',
        'capability'        => 'edit_theme_options',
    )
);
if (!function_exists('tenet_single_header_position_array')) :
    /*
     * Function to get blog categories
     */
    function tenet_single_header_position_array()
    {
        $container_type = array(
            'after-thumb'  => get_template_directory_uri() . '/img/after-thumb.png',
            'before-thumb'  => get_template_directory_uri() . '/img/before-thumb.png'
        );
        return $container_type;
    }
endif;

$wp_customize->add_control(
    new tenet_new_Image_Radio_Control(
        $wp_customize,
        'single_header_position',
        array(
            'label'       => __('Single post/page header position', 'tenet'),
            'description' => __('Show post/page header before thumbnail or after that?', 'tenet'),
            'section'     => 'tenet_theme_layout_options',
            'settings'    => 'single_header_position',
            'type'        => 'radio',
            'choices' => tenet_single_header_position_array(),
            'priority'    => apply_filters('tenet_single_header_position_priority', 10),
        )
    )
);




// $wp_customize->add_control(
//     new WP_Customize_Control(
//         $wp_customize,
//         'tenet_sidebar_position',
//         array(
//             'label'             => __('Sidebar Positioning', 'tenet'),
//             'description'       => __(
//                 'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
//                 'tenet'
//             ),
//             'section'           => 'tenet_theme_layout_options',
//             'settings'          => 'tenet_sidebar_position',
//             'type'              => 'select',
//             'sanitize_callback' => 'tenet_theme_slug_sanitize_select',
//             'choices'           => array(
//                 'right' => __('Right sidebar', 'tenet'),
//                 'left'  => __('Left sidebar', 'tenet'),
//                 'both'  => __('Left & Right sidebars', 'tenet'),
//                 'none'  => __('No sidebar', 'tenet'),
//             ),
//             'priority'          => apply_filters('tenet_sidebar_position_priority', 20),
//         )
//     )
// );