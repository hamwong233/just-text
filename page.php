<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-12">
            <h1 class="text-[2.8rem] font-bold leading-normal"><?php the_title(); ?></h1>
        </header>

        <div class="prose-content">
            <?php the_content(); ?>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
