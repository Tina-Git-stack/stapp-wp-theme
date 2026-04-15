<?php
/**
 * The header template
 *
 * @package STApp_WP_Theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="bg-quality-line">
    <?php
    $svg_file = get_template_directory() . '/assets/quality-line.svg';
    if (file_exists($svg_file)) {
        // Suppress any potential warnings and output the SVG
        $svg_content = @file_get_contents($svg_file);
        if ($svg_content !== false) {
            echo $svg_content;
        }
    }
    ?>
</div>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Zum Inhalt springen', 'stapp-wp-theme'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <?php get_template_part('template-parts/header/site-branding'); ?>
            <?php get_template_part('template-parts/header/site-navigation'); ?>
        </div>
    </header>
