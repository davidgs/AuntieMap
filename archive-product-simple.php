<?php
/**
 * Simple fallback template for WooCommerce product archives
 * Use this if the main archive-product.php isn't working
 *
 * @package AuntieMap
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

get_header(); ?>

<div class="shop-header">
    <div class="container">
        <h1><?php woocommerce_page_title(); ?></h1>
        <p><?php esc_html_e('Meaningful merchandise to support your recovery journey.', 'auntie-map'); ?></p>
    </div>
</div>

<div class="container">
    <?php
    /**
     * Hook: woocommerce_before_main_content.
     */
    do_action('woocommerce_before_main_content');
    ?>

    <?php if (have_posts()) : ?>

        <header class="woocommerce-products-header">
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
            <?php endif; ?>

            <?php
            /**
             * Hook: woocommerce_archive_description.
             *
             * @hooked woocommerce_taxonomy_archive_description - 10
             * @hooked woocommerce_product_archive_description - 10
             */
            do_action('woocommerce_archive_description');
            ?>
        </header>

        <?php
        /**
         * Hook: woocommerce_before_shop_loop.
         *
         * @hooked woocommerce_output_all_notices - 10
         * @hooked woocommerce_result_count - 20
         * @hooked woocommerce_catalog_ordering - 30
         */
        do_action('woocommerce_before_shop_loop');

        woocommerce_product_loop_start();

        if (wc_get_loop_prop('is_shortcode')) {
            $columns = absint(wc_get_loop_prop('columns'));
            wc_set_loop_prop('columns', $columns);
        }

        while (have_posts()) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action('woocommerce_shop_loop');

            wc_get_template_part('content', 'product');
        }

        woocommerce_product_loop_end();

        /**
         * Hook: woocommerce_after_shop_loop.
         *
         * @hooked woocommerce_pagination - 10
         */
        do_action('woocommerce_after_shop_loop');
        ?>

    <?php else : ?>

        <?php
        /**
         * Hook: woocommerce_no_products_found.
         *
         * @hooked wc_no_products_found - 10
         */
        do_action('woocommerce_no_products_found');
        ?>

    <?php endif; ?>

    <?php
    /**
     * Hook: woocommerce_after_main_content.
     */
    do_action('woocommerce_after_main_content');
    ?>

    <?php
    /**
     * Hook: woocommerce_sidebar.
     */
    do_action('woocommerce_sidebar');
    ?>
</div>

<?php get_footer(); ?>
