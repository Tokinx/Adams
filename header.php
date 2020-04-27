<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?php bloginfo('template_url'); ?>/style.css?<?php echo THEME_DB_VERSION; ?>" type="text/css" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/static/caomei/style.css?<?php echo THEME_DB_VERSION; ?>" type="text/css" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body>
<script>
    <?php if(get_theme_mod('biji_setting_auto_mode')){ ?>
    document.addEventListener("DOMContentLoaded", (event) => {
        let mode = getComputedStyle(document.documentElement).getPropertyValue('content');
        if (mode.indexOf('dark') > -1 && !$('body').is('.night')) {
            $('.setting_tool .c ul li.night').click()
        }
        if (mode.indexOf('light') > -1 && !$('body').is('.undefined')) {
            $('.setting_tool .c ul li.undefined').click()
        }
    });
    <?php } ?>
    $("body").addClass(localStorage.adams_color_style || "").addClass(localStorage.adams_font_style || "");
</script>
<!-- Header -->
<header class="header">
    <section class="container">
        <hgroup itemscope itemtype="https://schema.org/WPHeader">
            <h1 class="fullname"><?php (!is_home()) ? wp_title("") : bloginfo('name'); ?></h1>
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
                'items_wrap' => '<nav class="header_nav"><ul id="%1$s" class="%2$s">%3$s</ul></nav>',
                'depth' => 0
            )
        );
        ?>
    </section>

    <section class="infos">
        <div class="container">
            <?php if (is_single() || is_page()) { ?>
                <h2 class="fixed-title"></h2>
                <!--<div class="fixed-menus"></div>-->

                <div class="fields">
                    <span><i class="czs-time-l"></i> <time datetime="<?php echo get_the_time('c'); ?>" title="<?php echo get_the_time('c'); ?>"
                                                           itemprop="datePublished" pubdate><?php the_time('Y-m-d') ?></time></span> /
                    <span><i class="czs-talk-l"></i> <?php comments_number('0', '1', '%'); ?>评</span> /
                    <a href="javascript:;" data-action="topTop" data-id="<?php the_ID(); ?>"
                       class="dot-good <?php echo isset($_COOKIE['dotGood_' . $post->ID]) ? 'done' : ''; ?>">
                        <i class="czs-thumbs-up-l"></i><i class="czs-thumbs-up"></i>
                        <span class="count"><?php echo get_post_meta($post->ID, 'dotGood', true) ? get_post_meta($post->ID, 'dotGood', true) : '0'; ?></span>赞
                    </a>
                </div>

                <div class="socials">
                    <div class="donate">
                        <a href="javascript:;"><i class="czs-coin-l s"></i><i class="czs-coin h"></i> 赏</a>
                        <div class="window">
                            <ul>
                                <?php if (get_option('biji_pay_img_alipay')) echo '<li class="alipay"><img src="' . get_option('biji_pay_img_alipay') . '"/></li>'; ?>
                                <?php if (get_option('biji_pay_img_wexpay')) echo '<li><img src="' . get_option('biji_pay_img_wexpay') . '"/></li>'; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="share">
                        <a href="javascript:void(0);"
                           data-qrcode="//api.qrserver.com/v1/create-qr-code/?size=150x150&margin=10&data=<?php the_permalink(); ?>">
                            <i class="czs-scan-l s"></i><i class="czs-qrcode-l h"></i> 码</a>
                    </div>
                </div>
            <?php } else { ?>
                <h2 class="fixed-title"></h2>
                <div class="fixed-menus"></div>
                <div class="placard">
                    <?= get_theme_mod('biji_setting_placard'); ?>
                </div>
            <?php } ?>
        </div>
    </section>
</header>