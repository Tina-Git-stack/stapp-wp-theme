<?php
/**
 * The template for displaying comments
 *
 * @package STApp_WP_Theme
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('Ein Kommentar zu &ldquo;%1$s&rdquo;', 'stapp-wp-theme'),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            } else {
                printf(
                    esc_html(_nx(
                        '%1$s Kommentar zu &ldquo;%2$s&rdquo;',
                        '%1$s Kommentare zu &ldquo;%2$s&rdquo;',
                        $comment_count,
                        'comments title',
                        'stapp-wp-theme'
                    )),
                    number_format_i18n($comment_count),
                    '<span>' . wp_kses_post(get_the_title()) . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 60,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
            ?>
            <p class="no-comments"><?php esc_html_e('Die Kommentare sind geschlossen.', 'stapp-wp-theme'); ?></p>
        <?php
        endif;

    endif;

    comment_form();
    ?>

</div>
