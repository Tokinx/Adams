<?php
/*
Template Name: 读者排行
*/
get_header();?>
<section class="section content main-load">
    <div class="container">
        <article class="post_article readerswall" itemscope itemtype="https://schema.org/Article">
            <?php
                $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH ) AND user_id='0' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 24";
                $wall = $wpdb->get_results($query);
                $maxNum = $wall[0]->cnt;
                foreach ($wall as $comment)
                {
                    if( $comment->comment_author_url )
                    $url = $comment->comment_author_url;
                    else $url="#";
                    $tmp = "<li>
                        <a href='".$url."' target='_blank' title='".$comment->comment_author." (".$comment->cnt.")'>".get_avatar($comment->comment_author_email, 80)."
                            <span>".$comment->comment_author."<br></span>
                        </a>
                    </li>";
                    $output .= $tmp;
                 }
                $output = "<ul>".$output."</ul>";
                echo $output ;
            ?>
        </article>
    </div>
</section>
<?php
    include("comment.php");
    get_footer();
?>