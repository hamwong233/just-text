<?php
/**
 * Template Name: 分类概览
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-16">
            <h1 class="text-[2.8rem] font-bold leading-normal mb-6"><?php the_title(); ?></h1>
            <?php if (get_the_content()) : ?>
                <div class="text-gray-text text-[1.6rem]">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="categories-overview">
            <?php
            $categories = get_categories(array(
                'orderby' => 'count',
                'order' => 'DESC',
                'hide_empty' => true,
            ));

            if ($categories) :
                ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo get_category_link($category->term_id); ?>"
                           class="block p-6 border border-line hover:border-ink transition-all group">
                            <h3 class="text-[2rem] font-bold mb-3 group-hover:opacity-60 transition-opacity">
                                <?php echo esc_html($category->name); ?>
                            </h3>
                            <div class="text-gray-light text-[1.5rem]">
                                <?php echo $category->count; ?> 篇文章
                            </div>
                            <?php if ($category->description) : ?>
                                <p class="text-gray-text text-[1.5rem] mt-3 line-clamp-2">
                                    <?php echo esc_html($category->description); ?>
                                </p>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="text-gray-text text-[1.6rem]">暂无分类。</p>
            <?php endif; ?>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
