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
                @apply text-[#4a4a4a] leading-7;
            }
            .prose p {
                @apply mb-4;
            }
            .prose h1, .prose h2, .prose h3 {
                @apply font-bold text-[#3d3d3d] mt-6 mb-3;
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
                @apply text-[#3d3d3d] underline hover:text-[#6b6b6b];
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
                @apply border-l-4 border-[#d4cdb8] pl-4 italic my-4;
            }
            .prose code {
                @apply bg-[#ebe7dc] px-1 py-0.5 rounded text-sm;
            }
            .prose pre {
                @apply bg-[#ebe7dc] p-4 rounded overflow-x-auto mb-4;
            }
            .prose img {
                @apply my-4 rounded;
            }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-[#f5f1e8] text-[#3d3d3d]'); ?>>
<?php wp_body_open(); ?>

<header class="max-w-2xl mx-auto px-6 py-12">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold mb-2">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-[#3d3d3d] hover:text-[#6b6b6b] transition-colors">
                <?php bloginfo('name'); ?>
            </a>
        </h1>
        <?php
        $description = get_bloginfo('description', 'display');
        if ($description || is_customize_preview()) : ?>
            <p class="text-[#6b6b6b] text-sm"><?php echo $description; ?></p>
        <?php endif; ?>
    </div>

    <?php if (has_nav_menu('primary')) : ?>
        <nav class="border-t border-b border-[#d4cdb8] py-4">
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
