<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-16">
            <h1 class="text-[2.8rem] font-bold leading-normal mb-6"><?php the_title(); ?></h1>
            <div class="text-muted text-[1.6rem] flex items-center gap-3 flex-wrap mb-4">
                <time datetime="<?php echo get_the_date('c'); ?>">
                    <?php echo get_the_date(); ?>
                </time>
                <?php if (has_category()) : ?>
                    <span>·</span>
                    <?php the_category(' · '); ?>
                <?php endif; ?>
            </div>
            <div class="text-muted text-[1.5rem]">
                <?php
                $content = get_post_field('post_content', get_the_ID());
                $word_count = mb_strlen(strip_tags($content), 'UTF-8');
                $reading_time = just_text_reading_time();
                ?>
                全文共 <?php echo number_format($word_count); ?> 字，阅读约需 <?php echo $reading_time; ?> 分钟
            </div>
        </header>

        <div class="prose-content">
            <?php
            the_content();

            wp_link_pages(array(
                'before' => '<nav class="mt-12 pt-8 border-t border-divider"><div class="text-[1.6rem] text-secondary mb-4">文章分页：</div><div class="flex flex-wrap gap-3">',
                'after' => '</div></nav>',
                'link_before' => '<span class="inline-block px-4 py-2 border border-divider hover:border-primary transition-colors">',
                'link_after' => '</span>',
                'next_or_number' => 'number',
                'separator' => '',
            ));
            ?>
        </div>

        <?php if (has_tag()) : ?>
            <div class="mt-16 pt-12 border-t border-divider">
                <div class="text-muted text-[1.6rem]">
                    <span class="mr-2">标签：</span>
                    <?php the_tags('', ' · ', ''); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>
    </article>

    <nav class="mt-20 pt-16 border-t border-divider flex flex-col md:flex-row md:justify-between gap-4 text-[1.6rem]">
        <div class="md:max-w-[45%]">
            <?php previous_post_link('%link', '← %title', true); ?>
        </div>
        <div class="md:max-w-[45%] md:text-right">
            <?php next_post_link('%link', '%title →', true); ?>
        </div>
    </nav>

<?php endwhile; ?>

<?php get_footer(); ?>
