<?php

/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Tenet
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>
<div class="show-comments mb-5">
    <a class="btn btn-primary"><?php esc_html_e('Show Comments', 'tenet') ?><i class="fa fa-chevron-down"></i></a>
</div>
<div class="container" id="comments">
    <div class="comments-area">

        <?php if (have_comments()) : ?>

            <h2 class="comments-title">

                <?php
                if (1 === (int) get_comments_number()) {
                    printf(
                        /* translators: %s: post title */
                        esc_html_x('One thought on &ldquo;%s&rdquo;', 'comments title', 'tenet'),
                        '<span>' . esc_html(get_the_title()) . '</span>'
                    );
                } else {
                    printf(
                        esc_html(
                            /* translators: 1: number of comments, 2: post title */
                            _nx(
                                '%1$s thought on &ldquo;%2$s&rdquo;',
                                '%1$s thoughts on &ldquo;%2$s&rdquo;',
                                get_comments_number(),
                                'comments title',
                                'tenet'
                            )
                        ),
                        number_format_i18n(get_comments_number()), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        '<span>' . esc_html(get_the_title()) . '</span>'
                    );
                }
                ?>

            </h2><!-- .comments-title -->

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through. 
            ?>

                <nav class="comment-navigation" id="comment-nav-above">

                    <h1 class="sr-only"><?php esc_html_e('Comment navigation', 'tenet') ?></h1>

                    <?php if (get_previous_comments_link()) { ?>
                        <div class="nav-previous">
                            <?php previous_comments_link(__('&larr; Older Comments', 'tenet')); ?>
                        </div>
                    <?php } ?>

                    <?php if (get_next_comments_link()) { ?>
                        <div class="nav-next">
                            <?php next_comments_link(__('Newer Comments &rarr;', 'tenet')); ?>
                        </div>
                    <?php } ?>

                </nav><!-- #comment-nav-above -->

            <?php endif; // Check for comment navigation. 
            ?>

            <ol class="comment-list">

                <?php
                wp_list_comments(
                    array(
                        'style'      => 'ol',
                        'short_ping' => true,
                    )
                );
                ?>

            </ol><!-- .comment-list -->

            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through. 
            ?>

                <nav class="comment-navigation" id="comment-nav-below">

                    <h1 class="sr-only"><?php esc_html_e('Comment navigation', 'tenet') ?></h1>

                    <?php if (get_previous_comments_link()) { ?>
                        <div class="nav-previous">
                            <?php
                            previous_comments_link(__('&larr; Older Comments', 'tenet'))
                            ?>
                        </div>
                    <?php } ?>

                    <?php if (get_next_comments_link()) { ?>
                        <div class="nav-next">
                            <?php next_comments_link(__('Newer Comments &rarr;', 'tenet')) ?>
                        </div>
                    <?php } ?>

                </nav><!-- #comment-nav-below -->

            <?php endif; // Check for comment navigation. 
            ?>

        <?php endif; // End of if have_comments(). 
        ?>

        <?php comment_form(); // Render comments form. 
        ?>
    </div>
</div><!-- #comments -->