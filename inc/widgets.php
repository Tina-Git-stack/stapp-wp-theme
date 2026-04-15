<?php
/**
 * Widget Areas
 *
 * @package STApp_WP_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register widget areas
 */
function stapp_wp_theme_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'stapp-wp-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Haupt-Sidebar-Widget-Bereich', 'stapp-wp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 1', 'stapp-wp-theme'),
        'id'            => 'footer-1',
        'description'   => __('Footer Widget-Bereich 1', 'stapp-wp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 2', 'stapp-wp-theme'),
        'id'            => 'footer-2',
        'description'   => __('Footer Widget-Bereich 2', 'stapp-wp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget 3', 'stapp-wp-theme'),
        'id'            => 'footer-3',
        'description'   => __('Footer Widget-Bereich 3', 'stapp-wp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'stapp_wp_theme_widgets_init');
