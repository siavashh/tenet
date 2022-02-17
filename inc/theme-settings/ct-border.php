<?php

/**
 * Colors and Styles settings -> Title border settings 
 * Tenet 0.1.0
 */

$wp_customize->add_setting('tenet_border_type', array(
    'default' => 'border-type-circle',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
));

if (!function_exists('tenet_borders_array')) :

    function tenet_borders_array()
    {

        $border_types = array(
            'border-type-zigzag' => get_template_directory_uri() . '/img/border-type-zigzag.png',
            'border-type-circle' => get_template_directory_uri() . '/img/border-type-circle.png',
            'border-type-simple' => get_template_directory_uri() . '/img/border-type-simple.png',
            'border-type-none' => get_template_directory_uri() . '/img/border-type-none.png',
        );

        return $border_types;
    }
endif;

$wp_customize->add_control(new tenet_new_Image_Radio_Control(
    $wp_customize,
    'tenet_border_type',
    array(
        'choices' => tenet_borders_array(),
        'label' => __('Footer social icons', 'tenet'),
        'description' => __(
            'Set the title border style.',
            'tenet'
        ),
        'section' => 'colors',
        'settings' => 'tenet_border_type',
        'type' => 'radio',
        'priority' => apply_filters('tenet_socials_priority', 10),
    )
));
