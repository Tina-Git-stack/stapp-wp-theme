<?php
/**
 * Widget Areas
 *
 * @package Stapp_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register widget areas
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
