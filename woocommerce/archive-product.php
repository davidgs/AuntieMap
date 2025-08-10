<?php
/**
 * The Template for displaying product archives, including the main shop page
 *
 * @package AuntieMap
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

get_header(); ?>

<div class="shop-header">
    <div class="container">
        <div class="shop-header-content">
            <h1 class="shop-title"><?php woocommerce_page_title(); ?></h1>
            <p class="shop-description">
                <?php esc_html_e('Meaningful merchandise to support your recovery journey. Every purchase helps fund recovery programs and resources.', 'auntie-map'); ?>
            </p>
        </div>
    </div>
</div>

<?php
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');
?>

<div class="shop-layout">

    <!-- Shop Sidebar -->
    <aside class="shop-sidebar">
        <?php if (is_active_sidebar('shop-sidebar')) : ?>
            <?php dynamic_sidebar('shop-sidebar'); ?>
        <?php else : ?>

            <!-- Product Categories -->
            <div class="widget shop-categories">
                <h3 class="widget-title"><?php esc_html_e('Shop by Category', 'auntie-map'); ?></h3>
                <ul class="product-categories">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'parent' => 0,
                    ));

                    if ($categories && !is_wp_error($categories)) :
                        foreach ($categories as $category) :
                    ?>
                        <li>
                            <a href="<?php echo get_term_link($category); ?>">
                                <?php echo $category->name; ?>
                                <span class="count">(<?php echo $category->count; ?>)</span>
                            </a>
                        </li>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </ul>
            </div>

            <!-- Recovery Support Widget -->
            <div class="widget recovery-support">
                <h3 class="widget-title"><?php esc_html_e('Recovery Support', 'auntie-map'); ?></h3>
                <div class="support-content">
                    <p><?php esc_html_e('Every purchase supports recovery communities.', 'auntie-map'); ?></p>
                    <div class="affirmation-widget">
                        <strong><?php esc_html_e('Today\'s Affirmation:', 'auntie-map'); ?></strong>
                        <p><em>"<?php echo esc_html(auntie_map_get_daily_affirmation()); ?>"</em></p>
                    </div>
                    <div class="support-links">
                        <a href="tel:988" class="support-link">
                            <?php esc_html_e('Crisis Support: 988', 'auntie-map'); ?>
                        </a>
                        <a href="https://www.aa.org/find-aa" target="_blank" rel="noopener" class="support-link">
                            <?php esc_html_e('Find AA Meetings', 'auntie-map'); ?>
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </aside>

    <!-- Main Shop Content -->
    <main class="shop-content">

        <?php if (woocommerce_product_loop()) : ?>

            <!-- Shop Toolbar -->
            <div class="shop-toolbar">
                <div class="shop-toolbar-left">
                    <?php woocommerce_result_count(); ?>
                </div>
                <div class="shop-toolbar-right">
                    <?php woocommerce_catalog_ordering(); ?>
                </div>
            </div>

            <!-- Products Grid -->
            <?php woocommerce_product_loop_start(); ?>

            <?php
            while (have_posts()) {
                the_post();

                /**
                 * Hook: woocommerce_shop_loop.
                 */
                do_action('woocommerce_shop_loop');

                wc_get_template_part('content', 'product');
            }
            ?>

            <?php woocommerce_product_loop_end(); ?>

            <!-- Pagination -->
            <?php woocommerce_pagination(); ?>

            <?php else : ?>

                <!-- No Products Found -->
                <div class="no-products-found">
                    <h2><?php esc_html_e('No products found', 'auntie-map'); ?></h2>
                    <p><?php esc_html_e('Sorry, no products match your criteria. Please try adjusting your filters or search terms.', 'auntie-map'); ?></p>

                    <div class="shop-suggestions">
                        <h3><?php esc_html_e('You might be interested in:', 'auntie-map'); ?></h3>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/product-category/sobriety-tokens')); ?>"><?php esc_html_e('Sobriety Tokens', 'auntie-map'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/recovery-jewelry')); ?>"><?php esc_html_e('Recovery Jewelry', 'auntie-map'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/inspirational-apparel')); ?>"><?php esc_html_e('Inspirational Apparel', 'auntie-map'); ?></a></li>
                        </ul>
                    </div>

                    <div class="recovery-message">
                        <p><strong><?php esc_html_e('Remember:', 'auntie-map'); ?></strong> <?php echo esc_html(auntie_map_get_daily_affirmation()); ?></p>
                    </div>
                                </div>

            <?php endif; ?>

        </main>

    </div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');
