</main>

<footer class="max-w-5xl mx-auto mt-16 pt-16 border-t border-line text-center text-gray-text text-[1.5rem] leading-normal">
    <p class="mb-2">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 保留所有权利。</p>
    <?php
    $icp_number = get_theme_mod('icp_filing_number');
    if ($icp_number) : ?>
        <p>
            <a href="https://beian.miit.gov.cn/" target="_blank" rel="noopener noreferrer" class="border-b border-transparent hover:border-gray-text transition-colors">
                <?php echo esc_html($icp_number); ?>
            </a>
        </p>
    <?php endif; ?>
</footer>

<?php wp_footer(); ?>
</body>
</html>
