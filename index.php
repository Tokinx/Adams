<?php get_header(); ?>

<!-- Post List -->
<section class="posts main-load">
    <div class="container">
        <div class="post-list">
            <?php if (have_posts()) {
                while (have_posts()): the_post(); ?>
                    <article class="meta" itemscope="" itemtype="http://schema.org/BlogPosting">
                        <header>
                            <a href="<?php the_permalink(); ?>" itemprop="url"><h2 itemprop="name headline"><?php the_title(); ?></h2></a>
                        </header>
                        <main>
                            <?php if (get_theme_mod('biji_setting_thumb') && post_thumbnail(0, 0)) { ?>
                                <a href="<?php the_permalink(); ?>" class="thumb"
                                   style="background-image: url('<?php echo post_thumbnail(200, 140); ?>');"></a>
                            <?php }; ?>
                            <p itemprop="articleBody">
                                <?php if (post_password_required()) {
                                    the_content();
                                } else {
                                    echo mb_strimwidth(strip_shortcodes(strip_tags(apply_filters('the_content', $post->post_excerpt ?: $post->post_content))), 0, 220, '...');
                                } ?>
                            </p>
                        </main>
                        <footer>
                            <span class="time"><time datetime="<?php echo get_the_time('c'); ?>" title="<?php echo get_the_time('c'); ?>"
                                                     itemprop="datePublished" pubdate><?php the_time('Y-m-d'); ?></time>发布</span>
                            <span class="hr"></span>
                            <span class="comments"><?php comments_number('0', '1', '%'); ?> 条评论</span>
                            <?php echo get_post_meta($post->ID, 'dotGood', true) ? '<span class="hr"></span><span class="likes">' . get_post_meta($post->ID, 'dotGood', true) . ' 人喜欢</span>' : ''; ?>
                        </footer>
                    </article>
                <?php endwhile;
            } else { ?>
                <article class="meta">
                    <h3 style="font-size: 3em;margin: 0 0 20px;">Sorry!</h3>
                    <p>这个页面没有你要找的内容。</p>
                </article>
            <?php }; ?>
            <nav class="reade_more">
                <?php if (function_exists('pagenavi')) {
                    pagenavi(1);
                } ?>
            </nav>
        </div>
    </div>
</section>
<?php get_footer(); ?>
