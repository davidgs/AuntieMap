<?php
/**
 * The template for displaying single recovery stories
 *
 * @package AuntieMap
 * @since 1.0.0
 */

get_header(); ?>

<div class="container">
    <div class="recovery-story-layout">
        <main class="story-content">
            <?php while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('recovery-story-article'); ?>>

                    <header class="story-header">
                        <div class="story-meta">
                            <span class="story-badge">
                                <?php esc_html_e('Recovery Story', 'auntie-map'); ?>
                            </span>
                            <span class="story-date">
                                <time datetime="<?php echo get_the_date('c'); ?>">
                                    <?php echo get_the_date(); ?>
                                </time>
                            </span>
                        </div>

                        <h1 class="story-title"><?php the_title(); ?></h1>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="story-featured-image">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="story-introduction">
                            <p class="story-disclaimer">
                                <em><?php esc_html_e('The following is a personal recovery story shared with permission. Names may have been changed to protect privacy. Every recovery journey is unique.', 'auntie-map'); ?></em>
                            </p>
                        </div>
                    </header>

                    <div class="story-content-area">
                        <?php
                        the_content();

                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'auntie-map'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>

                    <!-- Recovery Milestones -->
                    <?php
                    $recovery_date = get_post_meta(get_the_ID(), 'recovery_start_date', true);
                    if ($recovery_date) :
                        $start_date = new DateTime($recovery_date);
                        $current_date = new DateTime();
                        $diff = $current_date->diff($start_date);
                        $days_sober = $diff->days;
                    ?>
                        <div class="story-milestone">
                            <h3><?php esc_html_e('Recovery Milestone', 'auntie-map'); ?></h3>
                            <div class="milestone-display">
                                <div class="milestone-number"><?php echo $days_sober; ?></div>
                                <div class="milestone-label">
                                    <?php echo $days_sober === 1 ? esc_html__('Day Sober', 'auntie-map') : esc_html__('Days Sober', 'auntie-map'); ?>
                                </div>
                                <div class="milestone-message">
                                    <?php echo esc_html(auntie_map_get_milestone_message($days_sober)); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Story Tags -->
                    <?php if (has_tag()) : ?>
                        <footer class="story-footer">
                            <div class="story-tags">
                                <h3><?php esc_html_e('Story Themes:', 'auntie-map'); ?></h3>
                                <?php the_tags('<span class="tag-list">', ', ', '</span>'); ?>
                            </div>
                        </footer>
                    <?php endif; ?>

                </article>

                <!-- Recovery Support Section -->
                <section class="story-recovery-support">
                    <div class="support-content">
                        <h2><?php esc_html_e('Inspired by this story?', 'auntie-map'); ?></h2>
                        <p><?php esc_html_e('Remember that recovery is possible for everyone. Every journey is unique, and every day is a new opportunity for growth and healing.', 'auntie-map'); ?></p>

                        <div class="support-grid">
                            <div class="support-card">
                                <div class="support-icon">🤝</div>
                                <h4><?php esc_html_e('Find Support', 'auntie-map'); ?></h4>
                                <p><?php esc_html_e('Connect with local recovery meetings and support groups.', 'auntie-map'); ?></p>
                                <a href="https://www.aa.org/find-aa" target="_blank" rel="noopener" class="support-btn">
                                    <?php esc_html_e('Find AA Meetings', 'auntie-map'); ?>
                                </a>
                            </div>

                            <div class="support-card">
                                <div class="support-icon">📞</div>
                                <h4><?php esc_html_e('Crisis Support', 'auntie-map'); ?></h4>
                                <p><?php esc_html_e('If you\'re struggling, help is available 24/7.', 'auntie-map'); ?></p>
                                <a href="tel:988" class="support-btn emergency">
                                    <?php esc_html_e('Call 988', 'auntie-map'); ?>
                                </a>
                            </div>

                            <div class="support-card">
                                <div class="support-icon">💜</div>
                                <h4><?php esc_html_e('Share Your Story', 'auntie-map'); ?></h4>
                                <p><?php esc_html_e('Your story could inspire others on their recovery journey.', 'auntie-map'); ?></p>
                                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="support-btn">
                                    <?php esc_html_e('Share Your Story', 'auntie-map'); ?>
                                </a>
                            </div>
                        </div>

                        <div class="daily-affirmation-story">
                            <h3><?php esc_html_e('Today\'s Affirmation', 'auntie-map'); ?></h3>
                            <blockquote>"<?php echo esc_html(auntie_map_get_daily_affirmation()); ?>"</blockquote>
                        </div>
                    </div>
                </section>

                <!-- Related Stories -->
                <?php
                $related_stories = get_posts(array(
                    'post_type' => 'recovery_story',
                    'numberposts' => 3,
                    'post__not_in' => array($post->ID),
                    'meta_query' => array(
                        array(
                            'key' => 'featured_story',
                            'value' => '1',
                            'compare' => '='
                        )
                    )
                ));

                if (empty($related_stories)) {
                    $related_stories = get_posts(array(
                        'post_type' => 'recovery_story',
                        'numberposts' => 3,
                        'post__not_in' => array($post->ID),
                        'orderby' => 'rand'
                    ));
                }

                if ($related_stories) :
                ?>
                    <section class="related-stories">
                        <h2><?php esc_html_e('More Recovery Stories', 'auntie-map'); ?></h2>
                        <div class="related-stories-grid">
                            <?php foreach ($related_stories as $related_story) : ?>
                                <article class="related-story">
                                    <?php if (has_post_thumbnail($related_story->ID)) : ?>
                                        <div class="related-story-image">
                                            <a href="<?php echo get_permalink($related_story->ID); ?>">
                                                <?php echo get_the_post_thumbnail($related_story->ID, 'medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="related-story-content">
                                        <h3>
                                            <a href="<?php echo get_permalink($related_story->ID); ?>">
                                                <?php echo get_the_title($related_story->ID); ?>
                                            </a>
                                        </h3>
                                        <div class="related-story-excerpt">
                                            <?php echo wp_trim_words(get_the_excerpt($related_story->ID), 20, '...'); ?>
                                        </div>
                                        <a href="<?php echo get_permalink($related_story->ID); ?>" class="read-story-link">
                                            <?php esc_html_e('Read Story', 'auntie-map'); ?> →
                                        </a>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <!-- Comments -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <div class="story-comments">
                        <h3><?php esc_html_e('Community Support', 'auntie-map'); ?></h3>
                        <p class="comments-note">
                            <em><?php esc_html_e('Share words of encouragement and support. Please be respectful and remember that recovery is a personal journey.', 'auntie-map'); ?></em>
                        </p>
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>

            <?php endwhile; ?>
        </main>

        <?php if (is_active_sidebar('sidebar-1')) : ?>
            <aside class="story-sidebar" role="complementary">
                <?php dynamic_sidebar('sidebar-1'); ?>

                <!-- Recovery Resources Widget -->
                <div class="widget recovery-resources-widget">
                    <h3 class="widget-title"><?php esc_html_e('Recovery Resources', 'auntie-map'); ?></h3>
                    <ul class="recovery-links">
                        <li><a href="https://www.aa.org/find-aa" target="_blank" rel="noopener"><?php esc_html_e('Find AA Meetings', 'auntie-map'); ?></a></li>
                        <li><a href="https://www.na.org/meetingsearch/" target="_blank" rel="noopener"><?php esc_html_e('Find NA Meetings', 'auntie-map'); ?></a></li>
                        <li><a href="https://www.samhsa.gov/find-help/national-helpline" target="_blank" rel="noopener"><?php esc_html_e('SAMHSA Helpline', 'auntie-map'); ?></a></li>
                        <li><a href="tel:988"><?php esc_html_e('Crisis Support: 988', 'auntie-map'); ?></a></li>
                    </ul>
                </div>

                <!-- Milestone Calculator Widget -->
                <div class="widget milestone-calculator">
                    <h3 class="widget-title"><?php esc_html_e('Calculate Your Milestone', 'auntie-map'); ?></h3>
                    <form class="milestone-form">
                        <label for="sobriety-date"><?php esc_html_e('Sobriety Date:', 'auntie-map'); ?></label>
                        <input type="date" id="sobriety-date" name="sobriety-date" required>
                        <button type="submit" class="btn btn-primary">
                            <?php esc_html_e('Calculate', 'auntie-map'); ?>
                        </button>
                    </form>
                    <div class="milestone-result" style="display: none;"></div>
                </div>
            </aside>
        <?php endif; ?>
    </div>
</div>

<style>
/* Recovery story template styles */
.recovery-story-layout {
    display: flex;
    gap: 2rem;
    margin: 2rem 0;
}

.story-content {
    flex: 1;
}

.recovery-story-article {
    background: var(--white);
    padding: 2rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.story-header {
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--light-purple);
}

.story-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    align-items: center;
}

