<?php
/**
 * Helper Functions
 *
 * @package Stapp_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

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
 * Add custom body classes
 */
function stapp_theme_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'singular';
    }

    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'stapp_theme_body_classes');

/**
 * Add preconnect for Google Fonts
 */
function stapp_theme_resource_hints($urls, $relation_type) {
    if (wp_style_is('stapp-theme-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'stapp_theme_resource_hints', 10, 2);

/**
 * Custom Read More Link
 */
function stapp_theme_read_more_link() {
    return '... <a class="read-more" href="' . get_permalink() . '">' . __('Weiterlesen', 'stapp-theme') . '</a>';
}
add_filter('the_content_more_link', 'stapp_theme_read_more_link');

/**
 * Pagination
 */
function stapp_theme_pagination() {
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => __('&laquo; Zurück', 'stapp-theme'),
        'next_text' => __('Weiter &raquo;', 'stapp-theme'),
    ));
}

/**
 * Breadcrumbs
 */
function stapp_theme_breadcrumbs() {
    if (!is_front_page()) {
        echo '<nav class="breadcrumbs">';
        echo '<a href="' . home_url('/') . '">' . __('Start', 'stapp-theme') . '</a> &raquo; ';

        if (is_category() || is_single()) {
            the_category(' &bull; ');
            if (is_single()) {
                echo ' &raquo; ';
                the_title();
            }
        } elseif (is_page()) {
            echo the_title();
        } elseif (is_search()) {
            echo __('Suchergebnisse für...', 'stapp-theme') . ' "' . get_search_query() . '"';
        }

        echo '</nav>';
    }
}
