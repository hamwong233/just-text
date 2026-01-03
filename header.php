<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
