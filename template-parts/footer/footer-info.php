<?php
/**
 * Template part for displaying footer info
 *
 * @package Stapp_Theme
 */
?>

<div class="site-info">
    <p>
        &copy; <?php echo date('Y'); ?>
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php bloginfo('name'); ?>
        </a>
        <?php
        printf(
            esc_html__('| Powered by %s', 'stapp-theme'),
            '<a href="https://wordpress.org/">WordPress</a>'
        );
        ?>
    </p>
</div>
