<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-16">
            <h1 class="text-[2.8rem] font-bold leading-normal mb-6"><?php the_title(); ?></h1>
            <div class="text-gray-light text-[1.6rem] flex items-center gap-3 flex-wrap">
                <time datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date(); ?>
                </time>
                <?php if (has_category()) : ?>
                    <span>·</span>
                    <?php the_category(' · '); ?>
                <?php endif; ?>
            </div>
        </header>

        <div class="prose-content">
            <?php the_content(); ?>
        </div>

        <?php if (has_tag()) : ?>
            <div class="mt-16 pt-12 border-t border-line">
                <div class="text-gray-light text-[1.6rem]">
                    <span class="mr-2">标签：</span>
                    <?php the_tags('', ' · ', ''); ?>
                </div>
            </div>
        <?php endif; ?>
    </article>

    <nav class="mt-20 pt-16 border-t border-line flex justify-between text-[1.6rem]">
        <div class="max-w-[45%]">
            <?php previous_post_link('%link', '← %title', true); ?>
        </div>
        <div class="max-w-[45%] text-right">
            <?php next_post_link('%link', '%title →', true); ?>
        </div>
    </nav>

<?php endwhile; ?>

<?php get_footer(); ?>
