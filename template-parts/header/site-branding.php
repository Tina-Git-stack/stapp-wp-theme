<?php
/**
 * Template part for displaying site branding
 *
 * @package Stapp_Theme
 */
?>

<div class="site-branding">
    <?php
    if (has_custom_logo()) :
        the_custom_logo();
    else :
        ?>
        <h1 class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <?php bloginfo('name'); ?>
            </a>
        </h1>
        <?php
        $description = get_bloginfo('description', 'display');
        if ($description || is_customize_preview()) :
            ?>
            <p class="site-description"><?php echo $description; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</div>
