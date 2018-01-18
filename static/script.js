var _let = [];
/**
 * ViewImage.min.js
 * https://tokinx.github.io/ViewImage/
 */
!function(a){a.extend({viewImage:function(b){var c=a.extend({target:".view-image img",exclude:"",delay:300},b);a(c.exclude).attr("view-image",!1),a(c.target).click(function(){var b=a(this).attr("src"),d=a(this).attr("href"),e="",f="<style class='view-image-css'>.view-img{position:fixed;background:#fff;background:rgba(255,255,255,.92);width:100%;height:100%;top:0;left:0;text-align:center;padding:2%;z-index:999;cursor: zoom-out}.view-img img,.view-img span{max-width:100%;max-height:100%;position:relative;top:50%;transform: translateY(-50%);}.view-img span{height:2em;color:#AAB2BD;overflow:hidden;position:absolute;top:50%;left:0;right:0;width:120px;text-align:center;margin:-1em auto;}.view-img span:after{content:'';position:absolute;bottom:0;left:0;transform: translateX(-100%);width:100%;height:2px;background:#3274ff;animation:view-img-load .8s -0.1s ease-in-out infinite;}@keyframes view-img-load{0%{transform: translateX(-100%);}100%{transform: translateX(100%);}}</style>";return a(this).attr("view-image")||a(this).attr("rel")?void 0:(e=b?b:d,a("body").append(f+"<div class='view-img'><span>loading...</span></div>"),setTimeout(function(){var b=new Image;b.src=e,b.onload=function(){a(".view-img").html("<img src="+this.src+">")},a(".view-img").click(function(){a(".view-image-css").remove(),a(".view-img").remove()})},c.delay),!1)})}})}(jQuery);

/**
 * lately.min.js v1.0.2
 * https://tokinx.github.io/lately/
 */
(function(a){a.extend({lately:function(e){function l(a){a=new Date(a);a=((new Date).getTime()-a.getTime())/1E3;var b=a/60,d=b/60,e=d/24,f=e/30,g=f/12,h=Math.floor;return(1<=g?h(g)+c.lang.year:1<=f?h(f)+c.lang.month:1<=e?h(e)+c.lang.day:1<=d?h(d)+c.lang.hour:1<=b?h(b)+c.lang.minute:1<=a?h(a)+c.lang.second:c.lang.error)+c.lang.ago}var c=a.extend({target:".designation time",lang:{second:"\u79d2",minute:"\u5206\u949f",hour:"\u5c0f\u65f6",day:"\u5929",month:"\u4e2a\u6708",year:"\u5e74",ago:"\u524d",error:"NaN"}},
e);e=a(c.target);for(var k=0;k<e.length;k++){var d=a(e[k]),b="";if(a(d).is(":visible")){var b=a(d).attr("datetime"),f=a(d).attr("title"),g=a(d).html();if(!b||isNaN(new Date(b=b.replace(/(.*)[a-z](.*)\+(.*)/gi,"$1 $2").replace(/-/g,"/"))))if(f&&!isNaN(new Date(f=f.replace(/-/g,"/"))))b=f;else if(g&&!isNaN(new Date(g=g.replace(/-/g,"/"))))b=g;else break;a(d).html(l(b))}}}})})(jQuery);

/*
(function () {
    var link_element = document.createElement("link"),
        s = document.getElementsByTagName("script")[0];
    link_element.href += "//fonts.proxy.ustclug.org/css?family=Exo+2:100italic,100,200italic,200,300italic,300,400italic,400,500italic,500,600italic,600,700italic,700,800italic,800,900italic,900";
    link_element.rel = "stylesheet";
    link_element.type = "text/css";
    s.parentNode.insertBefore(link_element, s);
})();
*/

