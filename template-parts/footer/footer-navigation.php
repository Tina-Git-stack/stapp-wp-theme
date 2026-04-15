<?php
/**
 * Template part for displaying footer navigation
 *
 * @package STApp_WP_Theme
 */
?>

<?php
if (has_nav_menu('footer')) :
    wp_nav_menu(array(
        'theme_location' => 'footer',
        'menu_id'        => 'footer-menu',
        'container'      => 'nav',
        'container_class' => 'footer-navigation',
        'depth'          => 1,
    ));
endif;
?>
