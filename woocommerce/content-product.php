<?php
/**
 * The template for displaying product content within loops
 *
 * @package AuntieMap
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('product-item', $product); ?>>

    <div class="product-card">

        <!-- Product Image -->
        <div class="product-image">
            <a href="<?php the_permalink(); ?>" class="product-link">
                <?php
                /**
                 * Hook: woocommerce_before_shop_loop_item_title.
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action('woocommerce_before_shop_loop_item_title');
                ?>
            </a>

            <?php if ($product->is_on_sale()) : ?>
                <div class="sale-badge">
                    <?php esc_html_e('Sale!', 'auntie-map'); ?>
                </div>
            <?php endif; ?>

            <!-- Quick Actions -->
            <div class="product-actions">
                <?php
                /**
                 * Hook: woocommerce_after_shop_loop_item.
                 *
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                do_action('woocommerce_after_shop_loop_item');
                ?>
            </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">

            <div class="product-categories">
                <?php
                $categories = get_the_terms($product->get_id(), 'product_cat');
                if ($categories && !is_wp_error($categories)) {
                    $category = $categories[0];
                    echo '<span class="product-category">' . esc_html($category->name) . '</span>';
                }
                ?>
            </div>

            <h3 class="product-title">
                <a href="<?php the_permalink(); ?>">
                    <?php
                    /**
                     * Hook: woocommerce_shop_loop_item_title.
                     *
                     * @hooked woocommerce_template_loop_product_title - 10
                     */
                    do_action('woocommerce_shop_loop_item_title');
                    ?>
                </a>
            </h3>

            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action('woocommerce_after_shop_loop_item_title');
            ?>

            <!-- Product Excerpt -->
            <?php if (has_excerpt()) : ?>
                <div class="product-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                </div>
            <?php endif; ?>

            <!-- Recovery Impact Note -->
            <div class="product-impact-note">
                <span class="impact-icon">💜</span>
                <span class="impact-text"><?php esc_html_e('Supports recovery community', 'auntie-map'); ?></span>
            </div>

        </div>

    </div>

</li>

<style>
/* Product card styles */
.products .product-item {
    list-style: none;
    margin: 0;
    padding: 0;
}

.product-card {
    background: var(--white);
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.product-image {
    position: relative;
    overflow: hidden;
}

.product-image img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image img {
    transform: scale(1.05);
}

.sale-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: var(--error-red);
    color: var(--white);
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-size: 0.875rem;
    font-weight: 600;
    z-index: 2;
}

.product-actions {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card:hover .product-actions {
    opacity: 1;
}

.product-actions .button {
    background: var(--primary-purple);
    color: var(--white);
    border: none;
    padding: 0.75rem;
    border-radius: 50%;
    width: 3rem;
    height: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(107, 70, 193, 0.3);
}

.product-actions .button:hover {
    background: var(--dark-purple);
    transform: scale(1.1);
}

.product-info {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-categories {
    margin-bottom: 0.5rem;
}

.product-category {
    background: var(--light-purple);
    color: var(--primary-purple);
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.product-title {
    margin-bottom: 0.5rem;
    flex: 1;
}

.product-title a {
    color: var(--dark-purple);
    text-decoration: none;
    font-size: 1.125rem;
    font-weight: 600;
    line-height: 1.3;
}

.product-title a:hover {
    color: var(--primary-purple);
}

.price {
    color: var(--primary-purple);
    font-weight: 700;
    font-size: 1.25rem;
    margin-bottom: 0.5rem;
}

.price del {
    color: var(--text-light);
    font-weight: 400;
    margin-right: 0.5rem;
}

.product-excerpt {
    color: var(--text-light);
    font-size: 0.875rem;
    line-height: 1.4;
    margin-bottom: 1rem;
}

.product-impact-note {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--light-purple);
    padding: 0.5rem;
    border-radius: 0.5rem;
    margin-top: auto;
}

.impact-icon {
    font-size: 1rem;
}

.impact-text {
    font-size: 0.75rem;
    color: var(--primary-purple);
    font-weight: 600;
}

/* Star rating styles */
.star-rating {
    color: var(--warning-amber);
    margin-bottom: 0.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .product-image img {
        height: 200px;
    }

    .product-info {
        padding: 1rem;
    }

    .product-title a {
        font-size: 1rem;
    }

    .price {
        font-size: 1.125rem;
    }
}
</style>
