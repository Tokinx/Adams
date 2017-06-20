<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?php bloginfo('template_url'); ?>/style.css?<?php echo THEME_DB_VERSION;?>" type="text/css" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body>
<section class="container">
    <!-- Header -->
    <header role="banner" class="header">
        <hgroup itemscope itemtype="https://schema.org/WPHeader">
            <h1 class="fullname"><?php (is_single() || is_page()) ? the_title() : bloginfo('name'); ?></h1>
        </hgroup>
        <?php
            wp_nav_menu(
                array(
                    'container' => false,
                    'theme_location' => 'social_nav',
                    'items_wrap' => '<nav class="social"><ul id="%1$s" class="%2$s">%3$s</ul></nav>',
                    'walker' => new description_walker(),
                    'depth' => 0
                )
            );
            wp_nav_menu(
                array(
                    'container' => false,
                    'theme_location' => 'header_nav',
                    'depth' => 0
                )
            );
        ?>
    </header>
</section>
    
<section class="infos">
    <div class="container">
    <?php if (is_single() || is_page()) { ?>
        <span><i class="iconfont">&#xe7e7;</i> <time datetime="<?php echo get_the_time('c');?>" itemprop="datePublished" pubdate><?php the_time('Y-m-d') ?></time></span> / 
        <span><i class="iconfont">&#xe7e0;</i> <?php comments_number('0', '1', '%'); ?>评</span> / 
        <a href="javascript:;" data-action="topTop" data-id="<?php the_ID(); ?>" class="dot-good <?php echo isset($_COOKIE['dotGood_' . $post->ID])?'done':''; ?>">
            <i class="iconfont">&#xe7e1;</i>
            <span class="count"><?php echo get_post_meta($post->ID, 'dotGood', true) ? get_post_meta($post->ID, 'dotGood', true) : '0';?></span>赞
        </a>
        
        <div class="donate">
            <a href="javascript:;" class="iconfont">&#xe7e6; 赏</a>
            <div class="window">
                <ul>
                    <?php if (get_option('biji_pay_img_alipay')) echo '<li class="alipay"><img src="' . get_option('biji_pay_img_alipay') . '"/></li>'; ?>
                    <?php if (get_option('biji_pay_img_wexpay')) echo '<li><img src="' . get_option('biji_pay_img_wexpay') . '"/></li>'; ?>
                </ul>
            </div>
        </div>
        
        <div class="share">
            <a href="javascript:;" class="iconfont" data-qrcode="//api.qrserver.com/v1/create-qr-code/?size=150x150&margin=10&data=<?php the_permalink(); ?>">&#xe7db; 码</a>
        </div>
    <?php } else {
        $placard = get_theme_mod('biji_setting_placard');
        echo $placard == '' ? '简单传递美好' : $placard ;
    } ?>
    </div>
</section>