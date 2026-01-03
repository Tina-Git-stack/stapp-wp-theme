<?php
/**
 * The template for displaying single posts
 *
 * @package Stapp_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();

            get_template_part('template-parts/content/content', 'single');

            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Vorheriger Beitrag:', 'stapp-theme') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Nächster Beitrag:', 'stapp-theme') . '</span> <span class="nav-title">%title</span>',
            ));

            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_sidebar();
get_footer();
