<?php
/**
 * The front page template for Auntie MAP Recovery Store
 *
 * @package AuntieMap
 * @since 1.0.0
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <h1><?php bloginfo('name'); ?></h1>
            <p>
                <?php
                $hero_message = get_theme_mod('auntie_map_hero_message', 'Supporting your journey, one day at a time');
                echo esc_html($hero_message);
                ?>
            </p>
            <div class="hero-actions">
                <?php if (class_exists('WooCommerce')) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">
                        <?php esc_html_e('Shop Recovery Merchandise', 'auntie-map'); ?>
                    </a>
                <?php endif; ?>
                <a href="#recovery-features" class="btn btn-secondary">
                    <?php esc_html_e('Learn More', 'auntie-map'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Daily Affirmation Section -->
<section class="daily-affirmation-section">
    <div class="container">
        <div class="affirmation-card">
            <h2><?php esc_html_e('Today\'s Affirmation', 'auntie-map'); ?></h2>
            <blockquote>
                "<?php echo esc_html(auntie_map_get_daily_affirmation()); ?>"
            </blockquote>
            <p class="affirmation-note">
                <em><?php esc_html_e('A new affirmation each day to support your journey', 'auntie-map'); ?></em>
            </p>
        </div>
    </div>
</section>

<!-- Recovery Features Section -->
<?php
$feature_cards = auntie_map_get_feature_cards();
if (!empty($feature_cards)) :
?>
<section id="recovery-features" class="recovery-features">
    <div class="container">
        <div class="section-header">
            <h2><?php echo wp_kses_post(get_theme_mod('auntie_map_features_section_title', __('Supporting Your Recovery Journey', 'auntie-map'))); ?></h2>
            <p><?php echo wp_kses_post(get_theme_mod('auntie_map_features_section_description', __('Every purchase supports recovery communities and helps fund resources for those in need.', 'auntie-map'))); ?></p>
        </div>

        <div class="features-grid" data-card-count="<?php echo count($feature_cards); ?>">
            <?php foreach ($feature_cards as $card_key => $card_data) : ?>
                <div class="feature-card" data-card="<?php echo wp_kses_post($card_key); ?>">
                    <?php if (!empty($card_data['image'])) : ?>
                        <div class="feature-image">
                            <img src="<?php echo wp_kses_post($card_data['image']); ?>" alt="<?php echo wp_kses_post($card_data['title']); ?>">
                        </div>
                    <?php else : ?>
                        <div class="feature-icon"><?php echo wp_kses_post($card_data['icon']); ?></div>
                    <?php endif; ?>

                    <h3><?php echo wp_kses_post($card_data['title']); ?></h3>

                    <?php if (!empty($card_data['link'])) : ?>
                        <div class="feature-description">
                            <?php echo wp_kses_post($card_data['description']); ?>
                        </div>
                        <a href="<?php echo wp_kses_post($card_data['link']); ?>" class="feature-link" target="_blank" rel="noopener">
                            <?php esc_html_e('Learn More', 'auntie-map'); ?>
                        </a>
                    <?php else : ?>
                        <div class="feature-description">
                            <?php echo wp_kses_post($card_data['description']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Featured Products Section -->
<?php if (class_exists('WooCommerce')) : ?>
<section class="featured-products">
    <div class="container">
        <div class="section-header">
            <h2><?php esc_html_e('Featured Recovery Merchandise', 'auntie-map'); ?></h2>
            <p><?php esc_html_e('Celebrate your journey with meaningful items that inspire and remind you of your strength.', 'auntie-map'); ?></p>
        </div>

        <?php
        $featured_products = wc_get_featured_product_ids();
        if (!empty($featured_products)) {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 6,
                'post__in' => $featured_products,
                'meta_query' => WC()->query->get_meta_query(),
            );

            $featured_query = new WP_Query($args);

            if ($featured_query->have_posts()) {
                echo '<div class="products-grid">';
                while ($featured_query->have_posts()) {
                    $featured_query->the_post();
                    wc_get_template_part('content', 'product');
                }
                echo '</div>';
                wp_reset_postdata();
            }
        } else {
            // Fallback: show recent products
            echo do_shortcode('[recent_products limit="6"]');
        }
        ?>

        <div class="section-footer">
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="btn btn-primary">
                <?php esc_html_e('View All Products', 'auntie-map'); ?>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Recovery Stories Section -->
<section class="recovery-stories-preview">
    <div class="container">
        <div class="section-header">
            <h2><?php esc_html_e('Stories of Hope', 'auntie-map'); ?></h2>
            <p><?php esc_html_e('Real stories from real people on their recovery journeys. You are not alone.', 'auntie-map'); ?></p>
        </div>

        <?php
        $stories_query = new WP_Query(array(
            'post_type' => 'recovery_story',
            'posts_per_page' => 3,
            'post_status' => 'publish',
        ));

        if ($stories_query->have_posts()) :
        ?>
            <div class="stories-grid">
                <?php while ($stories_query->have_posts()) : $stories_query->the_post(); ?>
                    <article class="story-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="story-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="story-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="story-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="read-story">
                                <?php esc_html_e('Read Story', 'auntie-map'); ?> →
                            </a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="section-footer">
                <a href="<?php echo esc_url(home_url('/recovery-stories')); ?>" class="btn btn-secondary">
                    <?php esc_html_e('Read More Stories', 'auntie-map'); ?>
                </a>
            </div>
        <?php
        wp_reset_postdata();
        else :
        ?>
            <div class="no-stories">
                <p><?php esc_html_e('Stories of hope and recovery will be shared here. Check back soon!', 'auntie-map'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Recovery Support Section -->
<section class="recovery-support">
    <div class="container">
        <div class="support-content">
            <h2><?php esc_html_e('You Are Not Alone', 'auntie-map'); ?></h2>
            <p><?php esc_html_e('Recovery is a journey, not a destination. Whether you\'re just starting or celebrating years of sobriety, we\'re here to support you every step of the way.', 'auntie-map'); ?></p>

            <div class="support-actions">
                <?php
                $meeting_finder = get_theme_mod('auntie_map_meeting_finder', '');
                if ($meeting_finder) :
                ?>
                    <a href="<?php echo esc_url($meeting_finder); ?>" target="_blank" rel="noopener" class="btn btn-primary">
                        <?php esc_html_e('Find Local Meetings', 'auntie-map'); ?>
                    </a>
                <?php endif; ?>

                <a href="tel:988" class="btn btn-secondary">
                    <?php esc_html_e('Crisis Support: 988', 'auntie-map'); ?>
                </a>
            </div>

            <div class="support-resources">
                <h3><?php esc_html_e('24/7 Support Resources', 'auntie-map'); ?></h3>
                <div class="resources-grid">
                    <div class="resource-item">
                        <strong><?php esc_html_e('SAMHSA National Helpline', 'auntie-map'); ?></strong><br>
                        <a href="tel:1-800-662-4357">1-800-662-4357</a><br>
                        <em><?php esc_html_e('Free, confidential, 24/7 treatment referral service', 'auntie-map'); ?></em>
                    </div>

                    <div class="resource-item">
                        <strong><?php esc_html_e('Crisis Text Line', 'auntie-map'); ?></strong><br>
                        <a href="sms:741741"><?php esc_html_e('Text HOME to 741741', 'auntie-map'); ?></a><br>
                        <em><?php esc_html_e('Free, 24/7 crisis support via text', 'auntie-map'); ?></em>
                    </div>

                    <div class="resource-item">
                        <strong><?php esc_html_e('Suicide & Crisis Lifeline', 'auntie-map'); ?></strong><br>
                        <a href="tel:988">988</a><br>
                        <em><?php esc_html_e('Free, confidential support 24/7', 'auntie-map'); ?></em>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Signup -->
<section class="newsletter-signup">
    <div class="container">
        <div class="newsletter-content">
            <h2><?php esc_html_e('Stay Connected', 'auntie-map'); ?></h2>
            <p><?php esc_html_e('Get daily affirmations, recovery tips, and updates on new products that support your journey.', 'auntie-map'); ?></p>

            <form class="newsletter-form" method="post" action="#" id="newsletter-form">
                <div class="form-group">
                    <input type="email" name="email" placeholder="<?php esc_attr_e('Your email address', 'auntie-map'); ?>" required>
                    <button type="submit" class="btn btn-primary">
                        <?php esc_html_e('Subscribe', 'auntie-map'); ?>
                    </button>
                </div>
                <p class="newsletter-privacy">
                    <small><?php esc_html_e('We respect your privacy. Unsubscribe at any time.', 'auntie-map'); ?></small>
                </p>
            </form>
        </div>
    </div>
</section>

<style>
/* Front page specific styles */
.daily-affirmation-section {
    padding: 3rem 0;
    background: linear-gradient(135deg, var(--light-purple) 0%, rgba(255, 255, 255, 0.9) 100%);
}

