<?php

function just_text_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'just-text'),
    ));
}
add_action('after_setup_theme', 'just_text_setup');

function just_text_excerpt_length($length) {
    return 80;
}
add_filter('excerpt_length', 'just_text_excerpt_length');

function just_text_customize_register($wp_customize) {
    $wp_customize->add_section('just_text_settings', array(
        'title' => '主题设置',
        'priority' => 30,
    ));

    $wp_customize->add_setting('icp_filing_number', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('icp_filing_number', array(
        'label' => 'ICP 备案号',
        'description' => '输入您的网站备案号',
        'section' => 'just_text_settings',
        'type' => 'text',
    ));
}
add_action('customize_register', 'just_text_customize_register');

function just_text_nav_menu_css_class($classes, $item, $args, $depth) {
    if ($args->theme_location == 'primary') {
        $classes = array();
        if ($item->current) {
            $classes[] = 'current-menu-item';
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'just_text_nav_menu_css_class', 10, 4);

function just_text_nav_menu_link_attributes($atts, $item, $args, $depth) {
    if ($args->theme_location == 'primary') {
        $classes = 'text-gray-text hover:text-ink transition-colors border-b border-transparent hover:border-ink';
        if ($item->current) {
            $classes = 'text-ink font-bold';
        }
        $atts['class'] = $classes;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'just_text_nav_menu_link_attributes', 10, 4);

function just_text_nav_menu_item($item_output, $item, $depth, $args) {
    if ($args->theme_location == 'primary' && $depth === 0) {
        static $item_count = 0;
        $item_count++;

        if ($item_count > 1) {
            $item_output = '<span class="text-gray-light mx-3">｜</span>' . $item_output;
        }
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'just_text_nav_menu_item', 10, 4);
