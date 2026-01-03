<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-8">
            <h1 class="text-3xl font-bold mb-4"><?php the_title(); ?></h1>
            <div class="text-sm text-gray-500">
                <time datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date(); ?>
                </time>
            </div>
        </header>

        <div class="prose prose-gray max-w-none leading-relaxed">
            <?php the_content(); ?>
        </div>

        <?php
        wp_link_pages(array(
            'before' => '<div class="mt-8 text-sm">' . __('Pages:', 'just-text'),
            'after'  => '</div>',
        ));
        ?>
    </article>

    <nav class="mt-12 pt-8 border-t border-gray-200 flex justify-between text-sm">
        <div>
            <?php previous_post_link('%link', __('&larr; %title', 'just-text')); ?>
        </div>
        <div>
            <?php next_post_link('%link', __('%title &rarr;', 'just-text')); ?>
        </div>
    </nav>

<?php endwhile; ?>

<?php get_footer(); ?>
