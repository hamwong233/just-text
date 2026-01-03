<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-8">
            <h1 class="text-3xl font-bold"><?php the_title(); ?></h1>
        </header>

        <div class="prose prose-gray max-w-none leading-relaxed">
            <?php the_content(); ?>
        </div>

        <?php
        wp_link_pages(array(
            'before' => '<div class="mt-8 text-sm">' . __('Pages:', 'just-text'),
            'after'  => '</div>',
        ));
        ?>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
