<?php
/**
 * Memory-optimized shop template with proper theme styling
 */

get_header();
?>

<div class="shop-header">
    <div class="container">
        <div class="shop-header-content">
            <h1 class="shop-title"><?php woocommerce_page_title(); ?></h1>
            <p class="shop-description">
                <?php esc_html_e('Meaningful merchandise to support your recovery journey.', 'auntie-map'); ?>
            </p>
        </div>
    </div>
</div>

<div class="shop-layout">
    <!-- Shop Sidebar -->
    <aside class="shop-sidebar">
        <!-- Product Categories -->
        <div class="widget shop-categories">
            <h3 class="widget-title"><?php esc_html_e('Shop by Category', 'auntie-map'); ?></h3>
            <ul class="product-categories">
                <?php
                $categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => true,
                    'parent' => 0,
                    'number' => 10, // Limit to 10 categories
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
    </aside>

    <!-- Main Shop Content -->
    <main class="shop-content">
        <?php if (have_posts()) : ?>
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
            <div class="products-wrapper">
                <ul class="products">
                    <?php
                    // Memory-optimized product loop
                    $post_count = 0;
                    $max_posts = 12; // Limit to 12 products per page

                    while (have_posts() && $post_count < $max_posts) {
                        the_post();
                        $post_count++;

                        // Get minimal product data to save memory
                        global $product;
                        if (!$product) continue;

                        // Basic product display without heavy hooks
                        ?>
                        <li class="product-item">
                            <div class="product-card">
                                <div class="product-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium'); ?>
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <div class="product-info">
                                    <h3 class="product-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>

                                    <div class="product-price">
                                        <?php echo $product->get_price_html(); ?>
                                    </div>

                                    <div class="product-actions">
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php

                        // Clear post data to free memory
                        wp_reset_postdata();
                    }
                    ?>
                </ul>
            </div>

            <!-- Simple Pagination -->
            <?php
            $pagination = paginate_links(array(
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
                'type' => 'list',
            ));
            if ($pagination) {
                echo '<div class="pagination">' . $pagination . '</div>';
            }
            ?>

        <?php else : ?>
            <div class="no-products-found">
                <h2><?php esc_html_e('No products found', 'auntie-map'); ?></h2>
                <p><?php esc_html_e('Sorry, no products match your criteria.', 'auntie-map'); ?></p>
            </div>
        <?php endif; ?>
    </main>
</div>

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

<?php get_footer(); ?>
