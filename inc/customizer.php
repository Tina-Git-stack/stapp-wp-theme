<?php
/**
 * Theme Customizer
 *
 * @package STApp_WP_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Customizer Settings
 */
function stapp_wp_theme_customize_register($wp_customize) {

    // Logo Section
    $wp_customize->add_section('stapp_wp_logo_settings', array(
        'title'    => __('Logo Einstellungen', 'stapp-wp-theme'),
        'priority' => 30,
    ));

    // Logo Width Setting
    $wp_customize->add_setting('stapp_wp_logo_width', array(
        'default'           => 150,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_logo_width', array(
        'label'       => __('Logo Breite', 'stapp-wp-theme'),
        'description' => sprintf(__('Aktuell: %spx', 'stapp-wp-theme'), get_theme_mod('stapp_wp_logo_width', 150)),
        'section'     => 'stapp_wp_logo_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 400,
            'step' => 5,
        ),
    ));

    // Logo Height Setting
    $wp_customize->add_setting('stapp_wp_logo_height', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_logo_height', array(
        'label'       => __('Logo Höhe', 'stapp-wp-theme'),
        'description' => sprintf(__('Aktuell: %spx (0 = automatisch)', 'stapp-wp-theme'), get_theme_mod('stapp_wp_logo_height', 0)),
        'section'     => 'stapp_wp_logo_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 200,
            'step' => 5,
        ),
    ));
}
add_action('customize_register', 'stapp_wp_theme_customize_register');

/**
 * Output Customizer CSS
 */
function stapp_wp_theme_customizer_css() {
    $logo_width = get_theme_mod('stapp_wp_logo_width', 150);
    $logo_height = get_theme_mod('stapp_wp_logo_height', 0);

    ?>
    <style type="text/css">
        .custom-logo-link img {
            width: <?php echo esc_attr($logo_width); ?>px;
            <?php if ($logo_height > 0) : ?>
            height: <?php echo esc_attr($logo_height); ?>px;
            <?php else : ?>
            height: auto;
            <?php endif; ?>
        }
    </style>
    <?php
}
add_action('wp_head', 'stapp_wp_theme_customizer_css');

/**
 * Customizer Live Preview JS
 */
function stapp_wp_theme_customize_preview_js() {
    wp_enqueue_script(
        'stapp-wp-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        array('jquery', 'customize-preview'),
        '1.0.0',
        true
    );
}
add_action('customize_preview_init', 'stapp_wp_theme_customize_preview_js');
