<?php
/**
 * Template part for displaying footer info
 *
 * @package STApp_WP_Theme
 */
?>

<div class="site-info">
    <p>
        <?php
        $copyright_text = get_theme_mod('stapp_wp_footer_copyright', '');
        if ($copyright_text) {
            $copyright_text = str_replace('{year}', date('Y'), $copyright_text);
            $copyright_text = str_replace('{sitename}', get_bloginfo('name'), $copyright_text);
            echo wp_kses_post($copyright_text);
        } else {
            echo '&copy; ' . date('Y') . ' ' . get_bloginfo('name');
        }
        ?>
    </p>
</div>
