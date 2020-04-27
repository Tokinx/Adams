<footer class="footer">
    <section class="container">
        <?php wp_nav_menu(
            array(
                'container' => false,
                'theme_location' => 'footer_nav',
                'depth' => 0
            )
        ); ?>
        <div style="display: flex;justify-content: space-between;">
            <div class='left'>
                <span>&copy; <?= date('Y') ?> <a href="<?= get_bloginfo('url') ?>"><?= get_bloginfo('name') ?></a></span>
                <?php if (get_option('zh_cn_l10n_icp_num')) { ?>
                    <span> . <a href="http://www.beian.miit.gov.cn" target="_blank"><?= get_option('zh_cn_l10n_icp_num') ?></a></span>
                <?php } ?>
            </div>
            <div class='right'>
                <span>Theme by <a href="https://biji.io" target="_blank">Adams</a></span>
            </div>
        </div>
    </section>
</footer>

<div class="setting_tool iconfont">
    <a class="back2top" style="display:none;"><i class="czs-arrow-up-l"></i></a>
    <?php if (!is_home() && !is_front_page()) { ?>
        <a class="home" href="<?php bloginfo('url'); ?>"><i class="czs-home-l"></i></a>
    <?php } ?>
    <a class="sosearch"><i class="czs-search-l"></i></a>
    <a class="socolor"><i class="czs-clothes-l"></i></a>
    <div class="s">
        <form method="get" action="<?php bloginfo('url'); ?>" class="search">
            <input class="search-key" name="s" autocomplete="off" placeholder="输入关键词..." type="text" value="" required="required">
        </form>
    </div>
    <div class="c">
        <ul>
            <li class="color undefined">默认</li>
            <li class="color sepia">护眼</li>
            <li class="color night">夜晚</li>
            <li class="hr"></li>
            <li class="font serif">Serif</li>
            <li class="font sans">Sans</li>
        </ul>
    </div>
</div>

<?php wp_footer(); ?>
<script data-no-instant>
    (function ($) {
        <?php if ( is_user_logged_in() ) { ?>
        $('#wpadminbar').attr('data-no-instant', '')
        <?php } ?>
        $.extend({
            adamsOverload: function () {
                $(".post_article a").attr("rel", "external");
                $("a[rel='external']:not([href^='#']),a[rel='external nofollow']:not([href^='#'])").attr("target", "_blank");
                $("a.vi,.gallery a,.attachment a").attr("rel", "");
                <?php if(!get_theme_mod('biji_setting_viewimage')){ ?>
                $.viewImage({
                    'target': '.gallery a,.gallery img,.attachment a,.post_article img,.post_article a,a.vi',
                    'exclude': '.readerswall img,.gallery a img,.attachment a img',
                    'delay': 300
                });
                <?php } if(!get_theme_mod('biji_setting_lately')){ ?>
                $.lately({
                    'target': '.commentmetadata a,.infos time,.post-list time'
                });
                <?php } if(!get_theme_mod('biji_setting_prettify')){ ?>
                prettyPrint();
                <?php }?>

                $('ul.links li a').each(function () {
                    if ($(this).parent().find('.bg').length === 0) {
                        $(this).parent().append('<div class="bg" style="background-image:url(https://www.google.com/s2/favicons?domain=' + $(this).attr("href") + ')"></div>')
                    }
                });

                // * Safari
                if (navigator.vendor.indexOf("Apple") > -1) {
                    $("[srcset]").each((index, img) => {
                        img.outerHTML = img.outerHTML;
                    });
                }
            }
        });
    })(jQuery);
    <?php if (get_theme_mod('biji_setting_footInfo')) {
        echo get_theme_mod('biji_setting_footInfo') . "\n";
    }
    if(!get_theme_mod('biji_setting_pjax')){ ?>
    InstantClick.on('change', function (isInitialLoad) {
        jQuery.adamsOverload();
        if (isInitialLoad === false) {
            // support MathJax
            if (typeof MathJax !== 'undefined') MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            // support google code prettify
            if (typeof prettyPrint !== 'undefined') prettyPrint();
            // support 百度统计
            if (typeof _hmt !== 'undefined') _hmt.push(['_trackPageview', location.pathname + location.search]);
            // support google analytics
            if (typeof ga !== 'undefined') ga('send', 'pageview', location.pathname + location.search);
        }
        <?php if(!get_theme_mod('biji_setting_placard')){ ?>
        if ($('.placard').length) {
            $.get("https://v1.hitokoto.cn?encode=text", (tetx) => {
                $('.placard').text(tetx);
            });
        }
        <?php }?>
    });
    InstantClick.on('wait', function () {
        // pjax href click
    });
    InstantClick.on('fetch', function () {
        // pjax begin
    });
    InstantClick.on('receive', function () {
        // pjax end
    });
    InstantClick.init('mousedown');
    <?php } else {?>
    jQuery.adamsOverload();
    <?php }?>
</script>
<!--网站效率：<?php timer_stop(4); ?>秒内查询了<?= get_num_queries(); ?>次数据库-->
</body>
</html>
