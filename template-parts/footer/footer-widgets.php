<?php
/**
 * Template part for displaying footer widgets
 *
 * @package Stapp_Theme
 */
?>

<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3')) : ?>
    <div class="footer-widgets">
        <div class="footer-widget-area">
            <?php dynamic_sidebar('footer-1'); ?>
        </div>
        <div class="footer-widget-area">
            <?php dynamic_sidebar('footer-2'); ?>
        </div>
        <div class="footer-widget-area">
            <?php dynamic_sidebar('footer-3'); ?>
        </div>
    </div>
<?php endif; ?>
