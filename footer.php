</main>

<footer class="max-w-2xl mx-auto px-6 py-12 mt-16 border-t border-[#d4cdb8]">
    <div class="text-center text-sm text-[#6b6b6b] space-y-2">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'just-text'); ?></p>
        <?php
        $icp_number = get_theme_mod('icp_filing_number');
        if ($icp_number) : ?>
            <p>
                <a href="https://beian.miit.gov.cn/" target="_blank" rel="noopener noreferrer" class="hover:text-[#3d3d3d] transition-colors">
                    <?php echo esc_html($icp_number); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
