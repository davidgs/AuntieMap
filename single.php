<?php
/**
 * The template for displaying all single posts
 *
 * @package AuntieMap
 * @since 1.0.0
 */

get_header(); ?>

<div class="container">
    <div class="single-layout">
        <main class="single-content">
            <?php while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('single-article'); ?>>

                    <header class="single-header">
                        <div class="post-meta">
                            <span class="post-date">
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date(); ?>
                                </time>
                            </span>

                            <?php if (get_post_type() === 'recovery_story') : ?>
                                <span class="post-type-badge recovery-story">
                                    <?php esc_html_e('Recovery Story', 'auntie-map'); ?>
                                </span>
                            <?php endif; ?>

                            <span class="post-author">
                                <?php esc_html_e('by', 'auntie-map'); ?>
                                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                    <?php the_author(); ?>
                                </a>
                            </span>

                            <?php if (has_category()) : ?>
                                <span class="post-categories">
                                    <?php the_category(', '); ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h1 class="single-title"><?php the_title(); ?></h1>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="single-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                    </header>

                    <div class="single-content-area">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'auntie-map'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <?php if (has_tag()) : ?>
                        <footer class="single-footer">
                            <div class="post-tags">
                                <h3><?php esc_html_e('Tags:', 'auntie-map'); ?></h3>
                                <?php the_tags('<span class="tag-list">', ', ', '</span>'); ?>
                            </div>
                        </footer>
                    <?php endif; ?>

                    <!-- Recovery Support Section for Recovery Stories -->
                    <?php if (get_post_type() === 'recovery_story') : ?>
                        <div class="recovery-story-support">
                            <div class="support-message">
                                <h3><?php esc_html_e('Inspired by this story?', 'auntie-map'); ?></h3>
                                <p><?php esc_html_e('Remember that recovery is possible for everyone. If you\'re struggling, please reach out for help.', 'auntie-map'); ?></p>

                                <div class="support-actions">
                                    <a href="tel:988" class="btn btn-primary">
                                        <?php esc_html_e('Crisis Support: 988', 'auntie-map'); ?>
                                    </a>
                                    <a href="https://www.aa.org/find-aa" target="_blank" rel="noopener" class="btn btn-secondary">
                                        <?php esc_html_e('Find AA Meetings', 'auntie-map'); ?>
                                    </a>
                                </div>
                            </div>

                            <div class="daily-affirmation">
                                <h4><?php esc_html_e('Today\'s Affirmation', 'auntie-map'); ?></h4>
                                <blockquote>"<?php echo esc_html(auntie_map_get_daily_affirmation()); ?>"</blockquote>
                            </div>
                        </div>
                    <?php endif; ?>

                </article>

                <!-- Post Navigation -->
                <nav class="post-navigation" role="navigation" aria-label="<?php esc_attr_e('Post Navigation', 'auntie-map'); ?>">
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();

                        if ($prev_post) :
                        ?>
                            <div class="nav-previous">
                                <a href="<?php echo get_permalink($prev_post->ID); ?>" rel="prev">
                                    <span class="nav-subtitle"><?php esc_html_e('Previous', 'auntie-map'); ?></span>
                                    <span class="nav-title"><?php echo get_the_title($prev_post->ID); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($next_post) : ?>
                            <div class="nav-next">
                                <a href="<?php echo get_permalink($next_post->ID); ?>" rel="next">
                                    <span class="nav-subtitle"><?php esc_html_e('Next', 'auntie-map'); ?></span>
                                    <span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </nav>

                <!-- Related Posts -->
                <?php
                $related_posts = get_posts(array(
                    'category__in' => wp_get_post_categories($post->ID),
                    'numberposts'  => 3,
                    'post__not_in' => array($post->ID),
                    'post_type'    => get_post_type(),
                ));

                if ($related_posts) :
                ?>
                    <section class="related-posts">
                        <h3><?php esc_html_e('Related Posts', 'auntie-map'); ?></h3>
                        <div class="related-posts-grid">
                            <?php foreach ($related_posts as $related_post) : ?>
                                <article class="related-post">
                                    <?php if (has_post_thumbnail($related_post->ID)) : ?>
                                        <div class="related-thumbnail">
                                            <a href="<?php echo get_permalink($related_post->ID); ?>">
                                                <?php echo get_the_post_thumbnail($related_post->ID, 'medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="related-content">
                                        <h4>
                                            <a href="<?php echo get_permalink($related_post->ID); ?>">
                                                <?php echo get_the_title($related_post->ID); ?>
                                            </a>
                                        </h4>
                                        <div class="related-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt($related_post->ID), 15, '...'); ?>
                                        </div>
                                        <a href="<?php echo get_permalink($related_post->ID); ?>" class="read-more">
                                            <?php esc_html_e('Read More', 'auntie-map'); ?> →
                                        </a>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Comments -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <div class="single-comments">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>

            <?php endwhile; ?>
        </main>

        <?php if (is_active_sidebar('sidebar-1')) : ?>
            <aside class="single-sidebar" role="complementary">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside>
        <?php endif; ?>
    </div>
</div>

<style>
/* Single post template styles */
.single-layout {
    display: flex;
    gap: 2rem;
    margin: 2rem 0;
}

.single-content {
    flex: 1;
}

.single-article {
    background: var(--white);
    padding: 2rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.single-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--light-purple);
}

