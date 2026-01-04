<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'paper': '#FAF8F1',
                        'ink': '#161616',
                        'gray-text': '#888',
                        'gray-light': '#aaa',
                        'line': '#eee',
                    },
                    fontSize: {
                        'base': '1.7rem',
                    }
                }
            }
        }
    </script>
    <style>
        html {
            font-size: 62.5%;
            scroll-behavior: smooth;
        }

        body {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
        }

        ::selection {
            background: #ffecaa;
            color: #161616;
        }

        .prose-content > *:first-child {
            margin-top: 0;
        }

        .prose-content > *:last-child {
            margin-bottom: 0;
        }

        .prose-content p {
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .prose-content > p:empty {
            display: none;
        }

        .prose-content h1,
        .prose-content h2,
        .prose-content h3,
        .prose-content h4,
        .prose-content h5,
        .prose-content h6,
        .prose-content .wp-block-heading {
            line-height: 1.3;
            font-weight: 700;
            clear: both;
            margin: 40px 0 24px;
            letter-spacing: 0.02em;
        }

        .prose-content h1:first-child,
        .prose-content h2:first-child,
        .prose-content h3:first-child,
        .prose-content .wp-block-heading:first-child {
            margin-top: 0;
        }

        .prose-content h1 { font-size: 2.6rem; }
        .prose-content h2 { font-size: 2.2rem; }
        .prose-content h3 { font-size: 2rem; }
        .prose-content h4 { font-size: 1.8rem; }
        .prose-content h5,
        .prose-content h6 { font-size: 1.6rem; }

        .prose-content a {
            border-bottom: 1px solid currentColor;
            transition: opacity 0.2s;
        }

        .prose-content a:hover {
            opacity: 0.6;
        }

        .prose-content ul,
        .prose-content ol {
            margin: 1.5rem 0;
            margin-left: 1.5rem;
        }

        .prose-content ul {
            list-style-type: disc;
        }

        .prose-content ol {
            list-style-type: decimal;
        }

        .prose-content li {
            line-height: 1.8;
            margin: 0.5rem 0;
            padding-left: 0.5em;
        }

        .prose-content li > p {
            margin: 0.5rem 0;
        }

        .prose-content ul ul,
        .prose-content ol ol,
        .prose-content ul ol,
        .prose-content ol ul {
            margin: 0.5rem 0;
        }

        .prose-content blockquote {
            background-color: #fbf3e7;
            border-left: 4px solid #dcbb85;
            margin: 2rem 0;
            padding: 1.25rem 1.5rem;
            border-radius: 0 0.25rem 0.25rem 0;
        }

        .prose-content blockquote p {
            margin-bottom: 1rem;
        }

        .prose-content blockquote p:last-child {
            margin-bottom: 0;
        }

        .prose-content strong,
        .prose-content b {
            font-weight: 700;
        }

        .prose-content em,
        .prose-content i {
            font-style: italic;
        }

        .prose-content del,
        .prose-content s {
            text-decoration: line-through;
        }

        .prose-content mark {
            background-color: #ffecaa;
            padding: 0 0.25rem;
        }

        .prose-content small {
            font-size: 1.4rem;
        }

        .prose-content sub,
        .prose-content sup {
            font-size: 1.2rem;
        }

        .prose-content abbr {
            border-bottom: 1px dotted currentColor;
            cursor: help;
        }

        .prose-content kbd {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 1.4rem;
            border: 1px solid rgba(0, 0, 0, 0.2);
            font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        }

        .prose-content dl {
            margin: 1.5rem 0;
        }

        .prose-content dt {
            font-weight: 700;
            margin-top: 1rem;
        }

        .prose-content dt:first-child {
            margin-top: 0;
        }

        .prose-content dd {
            margin-left: 1.5rem;
            margin-top: 0.5rem;
        }

        .prose-content figure {
            margin: 2rem 0;
        }

        .prose-content figure img {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
            display: block;
        }

        .prose-content figure.wp-block-image {
            margin: 2rem 0;
        }

        .prose-content figure.wp-block-image img {
            width: 100%;
            height: auto;
            border-radius: 0.5rem;
            display: block;
        }

        .prose-content figure.wp-block-image.size-full img,
        .prose-content figure.wp-block-image.size-large img {
            max-width: 100%;
        }

        .prose-content figure figcaption,
        .prose-content .wp-block-image figcaption {
            color: #aaa;
            font-size: 1.5rem;
            text-align: center;
            margin-top: 0.75rem;
        }

        .prose-content .wp-block-quote {
            background-color: #fbf3e7;
            border-left: 4px solid #dcbb85;
            margin: 2rem 0;
            padding: 1.25rem 1.5rem;
            border-radius: 0 0.25rem 0.25rem 0;
        }

        .prose-content .wp-block-code {
            background-color: #222;
            color: #ffecaa;
            font-size: 1.5rem;
            margin: 2rem 0;
            padding: 1.5rem;
            border-radius: 0.5rem;
            line-height: 1.8;
            overflow-x: auto;
        }

        .prose-content .wp-block-table {
            margin: 2rem 0;
        }

        .prose-content .wp-block-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .prose-content .wp-block-gallery {
            margin: 2rem 0;
            display: grid;
            gap: 1rem;
        }

        .prose-content .wp-block-gallery.columns-2 {
            grid-template-columns: repeat(2, 1fr);
        }

        .prose-content .wp-block-gallery.columns-3 {
            grid-template-columns: repeat(3, 1fr);
        }

        .prose-content .wp-block-gallery.columns-4 {
            grid-template-columns: repeat(4, 1fr);
        }

        .prose-content hr {
            border: 0;
            border-top: 1px solid #eee;
            margin: 3rem 0;
        }

        .prose-content code {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 0.125rem 0.375rem;
            border-radius: 0.25rem;
            font-size: 1.5rem;
            font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        }

        .prose-content pre {
            background-color: #222;
            color: #ffecaa;
            font-size: 1.5rem;
            margin: 2rem 0;
            padding: 1.5rem;
            border-radius: 0.5rem;
            line-height: 1.8;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            position: relative;
        }

        .code-copy-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffecaa;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.4rem 0.8rem;
            border-radius: 0.25rem;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .code-copy-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .code-copy-btn.copied {
            background-color: rgba(76, 175, 80, 0.3);
            border-color: rgba(76, 175, 80, 0.5);
        }

        .prose-content pre code {
            background-color: transparent;
            padding: 0;
            font-size: 1.5rem;
        }

        .prose-content img {
            max-width: 100%;
            height: auto;
            margin: 2rem 0;
            border-radius: 0.5rem;
        }

        .prose-content figure {
            margin: 2rem 0;
        }

        .prose-content figcaption {
            color: #aaa;
            font-size: 1.5rem;
            text-align: center;
            margin-top: 0.75rem;
        }

        .prose-content table {
            width: 100%;
            margin: 2rem 0;
            border-collapse: collapse;
        }

        .prose-content th,
        .prose-content td {
            border: 1px solid #eee;
            padding: 0.75rem 1rem;
            text-align: left;
        }

        .prose-content th {
            background-color: rgba(0, 0, 0, 0.05);
            font-weight: 700;
        }

        .prose-content tbody tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0.02);
        }
    </style>
    <?php
    $custom_header_js = get_theme_mod('custom_header_js');
    if ($custom_header_js) {
        echo wp_unslash($custom_header_js);
    }
    ?>
    <?php wp_head(); ?>
</head>
<body class="bg-paper text-ink leading-relaxed tracking-wide p-5" style="font-size: 1.7rem; line-height: 1.85; letter-spacing: 0.02em;">
<?php wp_body_open(); ?>

<?php if (has_nav_menu('primary')) : ?>
    <nav class="max-w-6xl mx-auto py-4 mb-20">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container' => false,
            'items_wrap' => '<ul class="flex flex-wrap items-center m-0 p-0 list-none gap-0 text-[1.7rem]">%3$s</ul>',
            'fallback_cb' => false,
        ));
        ?>
    </nav>
<?php endif; ?>

<?php if (is_home() || is_front_page()) : ?>
<header class="max-w-6xl mx-auto mb-20">
    <h1 class="text-[2.4rem] md:text-[2.8rem] font-bold leading-normal mb-3">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-ink hover:opacity-60 transition-all">
            <?php bloginfo('name'); ?>
        </a>
    </h1>
    <?php
    $description = get_bloginfo('description', 'display');
    if ($description || is_customize_preview()) : ?>
        <p class="text-gray-text text-[1.6rem] leading-normal mt-2"><?php echo $description; ?></p>
    <?php endif; ?>
</header>
<?php endif; ?>

<main class="max-w-6xl mx-auto mb-16">