.affirmation-card {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
    background: var(--white);
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(107, 70, 193, 0.1);
}

.affirmation-card blockquote {
    font-size: 1.5rem;
    font-style: italic;
    color: var(--primary-purple);
    margin: 1rem 0;
    font-weight: 500;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-header h2 {
    margin-bottom: 1rem;
}

.section-footer {
    text-align: center;
    margin-top: 3rem;
}

.products-grid,
.stories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.story-card {
    background: var(--white);
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.story-card:hover {
    transform: translateY(-5px);
}

.story-thumbnail img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.story-content {
    padding: 1.5rem;
}

.story-content h3 a {
    color: var(--dark-purple);
    text-decoration: none;
}

.read-story {
    color: var(--primary-purple);
    font-weight: 600;
    text-decoration: none;
}

.recovery-stories-preview {
    padding: 4rem 0;
    background: var(--light-gray);
}

.resources-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.resource-item {
    text-align: center;
    padding: 1rem;
}

.resource-item a {
    color: var(--white);
    font-weight: 600;
    font-size: 1.25rem;
}

.newsletter-signup {
    padding: 4rem 0;
    background: var(--light-purple);
}

.newsletter-content {
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.newsletter-form {
    margin-top: 2rem;
}

.form-group {
    display: flex;
    gap: 1rem;
    max-width: 400px;
    margin: 0 auto;
}

.form-group input {
    flex: 1;
    padding: 0.75rem;
    border: 2px solid var(--border-gray);
    border-radius: 0.5rem;
    font-size: 1rem;
}

.form-group input:focus {
    outline: none;
    border-color: var(--primary-purple);
}

.newsletter-privacy {
    margin-top: 1rem;
    color: var(--text-light);
}

@media (max-width: 768px) {
    .hero-actions {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;
    }

    .form-group {
        flex-direction: column;
    }

    .resources-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
