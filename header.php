<!DOCTYPE html>
<html <?php language_attributes(); ?>>
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
            @apply mt-0;
        }

        .prose-content > *:last-child {
            @apply mb-0;
        }

        .prose-content p {
            @apply leading-relaxed mb-6;
        }

        .prose-content > p:empty {
            display: none;
        }

        .prose-content h1,
        .prose-content h2,
        .prose-content h3,
        .prose-content h4,
        .prose-content h5,
        .prose-content h6 {
            @apply leading-tight font-bold clear-both;
            margin: 40px 0 24px;
            letter-spacing: 0.02em;
        }

        .prose-content h1:first-child,
        .prose-content h2:first-child,
        .prose-content h3:first-child {
            margin-top: 0;
        }

        .prose-content h1 { @apply text-[2.6rem]; }
        .prose-content h2 { @apply text-[2.2rem]; }
        .prose-content h3 { @apply text-[2rem]; }
        .prose-content h4 { @apply text-[1.8rem]; }
        .prose-content h5,
        .prose-content h6 { @apply text-[1.6rem]; }

        .prose-content a {
            @apply border-b border-current hover:opacity-60 transition-opacity;
        }

        .prose-content ul,
        .prose-content ol {
            @apply my-6 ml-6;
        }

        .prose-content ul {
            list-style-type: disc;
        }

        .prose-content ol {
            list-style-type: decimal;
        }

        .prose-content li {
            @apply leading-relaxed my-2;
            padding-left: 0.5em;
        }

        .prose-content li > p {
            @apply my-2;
        }

        .prose-content ul ul,
        .prose-content ol ol,
        .prose-content ul ol,
        .prose-content ol ul {
            @apply my-2;
        }

        .prose-content blockquote {
            @apply bg-[#fbf3e7] border-l-4 border-[#dcbb85] my-8 px-6 py-5 rounded-r;
        }

        .prose-content blockquote p {
            @apply mb-4;
        }

        .prose-content blockquote p:last-child {
            @apply mb-0;
        }

        .prose-content strong,
        .prose-content b {
            @apply font-bold;
        }

        .prose-content em,
        .prose-content i {
            @apply italic;
        }

        .prose-content del,
        .prose-content s {
            @apply line-through;
        }

        .prose-content mark {
            @apply bg-[#ffecaa] px-1;
        }

        .prose-content small {
            @apply text-[1.4rem];
        }

        .prose-content sub,
        .prose-content sup {
            @apply text-[1.2rem];
        }

        .prose-content abbr {
            @apply border-b border-dotted border-current cursor-help;
        }

        .prose-content kbd {
            @apply bg-black/10 px-2 py-1 rounded text-[1.4rem] border border-black/20;
            font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        }

        .prose-content dl {
            @apply my-6;
        }

        .prose-content dt {
            @apply font-bold mt-4 first:mt-0;
        }

        .prose-content dd {
            @apply ml-6 mt-2;
        }

        .prose-content .wp-block-heading {
            @apply leading-tight font-bold clear-both;
            margin: 40px 0 24px;
            letter-spacing: 0.02em;
        }

        .prose-content .wp-block-heading:first-child {
            margin-top: 0;
        }

        .prose-content figure.wp-block-image {
            @apply my-8 mx-0;
        }

        .prose-content figure.wp-block-image img {
            @apply w-full h-auto rounded-lg block;
        }

        .prose-content figure.wp-block-image.size-full img,
        .prose-content figure.wp-block-image.size-large img {
            @apply max-w-full;
        }

        .prose-content .wp-block-image figcaption {
            @apply text-gray-light text-[1.5rem] text-center mt-3;
        }

        .prose-content .wp-block-quote {
            @apply bg-[#fbf3e7] border-l-4 border-[#dcbb85] my-8 px-6 py-5 rounded-r;
        }

        .prose-content .wp-block-code {
            @apply bg-[#222] text-[#ffecaa] text-[1.5rem] my-8 p-6 rounded-lg leading-relaxed overflow-x-auto;
        }

        .prose-content .wp-block-table {
            @apply my-8;
        }

        .prose-content .wp-block-table table {
            @apply w-full border-collapse;
        }

        .prose-content .wp-block-gallery {
            @apply my-8 grid gap-4;
        }

        .prose-content .wp-block-gallery.columns-2 {
            @apply grid-cols-2;
        }

        .prose-content .wp-block-gallery.columns-3 {
            @apply grid-cols-3;
        }

        .prose-content .wp-block-gallery.columns-4 {
            @apply grid-cols-4;
        }

        .prose-content hr {
            @apply border-0 border-t border-line my-12;
        }

        .prose-content code {
            @apply bg-black/10 px-1.5 py-0.5 rounded text-[1.5rem];
            font-family: 'Menlo', 'Monaco', 'Courier New', monospace;
        }

        .prose-content pre {
            @apply bg-[#222] text-[#ffecaa] text-[1.5rem] my-8 p-6 rounded-lg leading-relaxed overflow-x-auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .prose-content pre code {
            @apply bg-transparent p-0 text-[1.5rem];
        }

        .prose-content img {
            @apply max-w-full h-auto my-8 rounded-lg;
        }

        .prose-content figure {
            @apply my-8;
        }

        .prose-content figcaption {
            @apply text-gray-light text-[1.5rem] text-center mt-3;
        }

        .prose-content table {
            @apply w-full my-8 border-collapse;
        }

        .prose-content th,
        .prose-content td {
            @apply border border-line px-4 py-3 text-left;
        }

        .prose-content th {
            @apply bg-black/5 font-bold;
        }

        .prose-content tbody tr:nth-child(even) {
            @apply bg-black/[0.02];
        }
    </style>
    <?php wp_head(); ?>
</head>
<body class="bg-paper text-ink leading-relaxed tracking-wide p-5" style="font-size: 1.7rem; line-height: 1.85; letter-spacing: 0.02em;">
<?php wp_body_open(); ?>

<?php if (has_nav_menu('primary')) : ?>
    <nav class="max-w-5xl mx-auto py-4 mb-20">
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
<header class="max-w-5xl mx-auto mb-20">
    <h1 class="text-[2.8rem] font-bold leading-normal mb-3">
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

<main class="max-w-5xl mx-auto mb-16">
