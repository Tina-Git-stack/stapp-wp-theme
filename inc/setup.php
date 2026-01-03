<?php
/**
 * Theme Setup Functions
 *
 * @package Stapp_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function stapp_theme_setup() {
    // Theme-Unterstützung für verschiedene Features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    // Block Editor Features
    add_theme_support('wp-block-styles');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style(array(
        'assets/css/base.css',
        'assets/css/layout.css',
        'assets/css/components.css',
        'assets/css/blocks.css'
    ));

    // Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primäres Menü', 'stapp-theme'),
        'footer'  => __('Footer Menü', 'stapp-theme'),
    ));

    // Theme-Textdomain für Übersetzungen laden
    load_theme_textdomain('stapp-theme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'stapp_theme_setup');

/**
 * Content Width
 *
 * Hinweis: Moderne Hybrid-Themes nutzen oft CSS + align-wide statt $content_width.
 * Wert muss zu Layout-Breiten passen (siehe assets/css/layout.css .container)
 */
if (!isset($content_width)) {
    $content_width = 1200; // Entspricht .container max-width
}

/**
 * Add custom image sizes
 */
function stapp_theme_custom_image_sizes() {
    add_image_size('stapp-featured', 800, 450, true);
    add_image_size('stapp-thumbnail', 400, 300, true);
}
add_action('after_setup_theme', 'stapp_theme_custom_image_sizes');

/**
 * Add custom image size names
 */
function stapp_theme_custom_image_size_names($sizes) {
    return array_merge($sizes, array(
        'stapp-featured'  => __('Featured (800x450)', 'stapp-theme'),
        'stapp-thumbnail' => __('Thumbnail (400x300)', 'stapp-theme'),
    ));
}
add_filter('image_size_names_choose', 'stapp_theme_custom_image_size_names');
