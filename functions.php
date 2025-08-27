<?php
/**
 * Auntie MAP Recovery Store Theme Functions
 *
 * @package AuntieMap
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function auntie_map_setup() {
    // Add theme support for various features
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('customize-selective-refresh-widgets');

    // WooCommerce support is handled in woocommerce.php

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'auntie-map'),
        'footer'  => esc_html__('Footer Menu', 'auntie-map'),
    ));

    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('style.css');

    // Add support for responsive embeds
    add_theme_support('responsive-embeds');

    // Add support for wide and full alignment
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'auntie_map_setup');

/**
 * Enqueue Scripts and Styles
 */
function auntie_map_scripts() {
    // Main theme stylesheet
    wp_enqueue_style('auntie-map-style', get_stylesheet_uri(), array(), '1.0.0');

    // Google Fonts
    wp_enqueue_style('auntie-map-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);

    // Theme JavaScript
    wp_enqueue_script('auntie-map-script', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('auntie-map-script', 'auntie_map_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('auntie_map_nonce'),
    ));

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'auntie_map_scripts');

/**
 * Register Widget Areas
 */
function auntie_map_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'auntie-map'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'auntie-map'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area 1', 'auntie-map'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in footer.', 'auntie-map'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area 2', 'auntie-map'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here to appear in footer.', 'auntie-map'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area 3', 'auntie-map'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here to appear in footer.', 'auntie-map'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Shop Sidebar', 'auntie-map'),
        'id'            => 'shop-sidebar',
        'description'   => esc_html__('Add widgets here to appear in the shop sidebar.', 'auntie-map'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'auntie_map_widgets_init');

/**
 * Custom Recovery Support Functions
 */
function auntie_map_get_milestone_message($days) {
    $milestones = array(
        1 => 'One day at a time - You\'ve got this!',
        7 => 'One week strong - Keep going!',
        30 => 'One month of courage - Amazing progress!',
        90 => 'Three months of strength - You\'re inspiring!',
        180 => 'Six months of growth - Incredible journey!',
        365 => 'One year of recovery - You are a warrior!',
    );

    foreach ($milestones as $milestone => $message) {
        if ($days >= $milestone) {
            $current_message = $message;
        }
    }

    return isset($current_message) ? $current_message : 'Every day is a victory!';
}

function auntie_map_get_daily_affirmation() {
    $affirmations = array(
        'I am stronger than my addiction.',
        'Today I choose recovery.',
        'I am worthy of love and happiness.',
        'Progress, not perfection.',
        'I have the power to change my life.',
        'One day at a time, I am healing.',
        'I am grateful for my sobriety.',
        'I choose hope over fear.',
        'My recovery is my responsibility and my gift.',
        'I am building a life I love.',
        'Courage doesn\'t mean I\'m not scared; it means I don\'t let fear stop me.',
        'I am learning to love myself.',
        'Each sober day is a victory.',
        'I am creating new, healthy habits.',
        'I trust in my ability to overcome challenges.',
    );

    $index = date('z') % count($affirmations);
    return $affirmations[$index];
}

/**
 * Add recovery support shortcodes
 */
function auntie_map_affirmation_shortcode($atts) {
    return '<div class="recovery-affirmation"><p>"' . auntie_map_get_daily_affirmation() . '"</p></div>';
}
add_shortcode('daily_affirmation', 'auntie_map_affirmation_shortcode');

function auntie_map_milestone_shortcode($atts) {
    $atts = shortcode_atts(array(
        'days' => 1,
    ), $atts);

    $days = intval($atts['days']);
    $message = auntie_map_get_milestone_message($days);

    return '<div class="recovery-milestone"><p>' . $message . '</p></div>';
}
add_shortcode('recovery_milestone', 'auntie_map_milestone_shortcode');

/**
 * Customize WooCommerce
 */
function auntie_map_woocommerce_output_product_data_tabs() {
    global $product;

    echo '<div class="product-recovery-note">';
    echo '<p><em>Every purchase supports recovery communities and helps fund resources for those in need.</em></p>';
    echo '</div>';
}
add_action('woocommerce_single_product_summary', 'auntie_map_woocommerce_output_product_data_tabs', 25);

/**
 * Add recovery-themed product categories
 */
function auntie_map_add_recovery_product_categories() {
    $categories = array(
        'sobriety-tokens' => 'Sobriety Tokens & Chips',
        'recovery-jewelry' => 'Recovery Jewelry',
        'inspirational-apparel' => 'Inspirational Apparel',
        'books-resources' => 'Books & Resources',
        'home-decor' => 'Recovery Home Decor',
        'gifts-newcomers' => 'Gifts for Newcomers',
    );

    foreach ($categories as $slug => $name) {
        if (!term_exists($slug, 'product_cat')) {
            wp_insert_term($name, 'product_cat', array('slug' => $slug));
        }
    }
}
add_action('init', 'auntie_map_add_recovery_product_categories');

/**
 * Custom post types for recovery content
 */
function auntie_map_register_recovery_stories() {
    $args = array(
        'public' => true,
        'label'  => 'Recovery Stories',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-heart',
        'has_archive' => true,
        'rewrite' => array('slug' => 'recovery-stories'),
    );
    register_post_type('recovery_story', $args);
}
add_action('init', 'auntie_map_register_recovery_stories');

/**
 * Customizer additions
 */
function auntie_map_customize_register($wp_customize) {
    // Recovery Support Section
    $wp_customize->add_section('auntie_map_recovery', array(
        'title'    => __('Recovery Support', 'auntie-map'),
        'priority' => 30,
    ));

    // Hero message setting
    $wp_customize->add_setting('auntie_map_hero_message', array(
        'default'           => 'Supporting your journey, one day at a time',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('auntie_map_hero_message', array(
        'label'   => __('Hero Message', 'auntie-map'),
        'section' => 'auntie_map_recovery',
        'type'    => 'text',
    ));

    // Support phone number
    $wp_customize->add_setting('auntie_map_support_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('auntie_map_support_phone', array(
        'label'   => __('Support Phone Number', 'auntie-map'),
        'section' => 'auntie_map_recovery',
        'type'    => 'text',
    ));

    // Meeting finder link
    $wp_customize->add_setting('auntie_map_meeting_finder', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('auntie_map_meeting_finder', array(
        'label'   => __('Meeting Finder URL', 'auntie-map'),
        'section' => 'auntie_map_recovery',
        'type'    => 'url',
    ));

    // Homepage Features Section
    $wp_customize->add_section('auntie_map_homepage_features', array(
        'title'    => __('Homepage Feature Cards', 'auntie-map'),
        'priority' => 35,
    ));

    // Feature Cards Display Options
    $feature_cards = array(
        'meaningful_merchandise' => array(
            'label' => __('Meaningful Merchandise Card', 'auntie-map'),
            'default' => true,
        ),
        'community_support' => array(
            'label' => __('Community Support Card', 'auntie-map'),
            'default' => true,
        ),
        'recovery_resources' => array(
            'label' => __('Recovery Resources Card', 'auntie-map'),
            'default' => true,
        ),
        'give_back' => array(
            'label' => __('Give Back Card', 'auntie-map'),
            'default' => true,
        ),
    );

    foreach ($feature_cards as $card_key => $card_data) {
        // Show/Hide setting
        $wp_customize->add_setting('auntie_map_show_' . $card_key, array(
            'default'           => $card_data['default'],
            'sanitize_callback' => 'auntie_map_sanitize_checkbox',
        ));

        $wp_customize->add_control('auntie_map_show_' . $card_key, array(
            'label'   => $card_data['label'],
            'section' => 'auntie_map_homepage_features',
            'type'    => 'checkbox',
        ));

        // Custom title setting
        $wp_customize->add_setting('auntie_map_' . $card_key . '_title', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('auntie_map_' . $card_key . '_title', array(
            'label'   => $card_data['label'] . ' - ' . __('Custom Title', 'auntie-map'),
            'section' => 'auntie_map_homepage_features',
            'type'    => 'text',
            'active_callback' => function() use ($card_key) {
                return get_theme_mod('auntie_map_show_' . $card_key, true);
            },
        ));

        // Custom description setting
        $wp_customize->add_setting('auntie_map_' . $card_key . '_description', array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        ));

        $wp_customize->add_control('auntie_map_' . $card_key . '_description', array(
            'label'   => $card_data['label'] . ' - ' . __('Custom Description', 'auntie-map'),
            'section' => 'auntie_map_homepage_features',
            'type'    => 'textarea',
            'active_callback' => function() use ($card_key) {
                return get_theme_mod('auntie_map_show_' . $card_key, true);
            },
        ));

        // Custom icon setting
        $wp_customize->add_setting('auntie_map_' . $card_key . '_icon', array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('auntie_map_' . $card_key . '_icon', array(
            'label'   => $card_data['label'] . ' - ' . __('Custom Icon (emoji or text)', 'auntie-map'),
            'section' => 'auntie_map_homepage_features',
            'type'    => 'text',
            'description' => __('Enter an emoji (🎗️) or short text for the icon', 'auntie-map'),
            'active_callback' => function() use ($card_key) {
                return get_theme_mod('auntie_map_show_' . $card_key, true);
            },
        ));
    }

    // Section title and description
    $wp_customize->add_setting('auntie_map_features_section_title', array(
        'default'           => 'Supporting Your Recovery Journey',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('auntie_map_features_section_title', array(
        'label'   => __('Features Section Title', 'auntie-map'),
        'section' => 'auntie_map_homepage_features',
        'type'    => 'text',
        'priority' => 1,
    ));

    $wp_customize->add_setting('auntie_map_features_section_description', array(
        'default'           => 'Every purchase supports recovery communities and helps fund resources for those in need.',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('auntie_map_features_section_description', array(
        'label'   => __('Features Section Description', 'auntie-map'),
        'section' => 'auntie_map_homepage_features',
        'type'    => 'textarea',
        'priority' => 2,
    ));
}

/**
 * Sanitize checkbox values
 */
function auntie_map_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}
add_action('customize_register', 'auntie_map_customize_register');

/**
 * Get homepage feature cards data
 */
function auntie_map_get_feature_cards() {
    $default_cards = array(
        'meaningful_merchandise' => array(
            'icon' => '🎗️',
            'title' => __('Meaningful Merchandise', 'auntie-map'),
            'description' => __('Carefully curated items that celebrate recovery milestones and inspire daily strength.', 'auntie-map'),
            'image' => '',
            'link' => '',
        ),
        'community_support' => array(
            'icon' => '🤝',
            'title' => __('Community Support', 'auntie-map'),
            'description' => __('Connect with others on similar journeys and share stories of hope and healing.', 'auntie-map'),
            'image' => '',
            'link' => '',
        ),
        'recovery_resources' => array(
            'icon' => '📚',
            'title' => __('Recovery Resources', 'auntie-map'),
            'description' => __('Access to meeting finders, support hotlines, and educational materials.', 'auntie-map'),
            'image' => '',
            'link' => '',
        ),
        'give_back' => array(
            'icon' => '💜',
            'title' => __('Give Back', 'auntie-map'),
            'description' => __('Every purchase helps fund recovery programs and support services for those in need.', 'auntie-map'),
            'image' => '',
            'link' => '',
        ),
    );

    $visible_cards = array();

    foreach ($default_cards as $card_key => $default_data) {
        // Check if card should be displayed
        if (get_theme_mod('auntie_map_show_' . $card_key, true)) {
            $card_data = array(
                'icon' => get_theme_mod('auntie_map_' . $card_key . '_icon', $default_data['icon']),
                'title' => get_theme_mod('auntie_map_' . $card_key . '_title', $default_data['title']),
                'description' => get_theme_mod('auntie_map_' . $card_key . '_description', $default_data['description']),
                'image' => get_theme_mod('auntie_map_' . $card_key . '_image', $default_data['image']),
                'link' => get_theme_mod('auntie_map_' . $card_key . '_link', $default_data['link']),
            );

            // Use defaults if custom values are empty
            if (empty($card_data['title'])) {
                $card_data['title'] = $default_data['title'];
            }
            if (empty($card_data['description'])) {
                $card_data['description'] = $default_data['description'];
            }
            if (empty($card_data['icon'])) {
                $card_data['icon'] = $default_data['icon'];
            }

            $visible_cards[$card_key] = $card_data;
        }
    }

    return $visible_cards;
}

/**
 * Add recovery resources to admin bar
 */
function auntie_map_admin_bar_recovery_menu($wp_admin_bar) {
    if (!is_admin_bar_showing()) {
        return;
    }

    $wp_admin_bar->add_menu(array(
        'id'    => 'recovery-resources',
        'title' => 'Recovery Resources',
        'href'  => '#',
    ));

    $wp_admin_bar->add_menu(array(
        'parent' => 'recovery-resources',
        'id'     => 'aa-meetings',
        'title'  => 'Find AA Meetings',
        'href'   => 'https://www.aa.org/find-aa',
        'meta'   => array('target' => '_blank'),
    ));

    $wp_admin_bar->add_menu(array(
        'parent' => 'recovery-resources',
        'id'     => 'na-meetings',
        'title'  => 'Find NA Meetings',
        'href'   => 'https://www.na.org/meetingsearch/',
        'meta'   => array('target' => '_blank'),
    ));

    $wp_admin_bar->add_menu(array(
        'parent' => 'recovery-resources',
        'id'     => 'crisis-hotline',
        'title'  => 'Crisis Hotline: 988',
        'href'   => 'tel:988',
    ));
}
add_action('admin_bar_menu', 'auntie_map_admin_bar_recovery_menu', 100);

/**
 * Add theme options admin menu
 */
function auntie_map_add_admin_menu() {
    add_theme_page(
        __('Auntie MAP Theme Options', 'auntie-map'),
        __('Theme Options', 'auntie-map'),
        'manage_options',
        'auntie-map-options',
        'auntie_map_admin_page'
    );
}
add_action('admin_menu', 'auntie_map_add_admin_menu');

/**
 * Theme options admin page
 */
function auntie_map_admin_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Auntie MAP Theme Options', 'auntie-map'); ?></h1>

        <div class="theme-options-container">
            <div class="theme-options-main">
                <h2><?php esc_html_e('Quick Setup Guide', 'auntie-map'); ?></h2>

                <div class="setup-steps">
                    <div class="setup-step">
                        <h3>1. <?php esc_html_e('Customize Feature Cards', 'auntie-map'); ?></h3>
                        <p><?php esc_html_e('Go to Appearance > Customize > Homepage Feature Cards to control which cards appear on your homepage and customize their content.', 'auntie-map'); ?></p>
                        <a href="<?php echo admin_url('customize.php?autofocus[section]=auntie_map_homepage_features'); ?>" class="button button-primary">
                            <?php esc_html_e('Customize Feature Cards', 'auntie-map'); ?>
                        </a>
                    </div>

                    <div class="setup-step">
                        <h3>2. <?php esc_html_e('Recovery Support Settings', 'auntie-map'); ?></h3>
                        <p><?php esc_html_e('Configure your support phone number, meeting finder links, and recovery messaging.', 'auntie-map'); ?></p>
                        <a href="<?php echo admin_url('customize.php?autofocus[section]=auntie_map_recovery'); ?>" class="button button-primary">
                            <?php esc_html_e('Configure Recovery Support', 'auntie-map'); ?>
                        </a>
                    </div>

                    <div class="setup-step">
                        <h3>3. <?php esc_html_e('Set Up WooCommerce', 'auntie-map'); ?></h3>
                        <p><?php esc_html_e('Configure your store settings, payment methods, and shipping options.', 'auntie-map'); ?></p>
                        <?php if (class_exists('WooCommerce')) : ?>
                            <a href="<?php echo admin_url('admin.php?page=wc-settings'); ?>" class="button button-primary">
                                <?php esc_html_e('WooCommerce Settings', 'auntie-map'); ?>
                            </a>
                        <?php else : ?>
                            <a href="<?php echo admin_url('plugin-install.php?s=woocommerce&tab=search&type=term'); ?>" class="button button-primary">
                                <?php esc_html_e('Install WooCommerce', 'auntie-map'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <h2><?php esc_html_e('Current Feature Cards', 'auntie-map'); ?></h2>
                <div class="feature-cards-preview">
                    <?php
                    $feature_cards = auntie_map_get_feature_cards();
                    if (!empty($feature_cards)) :
                    ?>
                        <div class="cards-grid">
                            <?php foreach ($feature_cards as $card_key => $card_data) : ?>
                                <div class="card-preview">
                                    <div class="card-icon"><?php echo esc_html($card_data['icon']); ?></div>
                                    <h4><?php echo esc_html($card_data['title']); ?></h4>
                                    <p><?php echo esc_html($card_data['description']); ?></p>
                                    <small class="card-status">✅ <?php esc_html_e('Visible', 'auntie-map'); ?></small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p><?php esc_html_e('No feature cards are currently enabled.', 'auntie-map'); ?></p>
                    <?php endif; ?>

                    <p class="customize-link">
                        <a href="<?php echo admin_url('customize.php?autofocus[section]=auntie_map_homepage_features'); ?>">
                            <?php esc_html_e('Customize Feature Cards →', 'auntie-map'); ?>
                        </a>
                    </p>
                </div>
            </div>

            <div class="theme-options-sidebar">
                <div class="sidebar-widget">
                    <h3><?php esc_html_e('Recovery Resources', 'auntie-map'); ?></h3>
                    <ul>
                        <li><a href="https://www.aa.org/find-aa" target="_blank" rel="noopener"><?php esc_html_e('Find AA Meetings', 'auntie-map'); ?></a></li>
                        <li><a href="https://www.na.org/meetingsearch/" target="_blank" rel="noopener"><?php esc_html_e('Find NA Meetings', 'auntie-map'); ?></a></li>
                        <li><a href="tel:988"><?php esc_html_e('Crisis Support: 988', 'auntie-map'); ?></a></li>
                        <li><a href="tel:1-800-662-4357"><?php esc_html_e('SAMHSA: 1-800-662-4357', 'auntie-map'); ?></a></li>
                    </ul>
                </div>

                <div class="sidebar-widget">
                    <h3><?php esc_html_e('Today\'s Affirmation', 'auntie-map'); ?></h3>
                    <blockquote>"<?php echo esc_html(auntie_map_get_daily_affirmation()); ?>"</blockquote>
                </div>

                <div class="sidebar-widget">
                    <h3><?php esc_html_e('Theme Support', 'auntie-map'); ?></h3>
                    <p><?php esc_html_e('Need help with the theme? Check out the documentation or contact support.', 'auntie-map'); ?></p>
                    <a href="#" class="button"><?php esc_html_e('View Documentation', 'auntie-map'); ?></a>
                </div>
            </div>
        </div>
    </div>

    <style>
    .theme-options-container {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
    }

    .theme-options-main {
        flex: 1;
    }

    .theme-options-sidebar {
        flex: 0 0 300px;
    }

    .setup-steps {
        display: grid;
        gap: 2rem;
        margin: 2rem 0;
    }

    .setup-step {
        background: #f9f9f9;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 4px solid #6B46C1;
    }

    .setup-step h3 {
        color: #4C1D95;
        margin-bottom: 1rem;
    }

    .setup-step p {
        margin-bottom: 1rem;
        color: #6B7280;
    }

    .feature-cards-preview {
        background: #fff;
        padding: 2rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .card-preview {
        background: #f8fafc;
        padding: 1rem;
        border-radius: 8px;
        text-align: center;
        border: 1px solid #e5e7eb;
    }

    .card-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }

    .card-preview h4 {
        color: #4C1D95;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .card-preview p {
        font-size: 0.875rem;
        color: #6B7280;
        margin-bottom: 0.5rem;
    }

    .card-status {
        color: #10B981;
        font-weight: 600;
    }

    .customize-link {
        text-align: center;
        margin-top: 1rem;
    }

    .customize-link a {
        color: #6B46C1;
        text-decoration: none;
        font-weight: 600;
    }

    .sidebar-widget {
        background: #fff;
        padding: 1.5rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        margin-bottom: 1.5rem;
    }

    .sidebar-widget h3 {
        color: #4C1D95;
        margin-bottom: 1rem;
        font-size: 1.125rem;
    }

    .sidebar-widget ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .sidebar-widget li {
        margin-bottom: 0.5rem;
    }

    .sidebar-widget a {
        color: #6B46C1;
        text-decoration: none;
    }

    .sidebar-widget a:hover {
        color: #4C1D95;
    }

    .sidebar-widget blockquote {
        background: #EDE9FE;
        border-left: 4px solid #6B46C1;
        color: #4C1D95;
    }

    @media (max-width: 768px) {
        .theme-options-container {
            flex-direction: column;
        }

        .theme-options-sidebar {
            flex: none;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }
    }
    </style>
    <?php
}

/**
 * Security and Performance
 */

// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Disable file editing in admin
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/**
 * Add schema markup for recovery organization
 */
function auntie_map_add_schema_markup() {
    if (is_front_page()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Auntie MAP Recovery Store',
            'description' => 'Supporting recovery journeys with meaningful merchandise and resources',
            'url' => home_url(),
            'sameAs' => array(),
            'contactPoint' => array(
                '@type' => 'ContactPoint',
                'contactType' => 'customer service',
                'availableLanguage' => 'English'
            )
        );

        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'auntie_map_add_schema_markup');

/**
 * Custom logo function with correct dimensions
 */
function auntie_map_custom_logo() {
    if (has_custom_logo()) {
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        if ($logo) {
            echo '<div class="site-logo">';
            echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link" rel="home">';
            echo '<img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '" class="custom-logo" width="40" height="40" style="width: 40px; height: 40px; max-width: 40px; max-height: 40px;">';
            echo '</a>';
            echo '</div>';
        }
    }

    // Always show site title, whether logo exists or not
    echo '<div class="site-title-wrapper">';
    echo '<h1 class="site-title">';
    echo '<a href="' . esc_url(home_url('/')) . '" rel="home">' . get_bloginfo('name') . '</a>';
    echo '</h1>';
    $description = get_bloginfo('description', 'display');
    if ($description || is_customize_preview()) {
        echo '<p class="site-description">' . $description . '</p>';
    }
    echo '</div>';
}

/**
 * Fallback menu function
 */
function auntie_map_fallback_menu() {
    echo '<ul class="primary-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'auntie-map') . '</a></li>';
    if (class_exists('WooCommerce')) {
        echo '<li><a href="' . esc_url(wc_get_page_permalink('shop')) . '">' . esc_html__('Shop', 'auntie-map') . '</a></li>';
        echo '<li><a href="' . esc_url(wc_get_page_permalink('cart')) . '">' . esc_html__('Cart', 'auntie-map') . '</a></li>';
    }
    echo '<li><a href="' . esc_url(home_url('/about')) . '">' . esc_html__('About', 'auntie-map') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">' . esc_html__('Contact', 'auntie-map') . '</a></li>';
    echo '</ul>';
}

/**
 * Custom excerpt length
 */
function auntie_map_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'auntie_map_excerpt_length');

/**
 * Custom excerpt more
 */
function auntie_map_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'auntie_map_excerpt_more');


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

    add_action('after_setup_theme', 'auntie_map_woocommerce_setup');

/**
 * WooCommerce compatibility functions
 */
// DISABLED - causes blank page
// if (class_exists('WooCommerce')) {
//     // Add WooCommerce theme support
//     add_action('after_setup_theme', function() {
//         add_theme_support('woocommerce', array(
//             'thumbnail_image_width' => 300,
//             'single_image_width'    => 600,
//             'product_grid'          => array(
//                 'default_rows'    => 4,
//                 'min_rows'        => 2,
//                 'max_rows'        => 8,
//                 'default_columns' => 3,
//                 'min_columns'     => 2,
//                 'max_columns'     => 5,
//             ),
//         ));
//
//         // Add support for WC features
//         add_theme_support('wc-product-gallery-zoom');
//         add_theme_support('wc-product-gallery-lightbox');
//         add_theme_support('wc-product-gallery-slider');
//     });
//


/**
 * Disable WooCommerce default stylesheets
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Enqueue WooCommerce CSS file
 */
add_action('wp_enqueue_scripts', function() {
    // Make sure this loads AFTER the main theme stylesheet so CSS variables are available
    wp_enqueue_style('auntie-map-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array('auntie-map-style'), '1.0.0');
});
?>
