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
 * Sanitize RGBA color value
 */
function stapp_wp_sanitize_rgba($value) {
    if (preg_match('/^rgba?\([\d\s,\.]+\)$/', $value)) {
        return $value;
    }
    return sanitize_hex_color($value) ?: '';
}

/**
 * Sanitize range input (0-100)
 */
function stapp_wp_sanitize_range($value) {
    $value = absint($value);
    return min(100, max(0, $value));
}

/**
 * Sanitize checkbox
 */
function stapp_wp_sanitize_checkbox($value) {
    return (bool) $value;
}

/**
 * Add Customizer Settings
 */
function stapp_wp_theme_customize_register($wp_customize) {

    // =========================================================================
    // Logo Section (existing)
    // =========================================================================
    $wp_customize->add_section('stapp_wp_logo_settings', array(
        'title'    => __('Logo Einstellungen', 'stapp-wp-theme'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('stapp_wp_logo_width', array(
        'default'           => 150,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_logo_width', array(
        'label'       => __('Logo Breite', 'stapp-wp-theme'),
        'description' => __('Logo-Breite in Pixel', 'stapp-wp-theme'),
        'section'     => 'stapp_wp_logo_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 50,
            'max'  => 400,
            'step' => 5,
        ),
    ));

    $wp_customize->add_setting('stapp_wp_logo_height', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_logo_height', array(
        'label'       => __('Logo Höhe', 'stapp-wp-theme'),
        'description' => __('Logo-Höhe in Pixel (0 = automatisch)', 'stapp-wp-theme'),
        'section'     => 'stapp_wp_logo_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 200,
            'step' => 5,
        ),
    ));

    // =========================================================================
    // Header Section
    // =========================================================================
    $wp_customize->add_section('stapp_wp_header_settings', array(
        'title'    => __('Header', 'stapp-wp-theme'),
        'priority' => 31,
    ));

    // Header Background Color
    $wp_customize->add_setting('stapp_wp_header_bg_color', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_header_bg_color', array(
        'label'   => __('Header-Hintergrundfarbe (beim Scrollen)', 'stapp-wp-theme'),
        'section' => 'stapp_wp_header_settings',
    )));

    // Header Background Opacity
    $wp_customize->add_setting('stapp_wp_header_bg_opacity', array(
        'default'           => 80,
        'sanitize_callback' => 'stapp_wp_sanitize_range',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_header_bg_opacity', array(
        'label'       => __('Header-Transparenz (beim Scrollen)', 'stapp-wp-theme'),
        'description' => __('0 = vollständig transparent, 100 = vollständig deckend', 'stapp-wp-theme'),
        'section'     => 'stapp_wp_header_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));

    // Header Text Color
    $wp_customize->add_setting('stapp_wp_header_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_header_text_color', array(
        'label'   => __('Header-Textfarbe', 'stapp-wp-theme'),
        'section' => 'stapp_wp_header_settings',
    )));

    // =========================================================================
    // Footer Section
    // =========================================================================
    $wp_customize->add_section('stapp_wp_footer_settings', array(
        'title'    => __('Footer', 'stapp-wp-theme'),
        'priority' => 32,
    ));

    // Footer Background Color
    $wp_customize->add_setting('stapp_wp_footer_bg_color', array(
        'default'           => '#0f0f0f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_footer_bg_color', array(
        'label'   => __('Footer-Hintergrundfarbe', 'stapp-wp-theme'),
        'section' => 'stapp_wp_footer_settings',
    )));

    // Footer Background Opacity
    $wp_customize->add_setting('stapp_wp_footer_bg_opacity', array(
        'default'           => 60,
        'sanitize_callback' => 'stapp_wp_sanitize_range',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_footer_bg_opacity', array(
        'label'       => __('Footer-Transparenz', 'stapp-wp-theme'),
        'description' => __('0 = vollständig transparent, 100 = vollständig deckend', 'stapp-wp-theme'),
        'section'     => 'stapp_wp_footer_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));

    // Footer Text Color
    $wp_customize->add_setting('stapp_wp_footer_text_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_footer_text_color', array(
        'label'   => __('Footer-Textfarbe', 'stapp-wp-theme'),
        'section' => 'stapp_wp_footer_settings',
    )));

    // Footer Copyright Text
    $wp_customize->add_setting('stapp_wp_footer_copyright', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_footer_copyright', array(
        'label'       => __('Copyright-Text', 'stapp-wp-theme'),
        'description' => __('Platzhalter: {year} = aktuelles Jahr, {sitename} = Seitenname', 'stapp-wp-theme'),
        'section'     => 'stapp_wp_footer_settings',
        'type'        => 'text',
    ));

    // =========================================================================
    // Background Section
    // =========================================================================
    $wp_customize->add_section('stapp_wp_background_settings', array(
        'title'    => __('Background', 'stapp-wp-theme'),
        'priority' => 33,
    ));

    // Gradient Color 1
    $wp_customize->add_setting('stapp_wp_bg_gradient_color1', array(
        'default'           => '#1a1a2e',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_bg_gradient_color1', array(
        'label'   => __('Farbverlauf Farbe 1', 'stapp-wp-theme'),
        'section' => 'stapp_wp_background_settings',
    )));

    // Gradient Color 2
    $wp_customize->add_setting('stapp_wp_bg_gradient_color2', array(
        'default'           => '#0f1a2a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_bg_gradient_color2', array(
        'label'   => __('Farbverlauf Farbe 2', 'stapp-wp-theme'),
        'section' => 'stapp_wp_background_settings',
    )));

    // Base Background Color
    $wp_customize->add_setting('stapp_wp_bg_base_color', array(
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_bg_base_color', array(
        'label'   => __('Basis-Hintergrundfarbe', 'stapp-wp-theme'),
        'section' => 'stapp_wp_background_settings',
    )));

    // Blur Enabled
    $wp_customize->add_setting('stapp_wp_bg_blur_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'stapp_wp_sanitize_checkbox',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_bg_blur_enabled', array(
        'label'   => __('Blur-Kreise anzeigen', 'stapp-wp-theme'),
        'section' => 'stapp_wp_background_settings',
        'type'    => 'checkbox',
    ));

    // Blur Color 1
    $wp_customize->add_setting('stapp_wp_bg_blur_color1', array(
        'default'           => '#00D2FF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_bg_blur_color1', array(
        'label'   => __('Blur-Kreis Farbe 1', 'stapp-wp-theme'),
        'section' => 'stapp_wp_background_settings',
    )));

    // Blur Color 2
    $wp_customize->add_setting('stapp_wp_bg_blur_color2', array(
        'default'           => '#0080C8',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_bg_blur_color2', array(
        'label'   => __('Blur-Kreis Farbe 2', 'stapp-wp-theme'),
        'section' => 'stapp_wp_background_settings',
    )));

    // Blur Opacity
    $wp_customize->add_setting('stapp_wp_bg_blur_opacity', array(
        'default'           => 30,
        'sanitize_callback' => 'stapp_wp_sanitize_range',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control('stapp_wp_bg_blur_opacity', array(
        'label'       => __('Blur-Kreise Deckkraft', 'stapp-wp-theme'),
        'description' => __('0 = unsichtbar, 100 = volle Deckkraft', 'stapp-wp-theme'),
        'section'     => 'stapp_wp_background_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 100,
            'step' => 5,
        ),
    ));

    // Quality Line Color
    $wp_customize->add_setting('stapp_wp_bg_qualityline_color', array(
        'default'           => '#00D2FF',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'stapp_wp_bg_qualityline_color', array(
        'label'   => __('Quality-Line Farbe', 'stapp-wp-theme'),
        'section' => 'stapp_wp_background_settings',
    )));
}
add_action('customize_register', 'stapp_wp_theme_customize_register');

