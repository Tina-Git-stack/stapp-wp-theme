<?php
/**
 * The template for displaying search results
 *
 * @package Stapp_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    printf(
                        esc_html__('Suchergebnisse für: %s', 'stapp-theme'),
                        '<span>' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header>

            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content/content', 'search');
            endwhile;

            the_posts_navigation();

        else :
            get_template_part('template-parts/content/content', 'none');
        endif;
        ?>
    </div>
</main>

<?php
get_sidebar();
get_footer();
