<?php
/**
 * Block Editor Customization
 *
 * @package STApp_WP_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Block Styles
 */
function stapp_wp_theme_register_block_styles() {
    // Gruppe → Glass (Glasmorphismus-Effekt)
    register_block_style('core/group', array(
        'name'  => 'glass',
        'label' => __('Glass', 'stapp-wp-theme'),
    ));

    // Gruppe → Hero Section (volle Viewport-Höhe, zentriert)
    register_block_style('core/group', array(
        'name'  => 'hero-section',
        'label' => __('Hero Section', 'stapp-wp-theme'),
    ));

    // Gruppe → Erste Sektion (nur Header-Abstand)
    register_block_style('core/group', array(
        'name'  => 'first-section',
        'label' => __('Erste Sektion', 'stapp-wp-theme'),
    ));

    // Gruppe → Mit Schatten
    register_block_style('core/group', array(
        'name'  => 'shadow',
        'label' => __('Mit Schatten', 'stapp-wp-theme'),
    ));

    // Überschrift → Gradient Text
    register_block_style('core/heading', array(
        'name'  => 'gradient-text',
        'label' => __('Gradient Text', 'stapp-wp-theme'),
    ));

    // Bild → Abgerundet
    register_block_style('core/image', array(
        'name'  => 'rounded',
        'label' => __('Abgerundet', 'stapp-wp-theme'),
    ));
}
add_action('init', 'stapp_wp_theme_register_block_styles');

/**
 * Enqueue Block Editor Assets
 */
function stapp_wp_theme_block_editor_assets() {
    wp_enqueue_style(
        'stapp-editor-block-styles',
        get_template_directory_uri() . '/assets/css/editor-style.css',
        array(),
        '1.0.0'
    );
}
add_action('enqueue_block_editor_assets', 'stapp_wp_theme_block_editor_assets');
