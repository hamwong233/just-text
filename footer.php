</main>

<footer class="max-w-6xl mx-auto mt-16 pt-16 border-t border-line text-center text-gray-text text-[1.5rem] leading-normal">
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

<div id="image-preview" class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center z-50 cursor-zoom-out overflow-hidden">
    <img id="preview-image" src="" alt="" class="max-w-[90%] max-h-[90%] object-contain transition-transform cursor-move" style="transform-origin: center center;">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-image');
    const contentImages = document.querySelectorAll('.prose-content img');

    let scale = 1;
    let isDragging = false;
    let startX, startY, translateX = 0, translateY = 0;

    contentImages.forEach(img => {
        img.style.cursor = 'pointer';
        img.addEventListener('click', function() {
            previewImg.src = this.src;
            previewImg.alt = this.alt;
            scale = 1;
            translateX = 0;
            translateY = 0;
            previewImg.style.transform = 'scale(1) translate(0, 0)';
            preview.classList.remove('hidden');
            preview.classList.add('flex');
        });
    });

    preview.addEventListener('click', function(e) {
        if (e.target === preview) {
            preview.classList.add('hidden');
            preview.classList.remove('flex');
        }
    });

    previewImg.addEventListener('wheel', function(e) {
        e.preventDefault();
        const delta = e.deltaY > 0 ? -0.1 : 0.1;
        scale = Math.min(Math.max(0.5, scale + delta), 5);
        previewImg.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
    });

    previewImg.addEventListener('mousedown', function(e) {
        if (scale > 1) {
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            previewImg.style.cursor = 'grabbing';
        }
    });

    document.addEventListener('mousemove', function(e) {
        if (isDragging) {
            translateX = e.clientX - startX;
            translateY = e.clientY - startY;
            previewImg.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
        }
    });

    document.addEventListener('mouseup', function() {
        isDragging = false;
        previewImg.style.cursor = 'move';
    });

    const codeBlocks = document.querySelectorAll('.prose-content pre');
    codeBlocks.forEach(block => {
        const button = document.createElement('button');
        button.className = 'code-copy-btn';
        button.textContent = '复制';
        button.addEventListener('click', function() {
            const code = block.querySelector('code') || block;
            navigator.clipboard.writeText(code.textContent).then(() => {
                button.textContent = '已复制';
                button.classList.add('copied');
                setTimeout(() => {
                    button.textContent = '复制';
                    button.classList.remove('copied');
                }, 2000);
            });
        });
        block.appendChild(button);
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>
