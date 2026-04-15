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
    // Custom Block Style: Rounded (für Image Block)
    register_block_style('core/image', array(
        'name'  => 'rounded',
        'label' => __('Abgerundet', 'stapp-wp-theme'),
    ));

    // Custom Block Style: Shadow (für Group Block)
    register_block_style('core/group', array(
        'name'  => 'shadow',
        'label' => __('Mit Schatten', 'stapp-wp-theme'),
    ));

    // Custom Block Style: Hero Section (für Group Block)
    register_block_style('core/group', array(
        'name'  => 'hero-section',
        'label' => __('Hero Section', 'stapp-wp-theme'),
    ));
}
add_action('init', 'stapp_wp_theme_register_block_styles');

/**
 * Enqueue Block Editor Assets
 *
 * Für Editor-spezifische Styles (falls später nötig)
 */
function stapp_wp_theme_block_editor_assets() {
    // Editor-spezifische Styles (optional, falls .editor-styles-wrapper nötig)
    // wp_enqueue_style('stapp-editor-only', get_template_directory_uri() . '/assets/css/editor-only.css', array(), '1.0.0');
}
add_action('enqueue_block_editor_assets', 'stapp_wp_theme_block_editor_assets');
