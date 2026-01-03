<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package Stapp_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue scripts and styles
 */
function stapp_theme_scripts() {
    // 1. Base (Fundament)
    wp_enqueue_style('stapp-base', get_template_directory_uri() . '/assets/css/base.css', array(), '1.0.0');

    // 2. Layout (Struktur)
    wp_enqueue_style('stapp-layout', get_template_directory_uri() . '/assets/css/layout.css', array('stapp-base'), '1.0.0');

    // 3. Components (Bausteine)
    wp_enqueue_style('stapp-components', get_template_directory_uri() . '/assets/css/components.css', array('stapp-layout'), '1.0.0');

    // 4. Blocks (Editor-Integration)
    wp_enqueue_style('stapp-blocks', get_template_directory_uri() . '/assets/css/blocks.css', array('stapp-components'), '1.0.0');

    // 5. Theme-Stylesheet (für WordPress-Erkennung)
    wp_enqueue_style('stapp-theme-style', get_stylesheet_uri(), array('stapp-blocks'), '1.0.0');

    // Main JavaScript
    wp_enqueue_script('stapp-theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

    // Comment Reply Script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'stapp_theme_scripts');
