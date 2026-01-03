<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <div class="posts">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('border-b border-line pb-24 mb-24 last:border-0'); ?>>
                <div class="<?php echo has_post_thumbnail() ? 'flex gap-8 items-start' : ''; ?>">
                    <div class="<?php echo has_post_thumbnail() ? 'flex-1' : ''; ?>">
                        <h2 class="text-[2.2rem] font-bold leading-normal mb-8">
                            <?php if (is_sticky()) : ?>
                                <span class="text-[1.6rem] text-gray-text mr-3">置顶</span>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="text-ink hover:opacity-60 transition-all">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="post-info text-gray-light text-[1.6rem] mb-8 flex items-center gap-3 flex-wrap">
                            <time datetime="<?php echo get_the_date('c'); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                            <?php if (has_category()) : ?>
                                <span>·</span>
                                <span class="[&_a]:text-gray-light [&_a]:hover:text-ink [&_a]:transition-colors">
                                    <?php the_category(' · '); ?>
                                </span>
                            <?php endif; ?>
                            <?php if (get_comments_number() > 0) : ?>
                                <span>·</span>
                                <a href="<?php comments_link(); ?>" class="text-gray-light hover:text-ink transition-colors">
                                    <?php comments_number('0 评论', '1 评论', '% 评论'); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="mb-8 leading-relaxed text-[1.8rem]">
                            <?php the_excerpt(); ?>
                        </div>

                        <a href="<?php the_permalink(); ?>" class="text-gray-text text-[1.7rem] border-b border-transparent hover:border-gray-text transition-all inline-block">
                            查看更多 →
                        </a>
                    </div>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="flex-shrink-0 w-80">
                            <a href="<?php the_permalink(); ?>" class="block overflow-hidden rounded-lg h-full">
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover hover:opacity-90 transition-opacity')); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>

    <nav class="mt-20 flex justify-between text-[1.7rem]">
        <div>
            <?php if (get_previous_posts_link()) : ?>
                <a href="<?php echo get_previous_posts_page_link(); ?>" class="text-gray-text border-b border-transparent hover:text-ink hover:border-ink transition-all">
                    ← 较新的文章
                </a>
            <?php endif; ?>
        </div>
        <div>
            <?php if (get_next_posts_link()) : ?>
                <a href="<?php echo get_next_posts_page_link(); ?>" class="text-gray-text border-b border-transparent hover:text-ink hover:border-ink transition-all">
                    较旧的文章 →
                </a>
            <?php endif; ?>
        </div>
    </nav>

<?php else : ?>
    <div class="text-center text-gray-text py-16">
        <p>暂无文章。</p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
