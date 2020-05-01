<?php
/*
Template Name: 文章归档
*/
get_header(); ?>
    <section class="container">
        <article class="post_article archives" itemscope itemtype="https://schema.org/Article">
            <?php
            $previous_year = $year = 0;
            $previous_month = $month = 0;
            $ul_open = false;
            $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
            foreach ($myposts as $post) :
                setup_postdata($post);
                $year = mysql2date('Y', $post->post_date);
                $month = mysql2date('n', $post->post_date);
                $day = mysql2date('j', $post->post_date);
                if ($year != $previous_year) :
                    if ($ul_open) echo '</table>';
                    echo '<h3>' . get_the_time('Y') . '</h3>';
                    echo '<table>';
                    $ul_open = true;
                endif;
                $previous_year = $year;
                $previous_month = $month;
                ?>
                <tr>
                    <td width="80" style="text-align:right;"><?php the_time('m-d'); ?></td>
                    <td><a href="<?php the_permalink(); ?>"><?php the_title(); ?> - <?php comments_number('0', '1', '%'); ?></a></td>
                </tr>
            <?php
            endforeach;
            echo '</table>';
            ?>
    </section>
<?php get_footer(); ?>