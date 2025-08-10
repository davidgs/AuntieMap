<?php
/**
 * The Template for displaying all single products
 *
 * @package AuntieMap
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

get_header(); ?>

<div class="container">
    <div class="product-layout">

        <?php while (have_posts()) : the_post(); ?>

            <div class="product-main">

                <!-- Product Images -->
                <div class="product-images">
                    <?php woocommerce_show_product_images(); ?>
                </div>

                <!-- Product Summary -->
                <div class="product-summary">
                    <div class="summary-content">
                        <?php woocommerce_template_single_title(); ?>
                        <?php woocommerce_template_single_rating(); ?>
                        <?php woocommerce_template_single_price(); ?>
                        <?php woocommerce_template_single_excerpt(); ?>

                        <!-- Recovery Impact Message -->
                        <div class="recovery-impact-message">
                            <div class="impact-icon">💜</div>
                            <div class="impact-text">
                                <h4><?php esc_html_e('Supporting Recovery', 'auntie-map'); ?></h4>
                                <p><?php esc_html_e('Your purchase helps fund recovery programs and support services for those in need.', 'auntie-map'); ?></p>
                            </div>
                        </div>

                        <?php woocommerce_template_single_add_to_cart(); ?>
                        <?php woocommerce_template_single_meta(); ?>
                        <?php woocommerce_template_single_sharing(); ?>
                    </div>
                </div>

            </div>

            <!-- Product Tabs -->
            <div class="product-tabs-section">
                <?php woocommerce_output_product_data_tabs(); ?>
            </div>

            <!-- Recovery Affirmation -->
            <div class="product-affirmation">
                <div class="affirmation-content">
                    <h3><?php esc_html_e('Today\'s Affirmation', 'auntie-map'); ?></h3>
                    <blockquote>"<?php echo esc_html(auntie_map_get_daily_affirmation()); ?>"</blockquote>
                    <p><em><?php esc_html_e('Remember: You are stronger than you think, and every day is a new opportunity for growth.', 'auntie-map'); ?></em></p>
                </div>
            </div>

            <!-- Upsells and Related Products -->
            <?php woocommerce_upsell_display(); ?>
            <?php woocommerce_output_related_products(); ?>

        <?php endwhile; ?>

    </div>
</div>

<!-- Recovery Support Section -->
<section class="product-recovery-support">
    <div class="container">
        <div class="support-grid">
            <div class="support-item">
                <div class="support-icon">🤝</div>
                <h4><?php esc_html_e('Community Support', 'auntie-map'); ?></h4>
                <p><?php esc_html_e('Join thousands of others on their recovery journey. You are not alone.', 'auntie-map'); ?></p>
                <a href="<?php echo esc_url(home_url('/recovery-stories')); ?>" class="support-link">
                    <?php esc_html_e('Read Stories', 'auntie-map'); ?>
                </a>
            </div>

            <div class="support-item">
                <div class="support-icon">📞</div>
                <h4><?php esc_html_e('24/7 Crisis Support', 'auntie-map'); ?></h4>
                <p><?php esc_html_e('If you\'re struggling, help is available around the clock.', 'auntie-map'); ?></p>
                <a href="tel:988" class="support-link emergency">
                    <?php esc_html_e('Call 988', 'auntie-map'); ?>
                </a>
            </div>

            <div class="support-item">
                <div class="support-icon">🗺️</div>
                <h4><?php esc_html_e('Find Meetings', 'auntie-map'); ?></h4>
                <p><?php esc_html_e('Connect with local recovery meetings in your area.', 'auntie-map'); ?></p>
                <a href="https://www.aa.org/find-aa" target="_blank" rel="noopener" class="support-link">
                    <?php esc_html_e('Find Meetings', 'auntie-map'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* Single product page styles */
.product-layout {
    margin: 2rem 0;
}

.product-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    margin-bottom: 3rem;
}

.product-images {
    position: relative;
}

.product-images .woocommerce-product-gallery {
    margin: 0;
}

.product-images .woocommerce-product-gallery__wrapper {
    margin: 0;
}

.product-images .woocommerce-product-gallery__image {
    margin-bottom: 1rem;
}

.product-images img {
    width: 100%;
    height: auto;
    border-radius: 0.75rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.product-summary {
    background: var(--white);
    padding: 2rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    height: fit-content;
}

.product-summary .product_title {
    color: var(--dark-purple);
    font-size: 2rem;
    margin-bottom: 1rem;
}

.product-summary .price {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-purple);
    margin-bottom: 1rem;
}

