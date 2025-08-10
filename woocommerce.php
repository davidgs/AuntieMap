<?php
/**
 * WooCommerce compatibility file
 *
 * @package AuntieMap
 * @since 1.0.0
 */

// Debug: Check if this file is being loaded
error_log('WooCommerce file loaded at: ' . date('Y-m-d H:i:s'));

// Prevent multiple processing of this file
if (defined('AUNTIE_MAP_WOOCOMMERCE_PROCESSED')) {
    return;
}
define('AUNTIE_MAP_WOOCOMMERCE_PROCESSED', true);

if (!defined('ABSPATH')) {
    exit;
}

/**
 * WooCommerce setup function
 */
if (!function_exists('auntie_map_woocommerce_setup')) {
function auntie_map_woocommerce_setup() {
    // Only run if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        return;
    }
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 300,
        'single_image_width'    => 600,
        'product_grid'          => array(
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ));

    // Add support for WC features
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
}
add_action('after_setup_theme', 'auntie_map_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets
 */
if (!function_exists('auntie_map_woocommerce_scripts')) {
function auntie_map_woocommerce_scripts() {
    // Only run if WooCommerce is active
    if (!class_exists('WooCommerce')) {
        return;
    }
    wp_enqueue_style('auntie-map-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), '1.0.0');
}
}
add_action('wp_enqueue_scripts', 'auntie_map_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Remove default WooCommerce wrappers
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Add theme wrappers
 */
add_action('woocommerce_before_main_content', 'auntie_map_woocommerce_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'auntie_map_woocommerce_wrapper_end', 10);

if (!function_exists('auntie_map_woocommerce_wrapper_start')) {
function auntie_map_woocommerce_wrapper_start() {
    echo '<div class="woocommerce-content"><div class="container">';
}

function auntie_map_woocommerce_wrapper_end() {
    echo '</div></div>';
}
}

/**
 * Sample implementation of the WooCommerce Mini Cart
 */
if (!function_exists('auntie_map_woocommerce_cart_link_fragment')) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     */
    function auntie_map_woocommerce_cart_link_fragment($fragments) {
        ob_start();
        auntie_map_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'auntie_map_woocommerce_cart_link_fragment');

if (!function_exists('auntie_map_woocommerce_cart_link')) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     */
    function auntie_map_woocommerce_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'auntie-map'); ?>">
            <?php
            $item_count_text = sprintf(
                /* translators: number of items in the mini cart. */
                _n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'auntie-map'),
                WC()->cart->get_cart_contents_count()
            );
            ?>
            <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span>
            <span class="count"><?php echo esc_html($item_count_text); ?></span>
        </a>
        <?php
    }
}

/**
 * Remove WooCommerce sidebar from shop pages
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
?>
