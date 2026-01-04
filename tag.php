<?php get_header(); ?>

<div class="mb-16 pb-16 border-b border-line">
    <h1 class="text-[3rem] font-bold mb-4"><?php single_tag_title(); ?></h1>
    <?php if (tag_description()) : ?>
        <div class="text-gray-text text-[1.8rem] mb-4">
            <?php echo tag_description(); ?>
        </div>
    <?php endif; ?>
    <small class="text-gray-light text-[1.5rem]">共有 <?php echo $wp_query->found_posts; ?> 篇文章</small>
</div>

<?php if (have_posts()) : ?>
    <div class="posts">
        <?php while (have_posts()) : the_post(); ?>
            <?php just_text_post_card(); ?>
        <?php endwhile; ?>
    </div>

    <?php just_text_pagination(); ?>

<?php else : ?>
    <div class="text-center text-gray-text py-16">
        <p>该标签下暂无文章。</p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
