<?php
/**
 * The template for displaying comments
 *
 * @package AuntieMap
 * @since 1.0.0
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                printf(esc_html__('One comment on "%s"', 'auntie-map'), get_the_title());
            } else {
                printf(
                    esc_html(_nx('%1$s comment', '%1$s comments', $comments_number, 'comments title', 'auntie-map')),
                    number_format_i18n($comments_number)
                );
            }
            ?>
        </h3>

        <div class="comments-guidelines">
            <p><em><?php esc_html_e('Please be respectful and supportive in your comments. Remember that recovery is a personal journey and everyone\'s experience is different.', 'auntie-map'); ?></em></p>
        </div>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'auntie_map_comment_callback',
            ));
            ?>
        </ol>

        <?php
        the_comments_pagination(array(
            'prev_text' => '<span class="screen-reader-text">' . esc_html__('Previous Comments', 'auntie-map') . '</span>',
            'next_text' => '<span class="screen-reader-text">' . esc_html__('Next Comments', 'auntie-map') . '</span>',
        ));
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'auntie-map'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'         => esc_html__('Share your thoughts', 'auntie-map'),
        'title_reply_to'      => esc_html__('Reply to %s', 'auntie-map'),
        'cancel_reply_link'   => esc_html__('Cancel reply', 'auntie-map'),
        'label_submit'        => esc_html__('Post Comment', 'auntie-map'),
        'submit_button'       => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary" value="%4$s" />',
        'comment_field'       => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Your message of support or encouragement', 'auntie-map') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required placeholder="' . esc_attr__('Share words of encouragement, support, or your own experience...', 'auntie-map') . '"></textarea></p>',
        'comment_notes_before' => '<div class="comment-guidelines"><p>' . esc_html__('Your email address will not be published. Please be kind and supportive in your comments.', 'auntie-map') . '</p></div>',
        'comment_notes_after'  => '<div class="comment-support-note"><p><em>' . esc_html__('If you\'re struggling and need immediate help, please call 988 or visit your nearest emergency room.', 'auntie-map') . '</em></p></div>',
    ));
    ?>

</div>

<?php
/**
 * Custom comment callback function
 */
function auntie_map_comment_callback($comment, $args, $depth) {
    $tag = ($args['style'] === 'div') ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>

        <article class="comment-body">
            <header class="comment-meta">
                <div class="comment-author vcard">
                    <?php
                    if ($args['avatar_size'] != 0) {
                        echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'comment-avatar'));
                    }
                    ?>
                    <div class="comment-author-info">
                        <b class="fn"><?php comment_author(); ?></b>
                        <div class="comment-metadata">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php comment_date(); ?> <?php esc_html_e('at', 'auntie-map'); ?> <?php comment_time(); ?>
                            </time>
                            <?php if (get_comment_meta(get_comment_ID(), 'recovery_milestone', true)) : ?>
                                <span class="recovery-milestone-badge">
                                    <?php echo esc_html(get_comment_meta(get_comment_ID(), 'recovery_milestone', true)); ?> <?php esc_html_e('days sober', 'auntie-map'); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <div class="comment-awaiting-moderation">
                        <em><?php esc_html_e('Your comment is awaiting moderation.', 'auntie-map'); ?></em>
                    </div>
                <?php endif; ?>
            </header>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div>

            <footer class="comment-footer">
                <div class="comment-actions">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'add_below' => 'div-comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<span class="reply-link">',
                        'after'     => '</span>',
                    )));
                    ?>

                    <?php if (current_user_can('edit_comment', get_comment_ID())) : ?>
                        <span class="edit-link">
                            <?php edit_comment_link(esc_html__('Edit', 'auntie-map'), '<span class="edit-link">', '</span>'); ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="comment-support">
                    <span class="support-icon">💜</span>
                    <span class="support-text"><?php esc_html_e('Thank you for sharing', 'auntie-map'); ?></span>
                </div>
            </footer>
        </article>

    <?php
}

// Add custom CSS for comments
add_action('wp_head', function() {
    ?>
    <style>
    .comments-area {
        background: var(--white);
        padding: 2rem;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .comments-title {
        color: var(--dark-purple);
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .comments-guidelines {
        background: var(--light-purple);
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--primary-purple);
    }

    .comments-guidelines p {
        margin: 0;
        color: var(--primary-purple);
        font-size: 0.875rem;
    }

    .comment-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .comment-list li {
        margin-bottom: 2rem;
    }

    .comment-body {
        background: var(--light-gray);
        padding: 1.5rem;
        border-radius: 0.75rem;
        border-left: 4px solid var(--accent-purple);
    }

    .comment-meta {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .comment-avatar {
        border-radius: 50%;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .comment-author-info .fn {
        color: var(--dark-purple);
        font-size: 1.125rem;
    }

    .comment-metadata {
        color: var(--text-light);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .recovery-milestone-badge {
        background: var(--primary-purple);
        color: var(--white);
        padding: 0.125rem 0.5rem;
        border-radius: 1rem;
        font-size: 0.75rem;
        margin-left: 0.5rem;
    }

    .comment-awaiting-moderation {
        background: var(--warning-amber);
        color: var(--white);
        padding: 0.5rem;
        border-radius: 0.25rem;
        margin-top: 0.5rem;
        font-size: 0.875rem;
    }

    .comment-content {
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .comment-content p {
        margin-bottom: 1rem;
    }

    .comment-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--border-gray);
    }

    .comment-actions {
        display: flex;
        gap: 1rem;
    }

    .reply-link a,
    .edit-link a {
        color: var(--primary-purple);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .reply-link a:hover,
    .edit-link a:hover {
        color: var(--dark-purple);
    }

    .comment-support {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-light);
        font-size: 0.875rem;
    }

    .children {
        margin-top: 1rem;
        margin-left: 2rem;
    }

    .children .comment-body {
        background: var(--white);
        border-left-color: var(--light-purple);
    }

    /* Comment Form Styles */
    .comment-respond {
        background: var(--light-gray);
        padding: 2rem;
        border-radius: 0.75rem;
        margin-top: 2rem;
    }

    .comment-reply-title {
        color: var(--dark-purple);
        margin-bottom: 1rem;
    }

    .comment-guidelines {
        background: var(--light-purple);
        padding: 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--primary-purple);
    }

    .comment-form p {
        margin-bottom: 1rem;
    }

    .comment-form label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--dark-purple);
    }

    .comment-form input[type="text"],
    .comment-form input[type="email"],
    .comment-form input[type="url"],
    .comment-form textarea {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid var(--border-gray);
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .comment-form input:focus,
    .comment-form textarea:focus {
        outline: none;
        border-color: var(--primary-purple);
    }

    .comment-form textarea {
        resize: vertical;
        min-height: 120px;
    }

    .required {
        color: var(--error-red);
    }

    .comment-support-note {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid var(--error-red);
        padding: 1rem;
        border-radius: 0.5rem;
        margin-top: 1rem;
    }

    .comment-support-note p {
        margin: 0;
        color: var(--error-red);
        font-size: 0.875rem;
    }

    .no-comments {
        text-align: center;
        color: var(--text-light);
        font-style: italic;
        padding: 2rem;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .comments-area {
            padding: 1.5rem;
        }

        .comment-body {
            padding: 1rem;
        }

        .comment-meta {
            flex-direction: column;
        }

        .comment-avatar {
            margin-right: 0;
            margin-bottom: 0.5rem;
            align-self: center;
        }

        .comment-footer {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .children {
            margin-left: 1rem;
        }

        .comment-respond {
            padding: 1.5rem;
        }
    }
    </style>
    <?php
});
?>
