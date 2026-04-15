<?php
/**
 * STApp WP Theme Functions
 *
 * @package STApp_WP_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme Setup
require_once get_template_directory() . '/inc/setup.php';

// Scripts & Styles
require_once get_template_directory() . '/inc/enqueue.php';

// Widget Areas
require_once get_template_directory() . '/inc/widgets.php';

// Helper Functions
require_once get_template_directory() . '/inc/helpers.php';

// Template Tags
require_once get_template_directory() . '/inc/template-tags.php';

// Block Customization
require_once get_template_directory() . '/inc/blocks.php';

// Customizer
require_once get_template_directory() . '/inc/customizer.php';
