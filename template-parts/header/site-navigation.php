<?php
/**
 * Template part for displaying site navigation
 *
 * @package STApp_WP_Theme
 */
?>

<nav id="site-navigation" class="main-navigation">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <?php esc_html_e('Menü', 'stapp-wp-theme'); ?>
    </button>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'container'      => false,
    ));
    ?>
</nav>
