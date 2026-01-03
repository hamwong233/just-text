<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <div class="space-y-12">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('border-b border-[#d4cdb8] pb-12 last:border-0'); ?>>
                <header class="mb-4">
                    <h2 class="text-2xl font-bold mb-2">
                        <a href="<?php the_permalink(); ?>" class="text-[#3d3d3d] hover:text-[#6b6b6b] transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="text-sm text-[#8b8b8b]">
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                    </div>
                </header>

                <div class="prose prose-gray max-w-none">
                    <?php the_excerpt(); ?>
                </div>

                <a href="<?php the_permalink(); ?>" class="inline-block mt-4 text-sm text-[#6b6b6b] hover:text-[#3d3d3d] transition-colors">
                    <?php _e('Read more &rarr;', 'just-text'); ?>
                </a>
            </article>
        <?php endwhile; ?>
    </div>

    <nav class="mt-12 flex justify-between text-sm">
        <div>
            <?php previous_posts_link(__('&larr; Newer posts', 'just-text')); ?>
        </div>
        <div>
            <?php next_posts_link(__('Older posts &rarr;', 'just-text')); ?>
        </div>
    </nav>

<?php else : ?>
    <div class="text-center py-12">
        <p class="text-[#6b6b6b]"><?php _e('No posts found.', 'just-text'); ?></p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
