<section class="alink">
    <div class="container">
        <a href="https://sb.sb/" title="烧饼博客" target="_blank">烧饼博客</a>
        <a href="https://saki.ssl.do/aff.php?aff=106" title="SSL 证书购买" target="_blank">SSL证书</a>
        <a target="_blank" href="http://www.isweetnight.com/ ">sweetnight床垫怎么样</a>
        <a target="_blank" href="http://www.ilangzi.com/">朗姿官网</a>
        <a target="_blank" href="http://www.imengjie.com/">梦洁家纺旗舰店</a>
        <a target="_blank" href="http://www.xiangying.org/">香影官方旗舰店</a>
        <a target="_blank" href="http://www.yanyu3.com/">颜域旗舰店</a>
        <hr>
    </div>
</section>
<section class="container">
    <footer class="footer">
        <?php wp_nav_menu(
            array(
                'container' => false,
                'theme_location' => 'footer_nav',
                'depth' => 0
            )
        );?>
        <p>
            <span class='left'><?php echo '&copy; '.date('Y').' <a href="'.get_bloginfo('url').'">'.get_bloginfo('name').'</a>';
                 if(get_option('zh_cn_l10n_icp_num')) echo " . " . get_option('zh_cn_l10n_icp_num');?></span>
            <span class='right'>Theme by <a href="https://biji.io" target="_blank">Adams</a></span>
        </p>
    </footer>
</section>

<div class="setting_tool iconfont">
    <a class="back2top" style="display:none;">&#xe749;</a>
    <a class="sosearch">&#xe741;</a>
    <a class="socolor">&#xe728;</a>
    <div class="s">
        <form method="get" action="<?php bloginfo('url'); ?>" class="search">
            <input class="search-key" name="s" autocomplete="off" placeholder="Search keywords..." type="text" value="" required="required">
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

<?php wp_footer();?>
<script data-no-instant>
    (function ($) {
        $.extend({
            adamsOverload: function () {
                $('.navigation:eq(0)').remove();
                $(".post_article a").attr("rel" , "external");
                $("a[rel='external'],a[rel='external nofollow']").attr("target","_blank");
                $("a.vi").attr("rel" , "");
<?php if(!get_theme_mod('biji_setting_viewimage')){ ?>
                $.viewImage({
                    'target'  : '.post_article img,.post_article a,a.vi',
                    'exclude' : '.readerswall img',
                    'delay'   : 0
                });
<?php } if(!get_theme_mod('biji_setting_lately')){ ?>
                $.lately({
                    'target' : '.commentmetadata a,.infos time,.post-list time'
                });
<?php }?>
                prettyPrint();
            }
        });
})(jQuery);
<?php if(!get_theme_mod('biji_setting_pjax')){ ?>
    InstantClick.on('change', function(isInitialLoad) {
        jQuery.adamsOverload();
        if (isInitialLoad === false) {
            // support MathJax
            if (typeof MathJax !== 'undefined') MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
            // support google code prettify
            if (typeof prettyPrint !== 'undefined') prettyPrint();
            // support 百度统计
            if (typeof _hmt !== 'undefined') _hmt.push(['_trackPageview', location.pathname + location.search]);
            // support google analytics
            if (typeof ga !== 'undefined') ga('send', 'pageview', location.pathname + location.search);
        }
    });
    InstantClick.on('wait', function() {
        // pjax href click
    });
    InstantClick.on('fetch', function() {
        // pjax begin
    });
    InstantClick.on('receive', function() {
        // pjax end
    });
    InstantClick.init('mousedown');
<?php } else {?>
    jQuery.adamsOverload();
<?php }?>
</script>
<!--网站效率：<?php timer_stop(4);?>秒内查询了<?=get_num_queries();?>次数据库-->
</body>
</html>