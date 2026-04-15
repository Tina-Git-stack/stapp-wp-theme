<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package STApp_WP_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue scripts and styles
 */
function stapp_wp_theme_scripts() {
    // 1. Base (Fundament)
    wp_enqueue_style('stapp-wp-base', get_template_directory_uri() . '/assets/css/base.css', array(), '1.0.0');

    // 2. Layout (Struktur)
    wp_enqueue_style('stapp-wp-layout', get_template_directory_uri() . '/assets/css/layout.css', array('stapp-wp-base'), '1.0.0');

    // 3. Components (Bausteine)
    wp_enqueue_style('stapp-wp-components', get_template_directory_uri() . '/assets/css/components.css', array('stapp-wp-layout'), '1.0.0');

    // 4. Blocks (Editor-Integration)
    wp_enqueue_style('stapp-wp-blocks', get_template_directory_uri() . '/assets/css/blocks.css', array('stapp-wp-components'), '1.0.0');

    // 5. Hero Section
    wp_enqueue_style('stapp-wp-hero', get_template_directory_uri() . '/assets/css/hero.css', array('stapp-wp-blocks'), '1.0.0');

    // 6. Theme-Stylesheet (für WordPress-Erkennung)
    wp_enqueue_style('stapp-wp-theme-style', get_stylesheet_uri(), array('stapp-wp-hero'), '1.0.0');

    // Main JavaScript
    wp_enqueue_script('stapp-wp-theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

    // Quality Line Animation
    wp_enqueue_script('stapp-wp-quality-line', get_template_directory_uri() . '/assets/js/quality-line.js', array(), '1.0.0', true);

    // Comment Reply Script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'stapp_wp_theme_scripts');