.post-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    color: var(--text-light);
}

.post-type-badge {
    background: var(--accent-purple);
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.single-title {
    color: var(--dark-purple);
    margin-bottom: 1rem;
    font-size: 2.5rem;
    line-height: 1.2;
}

.single-thumbnail {
    margin-top: 1rem;
}

.single-thumbnail img {
    width: 100%;
    height: auto;
    border-radius: 0.5rem;
}

.single-content-area {
    line-height: 1.8;
    font-size: 1.125rem;
}

.single-content-area h2,
.single-content-area h3,
.single-content-area h4,
.single-content-area h5,
.single-content-area h6 {
    color: var(--dark-purple);
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.single-content-area p {
    margin-bottom: 1.5rem;
}

.single-content-area blockquote {
    background: var(--light-purple);
    border-left: 4px solid var(--primary-purple);
    padding: 1.5rem;
    margin: 2rem 0;
    border-radius: 0 0.5rem 0.5rem 0;
    font-style: italic;
    font-size: 1.25rem;
}

.single-footer {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-gray);
}

.post-tags h3 {
    margin-bottom: 1rem;
    color: var(--dark-purple);
}

.tag-list a {
    display: inline-block;
    background: var(--light-purple);
    color: var(--primary-purple);
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.875rem;
    text-decoration: none;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.tag-list a:hover {
    background: var(--primary-purple);
    color: var(--white);
}

/* Recovery Story Support Section */
.recovery-story-support {
    background: linear-gradient(135deg, var(--primary-purple), var(--secondary-purple));
    color: var(--white);
    padding: 2rem;
    border-radius: 1rem;
    margin-top: 2rem;
    text-align: center;
}

.recovery-story-support h3,
.recovery-story-support h4 {
    color: var(--white);
    margin-bottom: 1rem;
}

.support-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin: 2rem 0;
    flex-wrap: wrap;
}

.support-actions .btn {
    background: var(--white);
    color: var(--primary-purple);
}

.support-actions .btn:hover {
    background: var(--light-purple);
}

.daily-affirmation {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid rgba(255, 255, 255, 0.3);
}

.daily-affirmation blockquote {
    background: rgba(255, 255, 255, 0.1);
    border-left: 4px solid var(--white);
    color: var(--white);
    font-size: 1.125rem;
}

/* Post Navigation */
.post-navigation {
    background: var(--light-gray);
    padding: 2rem;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
}

.nav-links {
    display: flex;
    justify-content: space-between;
    gap: 2rem;
}

.nav-previous,
.nav-next {
    flex: 1;
}

.nav-next {
    text-align: right;
}

.nav-links a {
    display: block;
    padding: 1rem;
    background: var(--white);
    border-radius: 0.5rem;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.nav-links a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.nav-subtitle {
    display: block;
    font-size: 0.875rem;
    color: var(--text-light);
    margin-bottom: 0.5rem;
}

.nav-title {
    display: block;
    color: var(--dark-purple);
    font-weight: 600;
}

/* Related Posts */
.related-posts {
    background: var(--light-gray);
    padding: 2rem;
    border-radius: 0.75rem;
    margin-bottom: 2rem;
}

.related-posts h3 {
    color: var(--dark-purple);
    margin-bottom: 2rem;
    text-align: center;
}

.related-posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.related-post {
    background: var(--white);
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.related-post:hover {
    transform: translateY(-3px);
}

.related-thumbnail img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.related-content {
    padding: 1rem;
}

.related-content h4 a {
    color: var(--dark-purple);
    text-decoration: none;
}

.related-content h4 a:hover {
    color: var(--primary-purple);
}

.related-excerpt {
    color: var(--text-light);
    font-size: 0.875rem;
    margin: 0.5rem 0;
}

.read-more {
    color: var(--primary-purple);
    font-weight: 600;
    text-decoration: none;
    font-size: 0.875rem;
}

.single-sidebar {
    flex: 0 0 300px;
}

.single-comments {
    background: var(--light-gray);
    padding: 2rem;
    border-radius: 0.75rem;
    margin-top: 2rem;
}

/* Responsive design */
@media (max-width: 768px) {
    .single-layout {
        flex-direction: column;
    }

    .single-sidebar {
        flex: none;
    }

    .single-article {
        padding: 1.5rem;
    }

    .single-title {
        font-size: 2rem;
    }

    .nav-links {
        flex-direction: column;
    }

    .nav-next {
        text-align: left;
    }

    .support-actions {
        flex-direction: column;
        align-items: center;
    }

    .related-posts-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
