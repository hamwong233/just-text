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

add_filter('show_admin_bar', '__return_false');

function just_text_customize_register($wp_customize) {
    $wp_customize->add_section('just_text_settings', array(
        'title' => '主题设置',
        'priority' => 30,
    ));

    $wp_customize->add_setting('site_subtitle', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('site_subtitle', array(
        'label' => '网站副标题',
        'description' => '输入网站副标题',
        'section' => 'just_text_settings',
        'type' => 'text',
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

function just_text_remove_block_comments($content) {
    $content = preg_replace('/<!--\s*wp:.*?-->/s', '', $content);
    $content = preg_replace('/<!--\s*\/wp:.*?-->/s', '', $content);
    return $content;
}
add_filter('the_content', 'just_text_remove_block_comments', 9);

function just_text_document_title_parts($title) {
    $subtitle = get_theme_mod('site_subtitle');
    if ($subtitle && (is_home() || is_front_page())) {
        $title['title'] = $title['title'] . ' - ' . $subtitle;
    }
    return $title;
}
add_filter('document_title_parts', 'just_text_document_title_parts');

function just_text_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = mb_strlen(strip_tags($content), 'UTF-8');
    $reading_time = ceil($word_count / 400);
    return max(1, $reading_time);
}

function just_text_remove_thumbnail_dimensions($html) {
    return preg_replace('/(width|height)="\d*"\s/', '', $html);
}
add_filter('post_thumbnail_html', 'just_text_remove_thumbnail_dimensions', 10);

function just_text_pagination() {
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    echo '<nav class="mt-20 flex justify-center items-center gap-2 text-[1.6rem]">';

    if ($paged > 1) {
        echo '<a href="' . get_pagenum_link($paged - 1) . '" class="w-12 h-12 flex items-center justify-center text-gray-text hover:text-ink transition-colors border border-line hover:border-ink">←</a>';
    }

    for ($i = 1; $i <= $max; $i++) {
        if ($i == $paged) {
            echo '<span class="w-12 h-12 flex items-center justify-center bg-ink text-paper">' . $i . '</span>';
        } else {
            echo '<a href="' . get_pagenum_link($i) . '" class="w-12 h-12 flex items-center justify-center text-gray-text hover:text-ink border border-line hover:border-ink transition-all">' . $i . '</a>';
        }
    }

    if ($paged < $max) {
        echo '<a href="' . get_pagenum_link($paged + 1) . '" class="w-12 h-12 flex items-center justify-center text-gray-text hover:text-ink transition-colors border border-line hover:border-ink">→</a>';
    }

    echo '</nav>';
}

function just_text_comment($comment, $args, $depth) {
    ?>
    <li <?php comment_class('mb-8 pb-8 border-b border-line last:border-0'); ?> id="comment-<?php comment_ID(); ?>">
        <article class="flex gap-4">
            <div class="flex-shrink-0">
                <?php echo get_avatar($comment, 48, '', '', array('class' => 'rounded-full')); ?>
            </div>
            <div class="flex-1 min-w-0">
                <div class="mb-3">
                    <span class="font-bold text-[1.6rem]"><?php echo get_comment_author_link(); ?></span>
                    <time class="text-gray-light text-[1.4rem] ml-3" datetime="<?php comment_time('c'); ?>">
                        <?php comment_date('Y-m-d'); ?> <?php comment_time('H:i'); ?>
                    </time>
                </div>
                <div class="text-[1.6rem] leading-relaxed mb-3">
                    <?php comment_text(); ?>
                </div>
                <?php
                comment_reply_link(array_merge($args, array(
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'reply_text' => '回复',
                    'before' => '<div class="text-[1.5rem]">',
                    'after' => '</div>',
                )));
                ?>
            </div>
        </article>
    <?php
}

function just_text_post_card() {
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('border-b border-line pb-24 mb-24 last:border-0'); ?>>
        <div class="text-gray-light text-[1.5rem] mb-4">
            <time datetime="<?php echo get_the_date('c'); ?>">
                <?php echo get_the_date(); ?>
            </time>
        </div>

        <h2 class="text-[2rem] md:text-[2.2rem] font-bold leading-normal mb-8">
            <?php if (is_sticky()) : ?>
                <span class="text-[1.6rem] text-gray-text mr-3">置顶</span>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>" class="text-ink hover:opacity-60 transition-all">
                <?php the_title(); ?>
            </a>
        </h2>

        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <div class="flex-1 leading-relaxed text-[1.8rem] line-clamp-6 order-1">
                <?php
                if (has_excerpt()) {
                    echo get_the_excerpt();
                } else {
                    $content = get_the_content();
                    $content = strip_shortcodes($content);
                    $content = wp_strip_all_tags($content);
                    echo mb_substr($content, 0, 200, 'UTF-8') . '...';
                }
                ?>
            </div>

            <?php if (has_post_thumbnail()) : ?>
                <div class="flex-shrink-0 w-full md:w-64 md:h-64 overflow-hidden order-3 md:order-2">
                    <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover hover:opacity-90 transition-opacity')); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="flex items-center gap-3 text-[1.5rem] flex-wrap">
            <span class="text-gray-light">阅读约需 <?php echo just_text_reading_time(); ?> 分钟</span>
            <?php if (has_category()) : ?>
                <span class="text-gray-light">·</span>
                <span class="text-ink [&_a]:text-ink [&_a]:hover:opacity-60 [&_a]:transition-opacity">
                    <?php the_category(' · '); ?>
                </span>
            <?php endif; ?>
            <?php if (get_comments_number() > 0) : ?>
                <span class="text-gray-light">·</span>
                <a href="<?php comments_link(); ?>" class="text-gray-light hover:text-ink transition-colors">
                    <?php comments_number('0 评论', '1 评论', '% 评论'); ?>
                </a>
            <?php endif; ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="text-gray-text text-[1.7rem] border-b border-transparent hover:border-gray-text transition-all inline-block mt-4">
            查看更多 →
        </a>
    </article>
    <?php
}
