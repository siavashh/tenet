<?php

/**
 * Colors and Styles settings -> color palettes
 * Tenet 0.1.0
 */

$wp_customize->add_setting('tenet_color_palette', array(
    'default' => 'tenet-palette',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wp_filter_nohtml_kses',
));

if (!function_exists('tenet_palette_array')) :

    function tenet_palette_array()
    {

        $color_palettes = array(
            'palette-tenet' => get_template_directory_uri() . '/img/palette-tenet.png',
            'palette-melon' => get_template_directory_uri() . '/img/palette-melon.png',
            'palette-desert' => get_template_directory_uri() . '/img/palette-desert.png',
        );

        return $color_palettes;
    }
endif;

$wp_customize->add_control(new tenet_new_Image_Radio_Control(
    $wp_customize,
    'tenet_color_palette',
    array(
        'choices' => tenet_palette_array(),
        'label' => __('Theme color palette', 'tenet'),
        'description' => __(
            'Set your favourite palette',
            'tenet'
        ),
        'section' => 'colors',
        'settings' => 'tenet_color_palette',
        'type' => 'radio',
        'priority' => apply_filters('tenet_palette_priority', 10),
    )
));
