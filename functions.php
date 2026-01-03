<?php
/**
 * Stapp Theme Functions
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
    add_editor_style('assets/css/editor-style.css');

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
 */
if (!isset($content_width)) {
    $content_width = 1200;
}

/**
 * Widgets registrieren
 */
function stapp_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'stapp-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Haupt-Sidebar-Widget-Bereich', 'stapp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'stapp-theme'),
        'id'            => 'footer-1',
        'description'   => __('Footer Widget-Bereich 1', 'stapp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 2', 'stapp-theme'),
        'id'            => 'footer-2',
        'description'   => __('Footer Widget-Bereich 2', 'stapp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 3', 'stapp-theme'),
        'id'            => 'footer-3',
        'description'   => __('Footer Widget-Bereich 3', 'stapp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'stapp_theme_widgets_init');

/**
 * Scripts und Styles einbinden
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

/**
 * Custom Excerpt Length
 */
function stapp_theme_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'stapp_theme_excerpt_length');

/**
 * Custom Excerpt More
 */
function stapp_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'stapp_theme_excerpt_more');

/**
 * Custom Template Tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Functions
 */
require get_template_directory() . '/inc/custom-functions.php';
