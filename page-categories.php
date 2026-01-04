<?php
/**
 * Template Name: 分类概览
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-16">
            <h1 class="text-[2.8rem] font-bold leading-normal mb-6"><?php the_title(); ?></h1>
            <?php
            $categories = get_categories(array('hide_empty' => true));
            $total_count = count($categories);
            $total_posts = 0;
            foreach ($categories as $cat) {
                $total_posts += $cat->count;
            }
            ?>
            <div class="text-muted text-[1.6rem] mb-6">
                共有 <?php echo $total_count; ?> 个分类，<?php echo $total_posts; ?> 篇文章
            </div>
            <?php if (get_the_content()) : ?>
                <div class="text-secondary text-[1.6rem]">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="letter-filter mb-12">
            <div class="flex flex-wrap gap-3">
                <?php
                $letters = range('A', 'Z');
                $current_letter = isset($_GET['letter']) ? strtoupper($_GET['letter']) : '';
                foreach ($letters as $letter) :
                    $is_active = ($current_letter === $letter);
                    $class = $is_active
                        ? 'px-4 py-2 text-[1.5rem] bg-primary text-white transition-all'
                        : 'px-4 py-2 text-[1.5rem] border border-divider hover:border-primary transition-all';
                    $url = $is_active ? remove_query_arg('letter') : add_query_arg('letter', $letter);
                    ?>
                    <a href="<?php echo esc_url($url); ?>" class="<?php echo $class; ?>">
                        <?php echo $letter; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="categories-overview">
            <?php
            $letter_filter = isset($_GET['letter']) ? strtoupper($_GET['letter']) : '';

            $categories = get_categories(array(
                'orderby' => 'count',
                'order' => 'DESC',
                'hide_empty' => true,
            ));

            if ($letter_filter) {
                $categories = array_filter($categories, function($cat) use ($letter_filter) {
                    return just_text_term_initial($cat->name) === $letter_filter;
                });
            }

            if ($categories) :
                ?>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($categories as $category) : ?>
                        <a href="<?php echo get_category_link($category->term_id); ?>"
                           class="block p-6 border border-divider hover:border-primary transition-all group">
                            <h3 class="text-[2rem] font-bold mb-3 group-hover:opacity-60 transition-opacity">
                                <?php echo esc_html($category->name); ?>
                            </h3>
                            <div class="text-muted text-[1.5rem]">
                                <?php echo just_text_get_category_post_count($category->term_id); ?> 篇文章
                            </div>
                            <?php if ($category->description) : ?>
                                <p class="text-secondary text-[1.5rem] mt-3 line-clamp-2">
                                    <?php echo esc_html($category->description); ?>
                                </p>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="text-secondary text-[1.6rem] text-center">暂无分类。</p>
            <?php endif; ?>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
