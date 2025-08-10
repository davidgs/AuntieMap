<?php
/**
 * The main template file for Auntie MAP Recovery Store
 *
 * @package AuntieMap
 * @since 1.0.0
 */

get_header(); ?>

<div class="container">
    <div class="content-area">
        <?php if (have_posts()) : ?>

            <header class="page-header">
                <?php if (is_home() && !is_front_page()) : ?>
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                <?php elseif (is_archive()) : ?>
                    <h1 class="page-title">
                        <?php
                        if (is_category()) {
                            single_cat_title();
                        } elseif (is_tag()) {
                            single_tag_title();
                        } elseif (is_author()) {
                            echo 'Posts by ' . get_the_author();
                        } elseif (is_year()) {
                            echo 'Year: ' . get_the_date('Y');
                        } elseif (is_month()) {
                            echo 'Month: ' . get_the_date('F Y');
                        } elseif (is_day()) {
                            echo 'Day: ' . get_the_date();
                        } else {
                            echo 'Archives';
                        }
                        ?>
                    </h1>
                    <?php if (is_category() || is_tag()) : ?>
                        <div class="archive-description">
                            <?php echo term_description(); ?>
                        </div>
                    <?php endif; ?>
                <?php elseif (is_search()) : ?>
                    <h1 class="page-title">
                        <?php printf(esc_html__('Search Results for: %s', 'auntie-map'), '<span>' . get_search_query() . '</span>'); ?>
                    </h1>
                <?php endif; ?>
            </header>

            <div class="posts-container">
                <?php while (have_posts()) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                    <?php the_post_thumbnail('medium_large', array('alt' => get_the_title())); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="post-content">
                            <header class="post-header">
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>

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
                                </div>
                            </header>

                            <div class="post-excerpt">
                                <?php
                                if (has_excerpt()) {
                                    the_excerpt();
                                } else {
                                    echo wp_trim_words(get_the_content(), 30, '...');
                                }
                                ?>
                            </div>

                            <footer class="post-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more btn btn-secondary">
                                    <?php esc_html_e('Read More', 'auntie-map'); ?>
                                </a>

                                <?php if (has_category() || has_tag()) : ?>
                                    <div class="post-terms">
                                        <?php
                                        $categories = get_the_category();
                                        if ($categories) {
                                            echo '<span class="post-categories">';
                                            foreach ($categories as $category) {
                                                echo '<a href="' . get_category_link($category->term_id) . '" class="category-link">' . $category->name . '</a>';
                                            }
                                            echo '</span>';
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </footer>
                        </div>
                    </article>

                <?php endwhile; ?>
            </div>

            <?php
            // Pagination
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => esc_html__('Previous', 'auntie-map'),
                'next_text' => esc_html__('Next', 'auntie-map'),
            ));
            ?>

        <?php else : ?>

            <div class="no-posts-found">
                <h1><?php esc_html_e('Nothing Found', 'auntie-map'); ?></h1>

                <?php if (is_search()) : ?>
                    <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'auntie-map'); ?></p>

                    <div class="search-form-container">
                        <?php get_search_form(); ?>
                    </div>

                    <div class="search-suggestions">
                        <h3><?php esc_html_e('Suggested searches:', 'auntie-map'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/?s=recovery')); ?>"><?php esc_html_e('Recovery', 'auntie-map'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/?s=sobriety')); ?>"><?php esc_html_e('Sobriety', 'auntie-map'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/?s=support')); ?>"><?php esc_html_e('Support', 'auntie-map'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/?s=AA')); ?>"><?php esc_html_e('AA', 'auntie-map'); ?></a></li>
                        </ul>
                    </div>

                <?php else : ?>
                    <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'auntie-map'); ?></p>

                    <div class="search-form-container">
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>

                <div class="helpful-links">
                    <h3><?php esc_html_e('You might be interested in:', 'auntie-map'); ?></h3>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'auntie-map'); ?></a></li>
                        <?php if (class_exists('WooCommerce')) : ?>
                            <li><a href="<?php echo class_exists('WooCommerce') ? esc_url(wc_get_page_permalink('shop')) : esc_url(home_url('/shop')); ?>"><?php esc_html_e('Shop Recovery Merchandise', 'auntie-map'); ?></a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo esc_url(home_url('/recovery-stories')); ?>"><?php esc_html_e('Recovery Stories', 'auntie-map'); ?></a></li>
                    </ul>
                </div>

                <!-- Recovery support message for when content isn't found -->
                <div class="recovery-support-message">
                    <h3><?php esc_html_e('Remember', 'auntie-map'); ?></h3>
                    <p><?php echo esc_html(auntie_map_get_daily_affirmation()); ?></p>
                    <p><em><?php esc_html_e('If you\'re struggling today, please reach out for support. You are not alone.', 'auntie-map'); ?></em></p>

                    <div class="emergency-resources">
                        <p><strong><?php esc_html_e('Crisis Support:', 'auntie-map'); ?></strong></p>
                        <ul>
                            <li><a href="tel:988"><?php esc_html_e('988 - Crisis Lifeline', 'auntie-map'); ?></a></li>
                            <li><a href="tel:1-800-662-4357"><?php esc_html_e('SAMHSA: 1-800-662-4357', 'auntie-map'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <aside class="sidebar" role="complementary">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside>
    <?php endif; ?>
</div>

<style>
/* Additional styles for index page */
.content-area {
    flex: 1;
    margin-right: 2rem;
}

.posts-container {
    display: grid;
    gap: 2rem;
    margin-bottom: 3rem;
}

.post-card {
    background: var(--white);
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.post-thumbnail img {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.post-content {
    padding: 1.5rem;
}

.post-title a {
    color: var(--dark-purple);
    text-decoration: none;
}

.post-title a:hover {
    color: var(--primary-purple);
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
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.post-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-gray);
}

.category-link {
    background: var(--light-purple);
    color: var(--primary-purple);
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    text-decoration: none;
    margin-right: 0.5rem;
}

.sidebar {
    flex: 0 0 300px;
}

.no-posts-found {
    text-align: center;
    padding: 3rem 0;
}

.search-form-container {
    max-width: 400px;
    margin: 2rem auto;
}

.search-suggestions ul,
.helpful-links ul,
.emergency-resources ul {
    list-style: none;
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    justify-content: center;
}

.recovery-support-message {
    background: var(--light-purple);
    padding: 2rem;
    border-radius: 0.75rem;
    margin-top: 2rem;
    text-align: center;
}

.emergency-resources {
    margin-top: 1rem;
}

.emergency-resources ul {
    justify-content: center;
}

/* Responsive design */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }

    .content-area {
        margin-right: 0;
        margin-bottom: 2rem;
    }

    .sidebar {
        flex: none;
    }

    .post-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}
</style>

<?php get_footer(); ?>
