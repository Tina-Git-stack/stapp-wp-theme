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
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // 1. Base (Fundament)
    wp_enqueue_style('stapp-wp-base', $theme_uri . '/assets/css/base.css', array(), filemtime($theme_dir . '/assets/css/base.css'));

    // 2. Layout (Struktur)
    wp_enqueue_style('stapp-wp-layout', $theme_uri . '/assets/css/layout.css', array('stapp-wp-base'), filemtime($theme_dir . '/assets/css/layout.css'));

    // 3. Components (Bausteine)
    wp_enqueue_style('stapp-wp-components', $theme_uri . '/assets/css/components.css', array('stapp-wp-layout'), filemtime($theme_dir . '/assets/css/components.css'));

    // 4. Blocks (Editor-Integration)
    wp_enqueue_style('stapp-wp-blocks', $theme_uri . '/assets/css/blocks.css', array('stapp-wp-components'), filemtime($theme_dir . '/assets/css/blocks.css'));

    // 5. Hero Section
    wp_enqueue_style('stapp-wp-hero', $theme_uri . '/assets/css/hero.css', array('stapp-wp-blocks'), filemtime($theme_dir . '/assets/css/hero.css'));

    // 6. Theme-Stylesheet (für WordPress-Erkennung)
    wp_enqueue_style('stapp-wp-theme-style', get_stylesheet_uri(), array('stapp-wp-hero'), filemtime($theme_dir . '/style.css'));

    // Main JavaScript
    wp_enqueue_script('stapp-wp-theme-script', $theme_uri . '/assets/js/main.js', array('jquery'), filemtime($theme_dir . '/assets/js/main.js'), true);

    // Quality Line Animation
    wp_enqueue_script('stapp-wp-quality-line', $theme_uri . '/assets/js/quality-line.js', array(), filemtime($theme_dir . '/assets/js/quality-line.js'), true);

    // Comment Reply Script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'stapp_wp_theme_scripts');
