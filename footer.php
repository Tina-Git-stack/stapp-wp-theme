<?php
/**
 * The footer template
 *
 * @package STApp_WP_Theme
 */
?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <?php get_template_part('template-parts/footer/footer-widgets'); ?>
            <?php get_template_part('template-parts/footer/footer-info'); ?>
            <?php get_template_part('template-parts/footer/footer-navigation'); ?>
        </div>
    </footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
