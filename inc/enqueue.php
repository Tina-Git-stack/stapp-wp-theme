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
    // Main Stylesheet
    wp_enqueue_style('stapp-theme-style', get_stylesheet_uri(), array(), '1.0.0');

    // Custom Stylesheet
    wp_enqueue_style('stapp-theme-custom', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');

    // Main JavaScript
    wp_enqueue_script('stapp-theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

    // Comment Reply Script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'stapp_theme_scripts');
