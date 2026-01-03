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

function just_text_scripts() {
    wp_enqueue_style('just-text-style', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'just_text_scripts');

function just_text_excerpt_length($length) {
    return 40;
}
add_filter('excerpt_length', 'just_text_excerpt_length');
