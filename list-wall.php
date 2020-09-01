<?php
/*
Template Name: 读者排行
*/
get_header(); ?>
    <section class="container">
        <article class="post_article readerswall" itemscope itemtype="https://schema.org/Article">
            <ul>
                <?php
                $query = "SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 3 MONTH ) AND user_id='0' AND post_password='' AND comment_approved='1' AND comment_type='comment') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 12";
                foreach ($wpdb->get_results($query) as $comment) { ?>
                    <li>
                        <a href="<?= ($comment->comment_author_url ?: 'javascript:void(0);') ?>" target="<?= ($comment->comment_author_url ? '_blank' : '_self') ?>"
                           title="<?= $comment->comment_author ?>（<?= $comment->cnt ?>）">
                            <?= get_avatar($comment->comment_author_email, 160); ?>
                            <span><?= $comment->comment_author ?><br></span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </article>
    </section>
<?php
if (comments_open() || get_comments_number()) :
    comments_template();
endif;
get_footer();
?>