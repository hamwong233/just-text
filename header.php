<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {}
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                @apply leading-relaxed;
            }
        }
        @layer components {
            .prose {
                @apply text-gray-700 leading-7;
            }
            .prose p {
                @apply mb-4;
            }
            .prose h1, .prose h2, .prose h3 {
                @apply font-bold text-gray-900 mt-6 mb-3;
            }
            .prose h1 {
                @apply text-3xl;
            }
            .prose h2 {
                @apply text-2xl;
            }
            .prose h3 {
                @apply text-xl;
            }
            .prose a {
                @apply text-gray-900 underline hover:text-gray-600;
            }
            .prose ul, .prose ol {
                @apply mb-4 ml-6;
            }
            .prose ul {
                @apply list-disc;
            }
            .prose ol {
                @apply list-decimal;
            }
            .prose li {
                @apply mb-2;
            }
            .prose blockquote {
                @apply border-l-4 border-gray-300 pl-4 italic my-4;
            }
            .prose code {
                @apply bg-gray-100 px-1 py-0.5 rounded text-sm;
            }
            .prose pre {
                @apply bg-gray-100 p-4 rounded overflow-x-auto mb-4;
            }
            .prose img {
                @apply my-4 rounded;
            }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-white text-gray-900'); ?>>
<?php wp_body_open(); ?>

<header class="max-w-2xl mx-auto px-6 py-12">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold mb-2">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-gray-900 hover:text-gray-600 transition-colors">
                <?php bloginfo('name'); ?>
            </a>
        </h1>
        <?php
        $description = get_bloginfo('description', 'display');
        if ($description || is_customize_preview()) : ?>
            <p class="text-gray-600 text-sm"><?php echo $description; ?></p>
        <?php endif; ?>
    </div>

    <?php if (has_nav_menu('primary')) : ?>
        <nav class="border-t border-b border-gray-200 py-4">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'flex justify-center space-x-6 text-sm',
                'fallback_cb' => false,
            ));
            ?>
        </nav>
    <?php endif; ?>
</header>

<main class="max-w-2xl mx-auto px-6 py-8">
