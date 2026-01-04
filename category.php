<?php get_header(); ?>

<div class="mb-16 pb-16 border-b border-divider">
    <h1 class="text-[3rem] font-bold mb-4"><?php single_cat_title(); ?></h1>
    <?php if (category_description()) : ?>
        <div class="text-secondary text-[1.8rem] mb-4">
            <?php echo category_description(); ?>
        </div>
    <?php endif; ?>
    <small class="text-muted text-[1.5rem]">共有 <?php echo $wp_query->found_posts; ?> 篇文章</small>
</div>

<?php if (have_posts()) : ?>
    <div class="posts">
        <?php while (have_posts()) : the_post(); ?>
            <?php just_text_post_card(); ?>
        <?php endwhile; ?>
    </div>

    <?php just_text_pagination(); ?>

<?php else : ?>
    <div class="text-center text-secondary py-16">
        <p>该分类下暂无文章。</p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