/**
 * Helper: Convert hex color to rgba
 */
function stapp_wp_hex_to_rgba($hex, $opacity) {
    $hex = ltrim($hex, '#');
    if (strlen($hex) === 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    return "rgba({$r}, {$g}, {$b}, {$opacity})";
}

/**
 * Output Customizer CSS as CSS Variables
 */
function stapp_wp_theme_customizer_css() {
    // Logo
    $logo_width  = get_theme_mod('stapp_wp_logo_width', 150);
    $logo_height = get_theme_mod('stapp_wp_logo_height', 0);

    // Header
    $header_bg_color   = get_theme_mod('stapp_wp_header_bg_color', '#1a1a1a');
    $header_bg_opacity = get_theme_mod('stapp_wp_header_bg_opacity', 80) / 100;
    $header_text_color = get_theme_mod('stapp_wp_header_text_color', '#ffffff');

    // Footer
    $footer_bg_color   = get_theme_mod('stapp_wp_footer_bg_color', '#0f0f0f');
    $footer_bg_opacity = get_theme_mod('stapp_wp_footer_bg_opacity', 60) / 100;
    $footer_text_color = get_theme_mod('stapp_wp_footer_text_color', '#ffffff');

    // Background
    $bg_gradient_color1 = get_theme_mod('stapp_wp_bg_gradient_color1', '#1a1a2e');
    $bg_gradient_color2 = get_theme_mod('stapp_wp_bg_gradient_color2', '#0f1a2a');
    $bg_base_color      = get_theme_mod('stapp_wp_bg_base_color', '#1a1a1a');
    $bg_blur_enabled    = get_theme_mod('stapp_wp_bg_blur_enabled', true);
    $bg_blur_color1     = get_theme_mod('stapp_wp_bg_blur_color1', '#00D2FF');
    $bg_blur_color2     = get_theme_mod('stapp_wp_bg_blur_color2', '#0080C8');
    $bg_blur_opacity    = get_theme_mod('stapp_wp_bg_blur_opacity', 30) / 100;
    $ql_color           = get_theme_mod('stapp_wp_bg_qualityline_color', '#00D2FF');

    ?>
    <style type="text/css" id="stapp-customizer-css">
        :root {
            --stapp-header-bg: <?php echo esc_attr(stapp_wp_hex_to_rgba($header_bg_color, $header_bg_opacity)); ?>;
            --stapp-header-text: <?php echo esc_attr($header_text_color); ?>;
            --stapp-footer-bg: <?php echo esc_attr(stapp_wp_hex_to_rgba($footer_bg_color, $footer_bg_opacity)); ?>;
            --stapp-footer-text: <?php echo esc_attr($footer_text_color); ?>;
            --stapp-bg-gradient: linear-gradient(160deg, <?php echo esc_attr($bg_gradient_color1); ?> 0%, <?php echo esc_attr($bg_base_color); ?> 30%, <?php echo esc_attr($bg_gradient_color2); ?> 60%, <?php echo esc_attr($bg_base_color); ?> 100%);
            --stapp-blur-color1: <?php echo esc_attr($bg_blur_color1); ?>;
            --stapp-blur-color2: <?php echo esc_attr($bg_blur_color2); ?>;
            --stapp-blur-opacity: <?php echo esc_attr($bg_blur_enabled ? $bg_blur_opacity : '0'); ?>;
            --stapp-qualityline-color: <?php echo esc_attr($ql_color); ?>;
        }

        .custom-logo-link img {
            width: <?php echo esc_attr($logo_width); ?>px;
            <?php if ($logo_height > 0) : ?>
            height: <?php echo esc_attr($logo_height); ?>px;
            <?php else : ?>
            height: auto;
            <?php endif; ?>
        }

        .bg-quality-line svg path,
        .bg-quality-line svg line,
        .bg-quality-line svg polyline,
        .bg-quality-line svg circle {
            stroke: var(--stapp-qualityline-color) !important;
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