.story-badge {
    background: linear-gradient(135deg, var(--primary-purple), var(--secondary-purple));
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.875rem;
    font-weight: 600;
}

.story-date {
    color: var(--text-light);
    font-size: 0.875rem;
}

.story-title {
    color: var(--dark-purple);
    font-size: 2.5rem;
    line-height: 1.2;
    margin-bottom: 1rem;
}

.story-featured-image {
    margin: 1rem 0;
}

.story-featured-image img {
    width: 100%;
    height: auto;
    border-radius: 0.5rem;
}

.story-disclaimer {
    background: var(--light-purple);
    padding: 1rem;
    border-radius: 0.5rem;
    border-left: 4px solid var(--primary-purple);
    color: var(--primary-purple);
    font-size: 0.875rem;
}

.story-content-area {
    line-height: 1.8;
    font-size: 1.125rem;
}

.story-content-area h2,
.story-content-area h3,
.story-content-area h4 {
    color: var(--dark-purple);
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.story-content-area p {
    margin-bottom: 1.5rem;
}

.story-content-area blockquote {
    background: var(--light-purple);
    border-left: 4px solid var(--primary-purple);
    padding: 1.5rem;
    margin: 2rem 0;
    border-radius: 0 0.5rem 0.5rem 0;
    font-style: italic;
    font-size: 1.25rem;
    color: var(--primary-purple);
}

.story-milestone {
    background: linear-gradient(135deg, var(--primary-purple), var(--secondary-purple));
    color: var(--white);
    padding: 2rem;
    border-radius: 1rem;
    text-align: center;
    margin: 2rem 0;
}

.story-milestone h3 {
    color: var(--white);
    margin-bottom: 1rem;
}

.milestone-display {
    background: rgba(255, 255, 255, 0.1);
    padding: 1.5rem;
    border-radius: 0.75rem;
}

.milestone-number {
    font-size: 4rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.milestone-label {
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.milestone-message {
    font-size: 1.25rem;
    font-style: italic;
}

.story-footer {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-gray);
}

.story-tags h3 {
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

.story-recovery-support {
    background: var(--light-gray);
    padding: 3rem;
    border-radius: 1rem;
    margin-bottom: 2rem;
    text-align: center;
}

.support-content h2 {
    color: var(--dark-purple);
    margin-bottom: 1rem;
}

.support-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin: 2rem 0;
}

.support-card {
    background: var(--white);
    padding: 2rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.support-card:hover {
    transform: translateY(-5px);
}

.support-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.support-card h4 {
    color: var(--dark-purple);
    margin-bottom: 1rem;
}

.support-card p {
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.support-btn {
    display: inline-block;
    background: var(--primary-purple);
    color: var(--white);
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.support-btn:hover {
    background: var(--dark-purple);
    color: var(--white);
    transform: translateY(-2px);
}

.support-btn.emergency {
    background: var(--error-red);
}

.support-btn.emergency:hover {
    background: #DC2626;
}

.daily-affirmation-story {
    background: linear-gradient(135deg, var(--primary-purple), var(--secondary-purple));
    color: var(--white);
    padding: 2rem;
    border-radius: 0.75rem;
    margin-top: 2rem;
}

.daily-affirmation-story h3 {
    color: var(--white);
    margin-bottom: 1rem;
}

.daily-affirmation-story blockquote {
    background: rgba(255, 255, 255, 0.1);
    border-left: 4px solid var(--white);
    color: var(--white);
    font-size: 1.25rem;
    margin: 1rem 0;
}

.related-stories {
    background: var(--white);
    padding: 2rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.related-stories h2 {
    color: var(--dark-purple);
    text-align: center;
    margin-bottom: 2rem;
}

.related-stories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.related-story {
    border: 1px solid var(--border-gray);
    border-radius: 0.5rem;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.related-story:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.related-story-image img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.related-story-content {
    padding: 1rem;
}

.related-story-content h3 a {
    color: var(--dark-purple);
    text-decoration: none;
    font-size: 1.125rem;
}

.related-story-content h3 a:hover {
    color: var(--primary-purple);
}

.related-story-excerpt {
    color: var(--text-light);
    font-size: 0.875rem;
    margin: 0.5rem 0;
}

.read-story-link {
    color: var(--primary-purple);
    font-weight: 600;
    text-decoration: none;
    font-size: 0.875rem;
}

.story-sidebar {
    flex: 0 0 300px;
}

.story-comments {
    background: var(--light-gray);
    padding: 2rem;
    border-radius: 0.75rem;
    margin-top: 2rem;
}

.story-comments h3 {
    color: var(--dark-purple);
    margin-bottom: 1rem;
}

.comments-note {
    color: var(--text-light);
    font-size: 0.875rem;
    margin-bottom: 2rem;
}

.recovery-resources-widget ul {
    list-style: none;
}

.recovery-resources-widget li {
    margin-bottom: 0.5rem;
}

.recovery-resources-widget a {
    color: var(--primary-purple);
    text-decoration: none;
    font-size: 0.875rem;
}

.recovery-resources-widget a:hover {
    color: var(--dark-purple);
}

.milestone-calculator {
    background: linear-gradient(135deg, var(--light-purple), var(--accent-purple));
}

.milestone-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.milestone-form label {
    font-weight: 600;
    color: var(--dark-purple);
}

.milestone-form input {
    padding: 0.5rem;
    border: 2px solid var(--border-gray);
    border-radius: 0.25rem;
}

.milestone-form button {
    padding: 0.75rem;
    border: none;
    border-radius: 0.5rem;
    background: var(--primary-purple);
    color: var(--white);
    font-weight: 600;
    cursor: pointer;
}

/* Responsive design */
@media (max-width: 768px) {
    .recovery-story-layout {
        flex-direction: column;
    }

    .story-sidebar {
        flex: none;
    }

    .recovery-story-article {
        padding: 1.5rem;
    }

    .story-title {
        font-size: 2rem;
    }

    .support-grid {
        grid-template-columns: 1fr;
    }

    .milestone-number {
        font-size: 3rem;
    }

    .milestone-label {
        font-size: 1.25rem;
    }

    .related-stories-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
