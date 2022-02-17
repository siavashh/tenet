<?php

// todo: reset button https://stackoverflow.com/questions/16579802/one-button-to-change-all-settings-in-the-wordpress-theme-customizer
// BODY BACKGROUND
$wp_customize->add_setting(
    // $id
    'body_background_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'body_background_color',
        // $args
        array(
            'settings'      => 'body_background_color',
            'section'       => 'colors',
            'label'         => __('Body Background Color', 'tenet'),
            'description'   => __('Select the background color of website.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 90),

        )
    )
);

// Primary Color
$wp_customize->add_setting(
    // $id
    'primary_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'primary_color',
        // $args
        array(
            'settings'      => 'primary_color',
            'section'       => 'colors',
            'label'         => __('Site Primary Color', 'tenet'),
            'description'   => __('Select the primary color of website.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 90),

        )
    )
);


// secondary Color
$wp_customize->add_setting(
    // $id
    'secondary_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'secondary_color',
        // $args
        array(
            'settings'      => 'secondary_color',
            'section'       => 'colors',
            'label'         => __('Site Secondary Color', 'tenet'),
            'description'   => __('Select the secondary color of website.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 90),

        )
    )
);


// Font Color
$wp_customize->add_setting(
    // $id
    'body_font_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'body_font_color',
        // $args
        array(
            'settings'      => 'body_font_color',
            'section'       => 'colors',
            'label'         => __('Site Font Color', 'tenet'),
            'description'   => __('Select the font color of website.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 90),

        )
    )
);

// Title Font Color
$wp_customize->add_setting(
    // $id
    'title_font_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'title_font_color',
        // $args
        array(
            'settings'      => 'title_font_color',
            'section'       => 'colors',
            'label'         => __('Site Titles Font Color', 'tenet'),
            'description'   => __('Select the font color for titles.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 90),

        )
    )
);



// HEADER

$wp_customize->add_setting(
    // $id
    'header_background_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'header_background_color',
        // $args
        array(
            'settings'      => 'header_background_color',
            'section'       => 'colors',
            'label'         => __('Header Background Color', 'tenet'),
            'description'   => __('Select the background color for header.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 100),

        )
    )
);

// FOOTER

$wp_customize->add_setting(
    // $id
    'footer_background_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'footer_background_color',
        // $args
        array(
            'settings'      => 'footer_background_color',
            'section'       => 'colors',
            'label'         => __('Footer Background Color', 'tenet'),
            'description'   => __('Select the background color for footer.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 110),

        )
    )
);


// Social icons

$wp_customize->add_setting(
    // $id
    'socials_background_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'socials_background_color',
        // $args
        array(
            'settings'      => 'socials_background_color',
            'section'       => 'colors',
            'label'         => __('Social Icons Background Color', 'tenet'),
            'description'   => __('Select the background color for social icons.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 120),

        )
    )
);

$wp_customize->add_setting(
    // $id
    'socials_font_color',
    // $args
    array(
        'default'           => '',
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage'
    )
);

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        // $wp_customize object
        $wp_customize,
        // $id
        'socials_font_color',
        // $args
        array(
            'settings'      => 'socials_font_color',
            'section'       => 'colors',
            'label'         => __('Social Icons Color', 'tenet'),
            'description'   => __('Select the color for social icons.', 'tenet'),
            'type'          => 'color',
            'priority'          => apply_filters('tenet_colors_priority', 130),

        )
    )
);
