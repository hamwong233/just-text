<?php
/**
 * Template Name: 标签概览
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-16">
            <h1 class="text-[2.8rem] font-bold leading-normal mb-6"><?php the_title(); ?></h1>
            <?php
            $tags = get_tags(array('hide_empty' => true));
            $total_count = count($tags);
            $total_posts = 0;
            foreach ($tags as $tag) {
                $total_posts += $tag->count;
            }
            ?>
            <div class="text-muted text-[1.6rem] mb-6">
                共有 <?php echo $total_count; ?> 个标签，<?php echo $total_posts; ?> 篇文章
            </div>
            <?php if (get_the_content()) : ?>
                <div class="text-secondary text-[1.6rem]">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        </header>

        <?php just_text_letter_filter(); ?>

        <div class="tags-overview">
            <?php
            $letter_filter = isset($_GET['letter']) ? strtoupper($_GET['letter']) : '';

            $tags = get_tags(array(
                'orderby' => 'count',
                'order' => 'DESC',
                'hide_empty' => true,
            ));

            if ($letter_filter) {
                $tags = array_filter($tags, function($tag) use ($letter_filter) {
                    return just_text_term_initial($tag->name) === $letter_filter;
                });
            }

            usort($tags, function($a, $b) {
                return $b->count - $a->count;
            });

            if ($tags) :
                ?>
                <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($tags as $tag) : ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>"
                           class="block p-6 border border-divider hover:border-primary transition-all group">
                            <h3 class="text-[2rem] font-bold mb-3 group-hover:opacity-60 transition-opacity truncate">
                                <?php echo esc_html($tag->name); ?>
                            </h3>
                            <div class="text-muted text-[1.5rem]">
                                <?php echo $tag->count; ?> 篇文章
                            </div>
                            <?php if ($tag->description) : ?>
                                <p class="text-secondary text-[1.5rem] mt-3 line-clamp-2">
                                    <?php echo esc_html($tag->description); ?>
                                </p>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="text-secondary text-[1.6rem] text-center">暂无标签。</p>
            <?php endif; ?>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
