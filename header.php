<?php
/**
 * The header for Auntie MAP Recovery Store theme
 *
 * @package AuntieMap
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Recovery support meta -->
    <meta name="description" content="Auntie MAP Recovery Store - Supporting your journey with meaningful merchandise, resources, and community. Every purchase helps fund recovery resources.">
    <meta name="keywords" content="AA recovery, sobriety gifts, recovery merchandise, addiction support, sober living, recovery community">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper">
    <header class="site-header" role="banner">
        <div class="container">
            <div class="header-content">
                <div class="site-branding">
                    <?php auntie_map_custom_logo(); ?>
                </div>

                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="screen-reader-text"><?php esc_html_e('Main Menu', 'auntie-map'); ?></span>
                    ☰
                </button>

                <nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'auntie-map'); ?>">
                    <?php
                    // Simple test navigation
                    echo '<ul class="primary-menu">';
                    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/shop')) . '">Shop</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/about')) . '">About</a></li>';
                    echo '<li><a href="' . esc_url(home_url('/contact')) . '">Contact</a></li>';
                    echo '</ul>';
                    ?>
                </nav>

                <?php if (class_exists('WooCommerce')) : ?>
                    <div class="header-cart">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-link">
                            <span class="cart-icon">🛒</span>
                            <span class="cart-count"><?php echo class_exists('WooCommerce') ? WC()->cart->get_cart_contents_count() : '0'; ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <?php
    // Display recovery support banner on front page
    if (is_front_page()) :
        $support_phone = get_theme_mod('auntie_map_support_phone', '');
        if ($support_phone) :
    ?>
        <div class="recovery-support-banner">
            <div class="container">
                <p>
                    <strong>Need Support?</strong>
                    Call <a href="tel:<?php echo esc_attr($support_phone); ?>"><?php echo esc_html($support_phone); ?></a>
                    or dial 988 for crisis support. You are not alone. 💜
                </p>
            </div>
        </div>
    <?php
        endif;
    endif;
    ?>

    <main class="site-content" role="main">
