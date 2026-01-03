<?php
/**
 * Custom functions for this theme
 *
 * @package Stapp_Theme
 */

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