.product-summary .woocommerce-product-rating {
    margin-bottom: 1rem;
}

.product-summary .woocommerce-product-details__short-description {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 2rem;
}

.recovery-impact-message {
    background: linear-gradient(135deg, var(--light-purple), var(--accent-purple));
    padding: 1.5rem;
    border-radius: 0.75rem;
    margin: 2rem 0;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.impact-icon {
    font-size: 2rem;
    flex-shrink: 0;
}

.impact-text h4 {
    color: var(--dark-purple);
    margin-bottom: 0.5rem;
}

.impact-text p {
    color: var(--primary-purple);
    margin: 0;
    font-size: 0.875rem;
}

.product-summary .cart {
    margin: 2rem 0;
}

.product-summary .single_add_to_cart_button {
    background: var(--primary-purple);
    color: var(--white);
    border: none;
    padding: 1rem 2rem;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1rem;
    width: 100%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.product-summary .single_add_to_cart_button:hover {
    background: var(--dark-purple);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(107, 70, 193, 0.3);
}

.product-summary .quantity {
    margin-bottom: 1rem;
}

.product-summary .quantity input {
    padding: 0.5rem;
    border: 2px solid var(--border-gray);
    border-radius: 0.25rem;
    width: 80px;
    text-align: center;
}

.product-summary .product_meta {
    margin-top: 2rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-gray);
    font-size: 0.875rem;
    color: var(--text-light);
}

.product-tabs-section {
    background: var(--white);
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin-bottom: 3rem;
    overflow: hidden;
}

.woocommerce-tabs .tabs {
    display: flex;
    background: var(--light-gray);
    margin: 0;
    list-style: none;
    border-bottom: 2px solid var(--border-gray);
}

.woocommerce-tabs .tabs li {
    flex: 1;
}

.woocommerce-tabs .tabs li a {
    display: block;
    padding: 1rem;
    text-align: center;
    text-decoration: none;
    color: var(--text-dark);
    transition: all 0.3s ease;
}

.woocommerce-tabs .tabs li.active a,
.woocommerce-tabs .tabs li a:hover {
    background: var(--primary-purple);
    color: var(--white);
}

.woocommerce-tabs .panel {
    padding: 2rem;
}

.product-affirmation {
    background: linear-gradient(135deg, var(--primary-purple), var(--secondary-purple));
    color: var(--white);
    padding: 3rem;
    border-radius: 1rem;
    text-align: center;
    margin-bottom: 3rem;
}

.affirmation-content h3 {
    color: var(--white);
    margin-bottom: 1rem;
}

.affirmation-content blockquote {
    font-size: 1.5rem;
    font-style: italic;
    margin: 1rem 0;
    background: rgba(255, 255, 255, 0.1);
    padding: 1.5rem;
    border-radius: 0.5rem;
    border-left: 4px solid var(--white);
}

.product-recovery-support {
    background: var(--light-gray);
    padding: 4rem 0;
}

.support-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.support-item {
    background: var(--white);
    padding: 2rem;
    border-radius: 0.75rem;
    text-align: center;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.support-item:hover {
    transform: translateY(-5px);
}

.support-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.support-item h4 {
    color: var(--dark-purple);
    margin-bottom: 1rem;
}

.support-item p {
    color: var(--text-light);
    margin-bottom: 1.5rem;
}

.support-link {
    display: inline-block;
    background: var(--primary-purple);
    color: var(--white);
    padding: 0.75rem 1.5rem;
    border-radius: 0.5rem;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.support-link:hover {
    background: var(--dark-purple);
    color: var(--white);
    transform: translateY(-2px);
}

.support-link.emergency {
    background: var(--error-red);
}

.support-link.emergency:hover {
    background: #DC2626;
}

/* Related and Upsell Products */
.upsells,
.related {
    margin: 3rem 0;
}

.upsells h2,
.related h2 {
    color: var(--dark-purple);
    text-align: center;
    margin-bottom: 2rem;
}

.upsells .products,
.related .products {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

/* Responsive design */
@media (max-width: 768px) {
    .product-main {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .product-summary {
        padding: 1.5rem;
    }

    .product-summary .product_title {
        font-size: 1.5rem;
    }

    .recovery-impact-message {
        flex-direction: column;
        text-align: center;
    }

    .woocommerce-tabs .tabs {
        flex-direction: column;
    }

    .product-affirmation {
        padding: 2rem;
    }

    .affirmation-content blockquote {
        font-size: 1.25rem;
    }

    .support-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>