(function ($) {
    
    $(window).bind("scroll", function () {
        if ($(this).scrollTop() > 200) {
            $(".back2top").show();
            
            if(!$(".infos").hasClass('fixed')){
                $(".infos").addClass('fixed');
                $(".infos .fixed-title").html($('h1.fullname').html());
                $(".infos .fixed-menus").html($('nav.header_nav').html());
            }
        } else {
            $(".back2top").hide();
            
            if($(".infos").hasClass('fixed')){
                $(".infos").removeClass('fixed');
            }
        }
        _let.scroll_top = $(this).scrollTop();
    });
    $(document).on('click', '.setting_tool a', function (e) {
        if($(this).is('.back2top')){
            return $("html,body").animate({ scrollTop: 0 }, 400);
        } else {
            _let.st = $('.setting_tool');
            if($(this).is('.sosearch') && !_let.st.is('.search')){
                _let.st.addClass('search');
            } else if($(this).is('.socolor') && !_let.st.is('.colors')){
                _let.st.addClass('colors');
            } else {
                _let.st.removeClass('search');
                _let.st.removeClass('colors');
            }
        }
    });
    $(document).on('click', '.setting_tool .c ul li', function (e) {
        _let.lis = $(this);
        if(_let.lis.is('.sepia')){
            localStorage.adams_color_style = "a,.archives tr a,ul.link-items li a,.readerswall li a{color:#b38a60}.view-img span,a:hover,.archives tr a:hover,ul.link-items li a:hover,.readerswall li a:hover{color:#704214 !important;}body,.post-list .meta header h2,.infos.fixed .fixed-title,.infos,.infos.donate-close .donate .window,.infos.share-close .qrcode{background:#f3eacb;color:#704214}.infos.donate-close .donate .window,.infos.share-close .qrcode{box-shadow:0 2px 3px rgba(112,66,20,0.2);}.alink hr{background:#eae0be}.header h1,.current-menu-item a,.current_page_item a,.current-menu-parent a,.current-post-parent a,.social *{color:#704214;}.header .menu li:after,.footer .menu li:after{background:#a98c51}.infos:before,.infos:after{background:#eae0be;}.infos.fixed{box-shadow:0 2px 3px rgba(169,140,81,0.1)}.alink{border-top:1px solid #eae0be}.post-list .meta header h2:hover{color:#361e07}.post-list .reade_more a:hover{background:#704214;text-decoration:none}.comment .comment{border-left:1px solid #a98c51}.post_article ol,.post_article ul{background:#eae0be}.post-list .meta footer span,.comment-meta a,.comment-author span,.infos,.infos a{color:#a98c51}.comment .comment-author .avatar,.comment .comment-author:before,#commentform input,#commentform textarea,#commentform input#submit:focus{background:#f3eacb;border:1px solid #a98c51;color:#a98c51}#commentform textarea:focus,#commentform input:focus,#commentform input#submit:hover{border-color:#704214}#commentform input#submit:hover{background:#704214}.nearbypost{box-shadow:0 1px 0 #a98c51,0 -1px 0 #a98c51}.nearbypost div.alignright{box-shadow:-1px 0 0 #a98c51}.archives table,.archives tr,.archives td{color:#704214}.post-list .reade_more .page-numbers,.post-list .reade_more .page-numbers:hover,.post-list .reade_more span.page-numbers{background:none;box-shadow:0 0 0 1px #a98c51 inset}.view-img span:after,.post-list .reade_more .page-numbers:hover,.post-list .reade_more span.page-numbers{background:#704214 !important;box-shadow:none;}.view-img{background:rgba(169,140,81,.96) !important;}";
        } else if(_let.lis.is('.night')){
            localStorage.adams_color_style = ".post_article ol,.post_article ul,blockquote,q,code{background:rgba(255,255,255,.06);box-shadow:0 0 0 1px rgba(255,255,255,.1)}a,.archives tr a,ul.link-items li a,.readerswall li a{color:#666e8e}a:hover,.archives tr a:hover,ul.link-items li a:hover,.readerswall li a:hover{color:#bdcadb}body,.post-list .meta header h2,.infos.fixed .fixed-title,.infos,.infos.donate-close .donate .window,.infos.share-close .qrcode{background:#1c1f2b;color:#bdcadb;}.infos.donate-close .donate .window,.infos.share-close .qrcode{box-shadow:0 1px 0 #393f56,-1px 0 0 #393f56,1px 0 0 #393f56;}.header:after,.header .menu li:after,.footer .menu li:after,.alink hr{background:#393f56}.header h1,.current-menu-item a,.current_page_item a,.current-menu-parent a,.current-post-parent a,.social *{color:#bdcadb;}.infos:before,.infos:after{background:#393f56;}.post-list .reade_more .page-numbers,.post-list .reade_more .page-numbers:hover,.post-list .reade_more span.page-numbers{background:#393f56;box-shadow:none;color:#bdcadb;}.post-list .reade_more .page-numbers:hover,.post-list .reade_more span.page-numbers{background:#666e8e;}.infos.fixed{box-shadow:0 2px 3px rgba(0,0,0,0.2)}.alink{border-top:1px solid #393f56}.post-list .meta header h2:hover{color:#fff}.post-list .reade_more a,.post-list .reade_more a:hover{background:#666e8e;color:#1c1f2b}.post-list .reade_more a:hover{color:#fff}.comment .comment{border-left:1px solid #393f56}.post-list .meta footer span,.comment-meta a,.comment-author span,.infos,.infos a{color:#666e8e}.comment .comment-author .avatar,.comment .comment-author:before,#commentform input,#commentform textarea,#commentform input#submit:focus{color:#bdcadb;background:#1c1f2b;border:1px solid #393f56}#commentform textarea:focus,#commentform input:focus,#commentform input#submit:hover{border-color:#bdcadb}#commentform input#submit{color:#fff}#commentform input#submit:hover{background:#393f56;border-color:#393f56}.nearbypost{box-shadow:0 1px 0 #393f56,0 -1px 0 #393f56}.nearbypost div.alignright{box-shadow:-1px 0 0 #393f56}.view-img{background:rgba(28,31,43,0.9) !important;}.setting_tool,.setting_tool a,.setting_tool.colors div.c,.setting_tool.search div.s input,.setting_tool.search div.s input::placeholder{background:#393f56;color:#bdcadb;}";
        } else if(_let.lis.is('.serif')){
            localStorage.adams_font_style = "body{font-family:serif;}";
        } else {
            _let.lis.is('.undefined') ? localStorage.removeItem('adams_color_style') : localStorage.removeItem('adams_font_style');
        }
        $('.diy-color-style').remove();
        $('.diy-font-style').remove();
        if(localStorage.adams_color_style) $('head').append("<style class='diy-color-style'>" + localStorage.adams_color_style + "</style>");
        if(localStorage.adams_font_style) $('head').append("<style class='diy-font-style'>" + localStorage.adams_font_style + "</style>");
    });
    
    $(document).on('click', '.navigation a', function (e) {
        e.preventDefault();
        if( history.pushState ){
            history.pushState(null, this.title, this.href);
        }
        $.ajax({
            type: "GET",
            url: this.href,
            beforeSend: function () {
                $('.navigation').remove();
                $('.commentlist').remove();
                $('html, body').animate({ scrollTop: $('#comments').offset().top - 20 }, 500);
            },
            dataType: "html",
            success: function (out) {
                result = $(out).find('.commentlist');
                nextlink = $(out).find('.navigation');
                $('#comments').after(result.fadeIn(500));
                $('.commentlist').after(nextlink);
                $.adamsOverload();
            }
        });
    });

})(jQuery);
