<?php
/**
 * Template part for displaying site navigation
 *
 * @package Stapp_Theme
 */
?>

<nav id="site-navigation" class="main-navigation">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <?php esc_html_e('Menü', 'stapp-theme'); ?>
    </button>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'container'      => false,
    ));
    ?>
</nav>
