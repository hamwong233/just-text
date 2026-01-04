<?php
/**
 * Template Name: 月份归档
 */
get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="mb-16">
            <h1 class="text-[2.8rem] font-bold leading-normal mb-6"><?php the_title(); ?></h1>
            <?php
            $posts_count = wp_count_posts('post')->publish;
            ?>
            <div class="text-gray-light text-[1.6rem] mb-6">
                共发布 <?php echo $posts_count; ?> 篇文章
            </div>
            <?php if (get_the_content()) : ?>
                <div class="text-gray-text text-[1.6rem]">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="archives-container">
            <?php
            global $wpdb;
            $years = $wpdb->get_results("
                SELECT DISTINCT YEAR(post_date) as year
                FROM $wpdb->posts
                WHERE post_status = 'publish'
                AND post_type = 'post'
                ORDER BY year DESC
            ");

            foreach ($years as $year) :
                $year_num = $year->year;
                $year_posts = $wpdb->get_var("
                    SELECT COUNT(*)
                    FROM $wpdb->posts
                    WHERE post_status = 'publish'
                    AND post_type = 'post'
                    AND YEAR(post_date) = $year_num
                ");
                ?>
                <div class="year-section mb-12">
                    <h2 class="text-[2.4rem] font-bold mb-6 pb-4 border-b border-line">
                        <?php echo $year_num; ?> 年
                        <span class="text-[1.6rem] text-gray-light font-normal ml-3"><?php echo $year_posts; ?> 篇</span>
                    </h2>

                    <?php
                    $months = $wpdb->get_results("
                        SELECT DISTINCT MONTH(post_date) as month
                        FROM $wpdb->posts
                        WHERE post_status = 'publish'
                        AND post_type = 'post'
                        AND YEAR(post_date) = $year_num
                        ORDER BY month DESC
                    ");

                    foreach ($months as $month) :
                        $month_num = $month->month;
                        $month_name = date('n', mktime(0, 0, 0, $month_num, 1));

                        $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'year' => $year_num,
                            'monthnum' => $month_num,
                            'orderby' => 'date',
                            'order' => 'DESC',
                        );

                        $month_query = new WP_Query($args);
                        ?>
                        <div class="month-section mb-8">
                            <h3 class="text-[1.8rem] font-bold mb-4 text-gray-text">
                                <?php echo $month_num; ?> 月
                                <span class="text-[1.5rem] font-normal ml-2"><?php echo $month_query->post_count; ?> 篇</span>
                            </h3>

                            <?php if ($month_query->have_posts()) : ?>
                                <ul class="space-y-3">
                                    <?php while ($month_query->have_posts()) : $month_query->the_post(); ?>
                                        <li class="flex items-baseline gap-4">
                                            <time class="text-[1.5rem] text-gray-light shrink-0" datetime="<?php echo get_the_date('c'); ?>">
                                                <?php echo get_the_date('m-d'); ?>
                                            </time>
                                            <a href="<?php the_permalink(); ?>" class="text-[1.6rem] hover:opacity-60 transition-opacity">
                                                <?php the_title(); ?>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <?php if (empty($years)) : ?>
                <p class="text-gray-text text-[1.6rem]">暂无文章。</p>
            <?php endif; ?>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
