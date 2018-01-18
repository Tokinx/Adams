<footer class="footer">
	<section class="container">
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
	</section>
</footer>



<div class="setting_tool iconfont">
    <a class="back2top" style="display:none;"><i class="czs-arrow-up-l"></i></a>
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
                    'delay'   : 300
                });
<?php } if(!get_theme_mod('biji_setting_lately')){ ?>
                $.lately({
                    'target' : '.commentmetadata a,.infos time,.post-list time'
                });
<?php }?>
                prettyPrint();
                
                $('ul.links li a').each(function(){
                    if($(this).parent().find('.bg').length==0){
                        $(this).parent().append('<div class="bg" style="background-image:url(https://www.google.com/s2/favicons?domain='+$(this).attr("href")+')"></div>')
                    }
                });
            }
        });
    })(jQuery);
<?php if(get_theme_mod('biji_setting_footInfo')){ 
        echo get_theme_mod('biji_setting_footInfo') . "\n";
    }
    if(!get_theme_mod('biji_setting_pjax')){ ?>
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