<?php
/**
 * Template Name: Volle Breite
 * Template Post Type: page
 *
 * @package STApp_WP_Theme
 */

get_header();
?>

<main id="primary" class="site-main fullwidth">
    <div class="container-wide">
        <?php
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/content/content', 'page');

            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
