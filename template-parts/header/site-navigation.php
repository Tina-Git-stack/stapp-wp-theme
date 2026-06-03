<?php
/**
 * Template part for displaying site navigation
 *
 * @package STApp_WP_Theme
 */
?>

<nav id="site-navigation" class="main-navigation">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>
    <button class="mobile-menu-close" aria-label="<?php esc_attr_e('Menü schließen', 'stapp-wp-theme'); ?>">&times;</button>
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'primary-menu',
        'container'      => false,
    ));
    ?>
</nav>
<div class="mobile-menu-overlay"></div>
