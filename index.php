<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <div class="posts">
        <?php while (have_posts()) : the_post(); ?>
            <?php just_text_post_card(); ?>
        <?php endwhile; ?>
    </div>

    <?php just_text_pagination(); ?>

<?php else : ?>
    <div class="text-center text-gray-text py-16">
        <p>暂无文章。</p>
    </div>
<?php endif; ?>

<?php get_footer(); ?>
