<?php
/**
 * Modern Landing Pro Functions and Definitions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function modern_landing_pro_setup() {
    // Add theme support for various WordPress features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('customize-selective-refresh-widgets');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'modern-landing-pro'),
        'footer'  => esc_html__('Footer Menu', 'modern-landing-pro'),
    ));
    
    // Set content width
    $GLOBALS['content_width'] = 1200;
}
add_action('after_setup_theme', 'modern_landing_pro_setup');

/**
 * Enqueue Scripts and Styles
 */
function modern_landing_pro_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style(
        'modern-landing-pro-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Enqueue Google Fonts
    wp_enqueue_style(
        'modern-landing-pro-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Enqueue custom JavaScript if needed
    wp_enqueue_script(
        'modern-landing-pro-script',
        get_template_directory_uri() . '/js/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'modern_landing_pro_scripts');

/**
 * Customizer Settings
 */
function modern_landing_pro_customize_register($wp_customize) {
    // Hero Section Settings
    $wp_customize->add_section('hero_section', array(
        'title'    => __('Hero Section', 'modern-landing-pro'),
        'priority' => 120,
    ));
    
    // Hero Title
    $wp_customize->add_setting('hero_title', array(
        'default'           => 'Welcome to the Future of Digital Excellence',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'   => __('Hero Title', 'modern-landing-pro'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default'           => 'Experience cutting-edge design and seamless functionality that transforms your vision into reality.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label'   => __('Hero Subtitle', 'modern-landing-pro'),
        'section' => 'hero_section',
        'type'    => 'textarea',
    ));
    
    // Primary Button Text
    $wp_customize->add_setting('hero_primary_btn_text', array(
        'default'           => 'Get Started Today',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_primary_btn_text', array(
        'label'   => __('Primary Button Text', 'modern-landing-pro'),
        'section' => 'hero_section',
        'type'    => 'text',
    ));
    
    // Primary Button URL
    $wp_customize->add_setting('hero_primary_btn_url', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_primary_btn_url', array(
        'label'   => __('Primary Button URL', 'modern-landing-pro'),
        'section' => 'hero_section',
        'type'    => 'url',
    ));
    
    // Features Section
    $wp_customize->add_section('features_section', array(
        'title'    => __('Features Section', 'modern-landing-pro'),
        'priority' => 130,
    ));
    
    // Features Title
    $wp_customize->add_setting('features_title', array(
        'default'           => 'Powerful Features',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('features_title', array(
        'label'   => __('Features Title', 'modern-landing-pro'),
        'section' => 'features_section',
        'type'    => 'text',
    ));
    
    // About Section
    $wp_customize->add_section('about_section', array(
        'title'    => __('About Section', 'modern-landing-pro'),
        'priority' => 140,
    ));
    
    // About Title
    $wp_customize->add_setting('about_title', array(
        'default'           => 'Innovation Meets Excellence',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('about_title', array(
        'label'   => __('About Title', 'modern-landing-pro'),
        'section' => 'about_section',
        'type'    => 'text',
    ));
    
    // About Content
    $wp_customize->add_setting('about_content', array(
        'default'           => 'We\'re passionate about creating exceptional digital experiences that drive results.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('about_content', array(
        'label'   => __('About Content', 'modern-landing-pro'),
        'section' => 'about_section',
        'type'    => 'textarea',
    ));
    
    // Contact Section
    $wp_customize->add_section('contact_section', array(
        'title'    => __('Contact Section', 'modern-landing-pro'),
        'priority' => 150,
    ));
    
    // Contact Email
    $wp_customize->add_setting('contact_email', array(
        'default'           => 'hello@yoursite.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'   => __('Contact Email', 'modern-landing-pro'),
        'section' => 'contact_section',
        'type'    => 'email',
    ));
    
    // Contact Phone
    $wp_customize->add_setting('contact_phone', array(
        'default'           => '+1234567890',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'   => __('Contact Phone', 'modern-landing-pro'),
        'section' => 'contact_section',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'modern_landing_pro_customize_register');

/**
 * Add custom body classes
 */
function modern_landing_pro_body_classes($classes) {
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    
    if (is_front_page()) {
        $classes[] = 'landing-page';
    }
    
    return $classes;
}
add_filter('body_class', 'modern_landing_pro_body_classes');

/**
 * Add preconnect for Google Fonts
 */
function modern_landing_pro_resource_hints($urls, $relation_type) {
    if (wp_installing() || is_admin()) {
        return $urls;
    }

    if ('preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}
add_filter('wp_resource_hints', 'modern_landing_pro_resource_hints', 10, 2);

/**
 * Enqueue admin styles
 */
function modern_landing_pro_admin_style() {
    wp_enqueue_style(
        'modern-landing-pro-admin',
        get_template_directory_uri() . '/admin/admin-style.css',
        array(),
        wp_get_theme()->get('Version')
    );
}
add_action('admin_enqueue_scripts', 'modern_landing_pro_admin_style');

/**
 * Remove unnecessary WordPress features
 */
function modern_landing_pro_cleanup() {
    // Remove version from head
    remove_action('wp_head', 'wp_generator');
    
    // Remove unnecessary RSS feeds
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);
    
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
    
    // Remove wlwmanifest.xml
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
}
add_action('init', 'modern_landing_pro_cleanup');

/**
 * Optimize WordPress performance
 */
function modern_landing_pro_optimize() {
    // Disable emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    
    // Remove query strings from static resources
    if (!is_admin()) {
        add_filter('script_loader_src', 'modern_landing_pro_remove_script_version', 15, 1);
        add_filter('style_loader_src', 'modern_landing_pro_remove_script_version', 15, 1);
    }
}
add_action('init', 'modern_landing_pro_optimize');

function modern_landing_pro_remove_script_version($src) {
    $parts = explode('?ver', $src);
    return $parts[0];
}

/**
 * Custom excerpt length
 */
function modern_landing_pro_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'modern_landing_pro_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function modern_landing_pro_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'modern_landing_pro_excerpt_more');

/**
 * Fallback menu when no menu is assigned
 */
function modern_landing_pro_fallback_menu() {
    echo '<ul>';
    echo '<li><a href="#home">Home</a></li>';
    echo '<li><a href="#features">Features</a></li>';
    echo '<li><a href="#about">About</a></li>';
    echo '<li><a href="#contact">Contact</a></li>';
    echo '</ul>';
}