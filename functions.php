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
    return 40;
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
