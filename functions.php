<?php

/**
 * 主题初始化设置
 */
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

/**
 * 自定义摘要长度
 *
 * @param int $length 默认摘要长度
 * @return int 返回 80 个字符
 */
function just_text_excerpt_length($length) {
    return 80;
}
add_filter('excerpt_length', 'just_text_excerpt_length');

/**
 * 隐藏前台管理工具栏
 */
add_filter('show_admin_bar', '__return_false');

/**
 * 主题自定义设置
 *
 * @param WP_Customize_Manager $wp_customize 自定义管理器实例
 */
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

    $wp_customize->add_setting('custom_header_js', array(
        'default' => '',
        'sanitize_callback' => 'just_text_sanitize_js',
    ));

    $wp_customize->add_control('custom_header_js', array(
        'label' => '自定义头部 JS',
        'description' => '在 &lt;head&gt; 标签中插入自定义 JavaScript 代码',
        'section' => 'just_text_settings',
        'type' => 'textarea',
    ));

    $wp_customize->add_setting('theme_mode', array(
        'default' => 'light',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('theme_mode', array(
        'label' => '主题模式',
        'description' => '选择日间、夜间或跟随系统时间自动切换',
        'section' => 'just_text_settings',
        'type' => 'select',
        'choices' => array(
            'light' => '日间模式',
            'dark' => '夜间模式',
            'auto' => '自动切换（6:00-18:00 日间）',
        ),
    ));
}
add_action('customize_register', 'just_text_customize_register');

/**
 * 自定义 JS 代码安全过滤
 *
 * @param string $input 输入的 JS 代码
 * @return string 过滤后的代码
 */
function just_text_sanitize_js($input) {
    if (current_user_can('unfiltered_html')) {
        return $input;
    }
    return wp_kses_post($input);
}

/**
 * 自定义导航菜单 CSS 类
 *
 * @param array $classes CSS 类数组
 * @param object $item 菜单项对象
 * @param object $args 菜单参数
 * @param int $depth 菜单深度
 * @return array 处理后的 CSS 类数组
 */
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

/**
 * 自定义导航菜单链接属性
 *
 * @param array $atts 链接属性数组
 * @param object $item 菜单项对象
 * @param object $args 菜单参数
 * @param int $depth 菜单深度
 * @return array 处理后的链接属性数组
 */
function just_text_nav_menu_link_attributes($atts, $item, $args, $depth) {
    if ($args->theme_location == 'primary') {
        $classes = 'text-secondary hover:text-primary transition-colors border-b border-transparent hover:border-primary';
        if ($item->current) {
            $classes = 'text-primary font-bold';
        }
        $atts['class'] = $classes;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'just_text_nav_menu_link_attributes', 10, 4);

/**
 * 在导航菜单项之间添加分隔符
 *
 * @param string $item_output 菜单项 HTML 输出
 * @param object $item 菜单项对象
 * @param int $depth 菜单深度
 * @param object $args 菜单参数
 * @return string 处理后的菜单项 HTML
 */
function just_text_nav_menu_item($item_output, $item, $depth, $args) {
    if ($args->theme_location == 'primary' && $depth === 0) {
        static $item_count = 0;
        $item_count++;

        if ($item_count > 1) {
            $item_output = '<span class="text-muted mx-3">｜</span>' . $item_output;
        }
    }
    return $item_output;
}
add_filter('walker_nav_menu_start_el', 'just_text_nav_menu_item', 10, 4);

/**
 * 移除文章内容中的区块编辑器注释
 *
 * @param string $content 文章内容
 * @return string 处理后的内容
 */
function just_text_remove_block_comments($content) {
    $content = preg_replace('/<!--\s*wp:.*?-->/s', '', $content);
    $content = preg_replace('/<!--\s*\/wp:.*?-->/s', '', $content);
    return $content;
}
add_filter('the_content', 'just_text_remove_block_comments', 9);

/**
 * 计算文章阅读时间
 *
 * @return int 阅读时间（分钟）
 */
function just_text_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = mb_strlen(strip_tags($content), 'UTF-8');
    $reading_time = ceil($word_count / 400);
    return max(1, $reading_time);
}

/**
 * 移除缩略图尺寸属性
 *
 * @param string $html 缩略图 HTML
 * @return string 处理后的 HTML
 */
function just_text_remove_thumbnail_dimensions($html) {
    return preg_replace('/(width|height)="\d*"\s/', '', $html);
}
add_filter('post_thumbnail_html', 'just_text_remove_thumbnail_dimensions', 10);

/**
 * 为图片添加懒加载属性
 *
 * @param string $content 内容 HTML
 * @return string 处理后的 HTML
 */
function just_text_add_lazy_loading($content) {
    if (is_feed() || is_admin()) {
        return $content;
    }
    $content = preg_replace('/<img(.*?)src=/i', '<img$1loading="lazy" src=', $content);
    return $content;
}
add_filter('the_content', 'just_text_add_lazy_loading', 20);
add_filter('post_thumbnail_html', 'just_text_add_lazy_loading', 20);

/**
 * 替换 Gravatar 头像为国内镜像
 *
 * @param string $avatar 头像 HTML
 * @return string 处理后的头像 HTML
 */
function just_text_gravatar_cn($avatar) {
    $avatar = str_replace(array('www.gravatar.com', '0.gravatar.com', '1.gravatar.com', '2.gravatar.com', 'secure.gravatar.com'), 'cravatar.cn', $avatar);
    return $avatar;
}
add_filter('get_avatar', 'just_text_gravatar_cn');

/**
 * 输出分页导航
 */
function just_text_pagination() {
    global $wp_query;

    if ($wp_query->max_num_pages <= 1) {
        return;
    }

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    echo '<nav class="mt-20 flex justify-center items-center gap-2 text-[1.6rem]">';

    if ($paged > 1) {
        echo '<a href="' . get_pagenum_link($paged - 1) . '" class="w-12 h-12 flex items-center justify-center text-secondary hover:text-primary transition-colors border border-divider hover:border-primary">←</a>';
    }

    for ($i = 1; $i <= $max; $i++) {
        if ($i == $paged) {
            echo '<span class="w-12 h-12 flex items-center justify-center bg-primary text-surface">' . $i . '</span>';
        } else {
            echo '<a href="' . get_pagenum_link($i) . '" class="w-12 h-12 flex items-center justify-center text-secondary hover:text-primary border border-divider hover:border-primary transition-all">' . $i . '</a>';
        }
    }

    if ($paged < $max) {
        echo '<a href="' . get_pagenum_link($paged + 1) . '" class="w-12 h-12 flex items-center justify-center text-secondary hover:text-primary transition-colors border border-divider hover:border-primary">→</a>';
    }

    echo '</nav>';
}

/**
 * 自定义评论模板
 *
 * @param object $comment 评论对象
 * @param array $args 评论参数
 * @param int $depth 评论嵌套深度
 */
function just_text_comment($comment, $args, $depth) {
    $parent_id = $comment->comment_parent;
    $parent_author = '';
    if ($parent_id && $depth > 1) {
        $parent_comment = get_comment($parent_id);
        if ($parent_comment) {
            $parent_author = $parent_comment->comment_author;
        }
    }
    ?>
    <li <?php comment_class('mb-8 pb-8 border-b border-divider last:border-0' . ($depth > 1 ? ' ml-8 md:ml-12 pl-4 md:pl-6 border-l-2 border-l-divider' : '')); ?> id="comment-<?php comment_ID(); ?>">
        <article class="flex gap-3 md:gap-4">
            <div class="flex-shrink-0">
                <?php echo get_avatar($comment, $depth > 1 ? 40 : 48, '', '', array('class' => 'rounded-full')); ?>
            </div>
            <div class="flex-1 min-w-0">
                <div class="mb-2 flex flex-wrap items-center gap-x-3 gap-y-1">
                    <span class="font-bold text-[1.6rem]"><?php echo get_comment_author_link(); ?></span>
                    <?php if ($parent_author) : ?>
                        <span class="text-muted text-[1.4rem]">回复 <span class="text-primary"><?php echo esc_html($parent_author); ?></span></span>
                    <?php endif; ?>
                    <time class="text-muted text-[1.3rem]" datetime="<?php comment_time('c'); ?>">
                        <?php comment_date('Y-m-d'); ?> <?php comment_time('H:i'); ?>
                    </time>
                </div>
                <div class="text-[1.6rem] leading-relaxed mb-3 break-words">
                    <?php comment_text(); ?>
                </div>
                <?php
                comment_reply_link(array_merge($args, array(
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'reply_text' => '回复',
                    'before' => '<div class="text-[1.4rem] text-secondary hover:text-primary transition-colors mb-4">',
                    'after' => '</div>',
                )));
                ?>
            </div>
        </article>
    <?php
}

/**
 * 输出文章卡片
 */
function just_text_post_card() {
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('border-b border-divider pb-24 mb-24 last:border-0'); ?>>
        <div class="text-muted text-[1.5rem] mb-4">
            <time datetime="<?php echo get_the_date('c'); ?>">
                <?php echo get_the_date(); ?>
            </time>
        </div>

        <h2 class="text-[2rem] md:text-[2.2rem] font-bold leading-normal mb-8">
            <?php if (is_sticky()) : ?>
                <span class="text-[1.6rem] text-secondary mr-3">置顶</span>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>" class="text-primary hover:opacity-60 transition-all">
                <?php the_title(); ?>
            </a>
        </h2>

        <div class="flex gap-8 mb-8">
            <div class="flex-1 min-w-0 flex flex-col justify-between">
                <div class="leading-relaxed text-[1.7rem] line-clamp-3 md:line-clamp-6 mb-4">
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

                <div>
                    <div class="flex items-center gap-3 text-[1.5rem] flex-wrap mb-4">
                        <span class="text-muted">阅读约需 <?php echo just_text_reading_time(); ?> 分钟</span>
                        <?php if (has_category()) : ?>
                            <span class="text-muted">·</span>
                            <span class="text-primary [&_a]:text-primary [&_a]:hover:opacity-60 [&_a]:transition-opacity">
                                <?php the_category(' · '); ?>
                            </span>
                        <?php endif; ?>
                        <?php if (get_comments_number() > 0) : ?>
                            <span class="text-muted">·</span>
                            <a href="<?php comments_link(); ?>" class="text-muted hover:text-primary transition-colors">
                                <?php comments_number('0 评论', '1 评论', '% 评论'); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <a href="<?php the_permalink(); ?>" class="text-secondary text-[1.7rem] border-b border-transparent hover:border-secondary transition-all inline-block">
                        查看更多 →
                    </a>
                </div>
            </div>

            <?php if (has_post_thumbnail()) : ?>
                <div class="flex-shrink-0 w-[140px] h-[140px] md:w-[256px] md:h-[256px] overflow-hidden">
                    <a href="<?php the_permalink(); ?>" class="block w-full h-full">
                        <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover hover:opacity-90 transition-opacity')); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </article>
    <?php
}

/**
 * 获取分类及其所有子分类的文章总数
 *
 * @param int $category_id 分类 ID
 * @return int 文章总数
 */
function just_text_get_category_post_count($category_id) {
    $count = 0;
    $category = get_category($category_id);

    if ($category) {
        $count = $category->count;

        $children = get_categories(array(
            'parent' => $category_id,
            'hide_empty' => false,
        ));

        foreach ($children as $child) {
            $count += just_text_get_category_post_count($child->term_id);
        }
    }

    return $count;
}

/**
 * 输出字母筛选器
 */
function just_text_letter_filter() {
    $letters = range('A', 'Z');
    $current_letter = isset($_GET['letter']) ? strtoupper($_GET['letter']) : '';
    ?>
    <div class="letter-filter mb-12">
        <div class="flex flex-wrap gap-3">
            <?php foreach ($letters as $letter) :
                $is_active = ($current_letter === $letter);
                $class = $is_active
                    ? 'w-14 h-14 flex items-center justify-center text-[1.5rem] bg-primary text-surface transition-all'
                    : 'w-14 h-14 flex items-center justify-center text-[1.5rem] border border-divider hover:border-primary transition-all';
                $url = $is_active ? remove_query_arg('letter') : add_query_arg('letter', $letter);
                ?>
                <a href="<?php echo esc_url($url); ?>" class="<?php echo $class; ?>">
                    <?php echo $letter; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

/**
 * 获取字符串首字母（支持中英文）
 *
 * @param string $str 输入字符串
 * @return string 返回大写首字母（A-Z），中文返回拼音首字母
 */
function just_text_term_initial($str) {
    $str = trim($str);
    if ($str === '') return '';

    $firstChar = mb_substr($str, 0, 1, 'UTF-8');

    // 英文字母直接返回大写
    if (preg_match('/[A-Za-z]/', $firstChar)) {
        return strtoupper($firstChar);
    }

    // 转换为 GB2312 编码以获取汉字 ASCII 码
    $s = iconv('UTF-8', 'GB2312//IGNORE', $firstChar);
    $s2 = iconv('GB2312', 'UTF-8//IGNORE', $s);
    $s = $s2 === $firstChar ? $s : $firstChar;

    // 计算汉字 GB2312 编码的 ASCII 值
    $asc = ord($s[0]) * 256 + ord($s[1]) - 65536;

    // GB2312 汉字拼音首字母 ASCII 码范围映射表
    $ranges = [
        'A' => [-20319, -20284],
        'B' => [-20283, -19776],
        'C' => [-19775, -19219],
        'D' => [-19218, -18711],
        'E' => [-18710, -18527],
        'F' => [-18526, -18240],
        'G' => [-18239, -17923],
        'H' => [-17922, -17418],
        'J' => [-17417, -16475],
        'K' => [-16474, -16213],
        'L' => [-16212, -15641],
        'M' => [-15640, -15166],
        'N' => [-15165, -14923],
        'O' => [-14922, -14915],
        'P' => [-14914, -14631],
        'Q' => [-14630, -14150],
        'R' => [-14149, -14091],
        'S' => [-14090, -13319],
        'T' => [-13318, -12839],
        'W' => [-12838, -12557],
        'X' => [-12556, -11848],
        'Y' => [-11847, -11056],
        'Z' => [-11055, -10247],
    ];

    // 匹配对应的拼音首字母
    foreach ($ranges as $letter => [$start, $end]) {
        if ($asc >= $start && $asc <= $end) {
            return $letter;
        }
    }

    return '';
}

