<?php
if (post_password_required()) {
    return;
}
?>
<!-- Comments -->
<section class="comments">
    <div class="container" data-no-instant>
        <div id="comments" class="comments-area">
            <?php
            if (have_comments()) { ?>
                <ol class="comment-list">
                    <?php wp_list_comments(); ?>
                </ol>
                <?php
                the_comments_navigation(['prev_text' => "Old comments", 'next_text' => "New comments",]);
            } ?>
        </div>
        <?php
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?>
            <p class="no-comments">Comments have been closed.</p>
        <?php }
        comment_form(); ?>
    </div>
</section>

