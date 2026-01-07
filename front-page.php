<?php
/**
 * The template for displaying the front page (Homepage)
 *
 * @package Stapp_Theme
 */

get_header();
?>
 <div style="background:#000; padding:40px">
  <?php include get_stylesheet_directory() . '/assets/quality-line.svg'; ?>
</div>
<main id="primary" class="site-main">
   
<?php
    while (have_posts()) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer();
