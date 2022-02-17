<?php

/**
 * Colors and Styles settings -> Footer social icon styles
 * Tenet 0.1.0
 */
$wp_customize->add_setting('tenet_socials_settings_type', array(
    'default'           => '',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
));

if (!function_exists('tenet_socials_array')) :

    function tenet_socials_array()
    {

        $social_types = array(
            'socials-type-1'  => get_template_directory_uri() . '/img/Socials-type-1.png',
            'socials-type-2' => get_template_directory_uri() . '/img/Socials-type-2.png',
            'socials-type-3' => get_template_directory_uri() . '/img/Socials-type-3-tenet.png',
            'socials-type-4' => get_template_directory_uri() . '/img/Socials-type-4-tenet.png'
        );

        return $social_types;
    }
endif;

$wp_customize->add_control(new tenet_new_Image_Radio_Control(
    $wp_customize,
    'tenet_socials_settings_type',
    array(
        'choices' => tenet_socials_array(),
        'label' => __('Footer social icons', 'tenet'),
        'description'       => __(
            'Set the way of showing social icons.',
            'tenet'
        ),
        'section' => 'colors',
        'settings' => 'tenet_socials_settings_type',
        'type' => 'radio',
        'priority'          => apply_filters('tenet_socials_priority', 20),
    )
));

$wp_customize->add_setting('tenet_socials_settings_radius', array(
    'default'           => '',
    'type'              => 'theme_mod',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
));

$wp_customize->add_control(new tenet_range_slider(
    $wp_customize,
    'tenet_socials_settings_radius',
    array(
        'label' => __('Footer social icons border radius', 'tenet'),
        'description'       => __(
            'Round corner of social icons',
            'tenet'
        ),
        'default' => 25,
        'max' => 25,
        'section' => 'colors',
        'settings' => 'tenet_socials_settings_radius',
        'type' => 'range-slider',
        'priority'          => apply_filters('tenet_socials_priority', 30),
    )
));
