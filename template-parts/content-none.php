<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Stapp_Theme
 */
?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title"><?php esc_html_e('Nichts gefunden', 'stapp-theme'); ?></h1>
    </header>

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) :
            printf(
                '<p>' . wp_kses(
                    __('Bereit, deinen ersten Beitrag zu veröffentlichen? <a href="%1$s">Leg los</a>.', 'stapp-theme'),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url(admin_url('post-new.php'))
            );

        elseif (is_search()) :
            ?>
            <p><?php esc_html_e('Es tut uns leid, aber deine Suche ergab keine Treffer. Bitte versuche es mit anderen Suchbegriffen.', 'stapp-theme'); ?></p>
            <?php
            get_search_form();

        else :
            ?>
            <p><?php esc_html_e('Es scheint, dass wir das Gesuchte nicht finden können. Vielleicht hilft eine Suche.', 'stapp-theme'); ?></p>
            <?php
            get_search_form();

        endif;
        ?>
    </div>
</section>
