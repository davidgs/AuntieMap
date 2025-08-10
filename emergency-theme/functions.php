<?php
// Emergency backup theme functions
if (!defined('ABSPATH')) {
    exit;
}

function emergency_theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'emergency_theme_setup');

function emergency_theme_scripts() {
    wp_enqueue_style('emergency-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'emergency_theme_scripts');
?>