?>

<!-- Recovery Impact Section -->
<section class="recovery-impact">
    <div class="container">
        <div class="impact-content">
            <h2><?php esc_html_e('Your Purchase Makes a Difference', 'auntie-map'); ?></h2>
            <div class="impact-grid">
                <div class="impact-item">
                    <div class="impact-number">25%</div>
                    <div class="impact-text"><?php esc_html_e('of profits support recovery programs', 'auntie-map'); ?></div>
                </div>
                <div class="impact-item">
                    <div class="impact-number">500+</div>
                    <div class="impact-text"><?php esc_html_e('people supported through our partnerships', 'auntie-map'); ?></div>
                </div>
                <div class="impact-item">
                    <div class="impact-number">24/7</div>
                    <div class="impact-text"><?php esc_html_e('crisis support resources available', 'auntie-map'); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Shop page styles */
.shop-header {
    background: linear-gradient(135deg, var(--primary-purple) 0%, var(--secondary-purple) 100%);
    color: var(--white);
    padding: 3rem 0;
    text-align: center;
}

.shop-title {
    color: var(--white);
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.shop-description {
    font-size: 1.125rem;
    color: var(--light-purple);
    max-width: 600px;
    margin: 0 auto;
}

.shop-layout {
    display: flex;
    gap: 2rem;
    margin: 2rem 0;
}

.shop-sidebar {
    flex: 0 0 300px;
}

.shop-content {
    flex: 1;
}

.widget {
    background: var(--white);
    padding: 1.5rem;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.widget-title {
    color: var(--dark-purple);
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.product-categories {
    list-style: none;
}

.product-categories li {
    margin-bottom: 0.5rem;
}

.product-categories a {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem;
    border-radius: 0.25rem;
    text-decoration: none;
    color: var(--text-dark);
    transition: all 0.3s ease;
}

.product-categories a:hover {
    background: var(--light-purple);
    color: var(--primary-purple);
}

.count {
    color: var(--text-light);
    font-size: 0.875rem;
}

.recovery-support {
    background: linear-gradient(135deg, var(--light-purple), var(--accent-purple));
}

.affirmation-widget {
    background: var(--white);
    padding: 1rem;
    border-radius: 0.5rem;
    margin: 1rem 0;
}

.support-links {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.support-link {
    display: block;
    background: var(--primary-purple);
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    text-decoration: none;
    text-align: center;
    font-size: 0.875rem;
    transition: background-color 0.3s ease;
}

.support-link:hover {
    background: var(--dark-purple);
    color: var(--white);
}

.shop-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: var(--light-gray);
    border-radius: 0.5rem;
    margin-bottom: 2rem;
}

.products-wrapper .products {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
}

.no-products-found {
    text-align: center;
    padding: 3rem;
    background: var(--light-gray);
    border-radius: 0.75rem;
}

.shop-suggestions ul {
    list-style: none;
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin: 2rem 0;
}

.shop-suggestions a {
    background: var(--primary-purple);
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.shop-suggestions a:hover {
    background: var(--dark-purple);
}

.recovery-message {
    background: var(--light-purple);
    padding: 1.5rem;
    border-radius: 0.5rem;
    margin-top: 2rem;
}

.recovery-impact {
    background: linear-gradient(135deg, var(--dark-purple), var(--primary-purple));
    color: var(--white);
    padding: 4rem 0;
    margin-top: 4rem;
}

.impact-content {
    text-align: center;
}

.impact-content h2 {
    color: var(--white);
    margin-bottom: 3rem;
}

.impact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
}

.impact-item {
    text-align: center;
}

.impact-number {
    font-size: 3rem;
    font-weight: 700;
    color: var(--light-purple);
    margin-bottom: 0.5rem;
}

.impact-text {
    font-size: 1.125rem;
    color: var(--white);
}

/* Responsive design */
@media (max-width: 768px) {
    .shop-layout {
        flex-direction: column;
    }

    .shop-sidebar {
        flex: none;
    }

    .shop-toolbar {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }

    .products-wrapper .products {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1rem;
    }

    .shop-suggestions ul {
        flex-direction: column;
        align-items: center;
    }

    .impact-number {
        font-size: 2rem;
    }
}
</style>

<?php get_footer(); ?>
