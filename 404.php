<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Stapp_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e('Oops! Diese Seite wurde nicht gefunden.', 'stapp-theme'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e('Es sieht so aus, als ob hier nichts gefunden wurde. Vielleicht hilft eine Suche?', 'stapp-theme'); ?></p>

                <?php get_search_form(); ?>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
