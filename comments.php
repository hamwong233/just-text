<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="mt-16 pt-16 border-t border-line">
    <?php if (have_comments()) : ?>
        <h2 class="text-[2.2rem] font-bold mb-8">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number == 1) {
                echo '1 条评论';
            } else {
                echo $comments_number . ' 条评论';
            }
            ?>
        </h2>

        <ol class="list-none p-0 m-0 mb-12">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 48,
                'callback' => 'just_text_comment',
                'max_depth' => 2,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => '← 较早的评论',
            'next_text' => '较新的评论 →',
        ));
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="text-gray-text text-[1.6rem]">评论已关闭。</p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply' => '<span class="text-[2.2rem] font-bold">发表评论</span>',
        'title_reply_to' => '<span class="text-[2.2rem] font-bold">回复 %s</span>',
        'title_reply_before' => '<h3 id="reply-title" class="mb-8">',
        'title_reply_after' => '</h3>',
        'cancel_reply_link' => '取消回复',
        'cancel_reply_before' => '<span class="text-[1.5rem] ml-4">',
        'cancel_reply_after' => '</span>',
        'label_submit' => '提交评论',
        'comment_field' => '<p class="mb-6"><label for="comment" class="block text-[1.6rem] mb-2">评论内容 <span class="text-red-500">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required class="w-full p-4 border border-line focus:border-ink focus:outline-none text-[1.6rem] bg-paper"></textarea></p>',
        'fields' => array(
            'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6"><div><label for="author" class="block text-[1.6rem] mb-2">姓名 <span class="text-red-500">*</span></label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required class="w-full p-4 border border-line focus:border-ink focus:outline-none text-[1.6rem] bg-paper" /></div>',
            'email' => '<div><label for="email" class="block text-[1.6rem] mb-2">邮箱 <span class="text-red-500">*</span></label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" required class="w-full p-4 border border-line focus:border-ink focus:outline-none text-[1.6rem] bg-paper" /></div></div>',
            'url' => '<p class="mb-6"><label for="url" class="block text-[1.6rem] mb-2">网站</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" class="w-full p-4 border border-line focus:border-ink focus:outline-none text-[1.6rem] bg-paper" /></p>',
        ),
        'class_submit' => 'px-8 py-3 bg-ink text-paper hover:opacity-80 transition-opacity cursor-pointer text-[1.6rem] border-0',
        'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
        'comment_notes_before' => '',
        'comment_notes_after' => '',
    ));
    ?>
</div>
