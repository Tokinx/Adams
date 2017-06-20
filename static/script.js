/**
 * ViewImage.min.js
 * https://tokinx.github.io/ViewImage/
 */
!function(a){a.extend({viewImage:function(b){var c=a.extend({target:".view-image img",exclude:"",delay:300},b);a(c.exclude).attr("view-image",!1),a(c.target).click(function(){var b=a(this).attr("src"),d=a(this).attr("href"),e="",f="<style class='view-image-css'>.view-img{position:fixed;background:#fff;background:rgba(255,255,255,.92);width:100%;height:100%;top:0;left:0;text-align:center;padding:2%;z-index:999;cursor: zoom-out}.view-img img,.view-img span{max-width:100%;max-height:100%;position:relative;top:50%;transform: translateY(-50%);}.view-img span{height:2em;color:#AAB2BD;overflow:hidden;position:absolute;top:50%;left:0;right:0;width:120px;text-align:center;margin:-1em auto;}.view-img span:after{content:'';position:absolute;bottom:0;left:0;transform: translateX(-100%);width:100%;height:2px;background:#3274ff;animation:view-img-load .8s -0.1s ease-in-out infinite;}@keyframes view-img-load{0%{transform: translateX(-100%);}100%{transform: translateX(100%);}}</style>";return a(this).attr("view-image")||a(this).attr("rel")?void 0:(e=b?b:d,a("body").append(f+"<div class='view-img'><span>loading...</span></div>"),setTimeout(function(){var b=new Image;b.src=e,b.onload=function(){a(".view-img").html("<img src="+this.src+">")},a(".view-img").click(function(){a(".view-image-css").remove(),a(this).remove()})},c.delay),!1)})}})}(jQuery);

/**
 * lately.min.js v1.0.2
 * https://tokinx.github.io/lately/
 */
(function(a){a.extend({lately:function(e){function l(a){a=new Date(a);a=((new Date).getTime()-a.getTime())/1E3;var b=a/60,d=b/60,e=d/24,f=e/30,g=f/12,h=Math.floor;return(1<=g?h(g)+c.lang.year:1<=f?h(f)+c.lang.month:1<=e?h(e)+c.lang.day:1<=d?h(d)+c.lang.hour:1<=b?h(b)+c.lang.minute:1<=a?h(a)+c.lang.second:c.lang.error)+c.lang.ago}var c=a.extend({target:".designation time",lang:{second:"\u79d2",minute:"\u5206\u949f",hour:"\u5c0f\u65f6",day:"\u5929",month:"\u4e2a\u6708",year:"\u5e74",ago:"\u524d",error:"NaN"}},
e);e=a(c.target);for(var k=0;k<e.length;k++){var d=a(e[k]),b="";if(a(d).is(":visible")){var b=a(d).attr("datetime"),f=a(d).attr("title"),g=a(d).html();if(!b||isNaN(new Date(b=b.replace(/(.*)[a-z](.*)\+(.*)/gi,"$1 $2").replace(/-/g,"/"))))if(f&&!isNaN(new Date(f=f.replace(/-/g,"/"))))b=f;else if(g&&!isNaN(new Date(g=g.replace(/-/g,"/"))))b=g;else break;a(d).html(l(b))}}}})})(jQuery);

(function () {
    var link_element = document.createElement("link"),
        s = document.getElementsByTagName("script")[0];
    link_element.href += "//fonts.proxy.ustclug.org/css?family=Exo+2:100italic,100,200italic,200,300italic,300,400italic,400,500italic,500,600italic,600,700italic,700,800italic,800,900italic,900";
    link_element.rel = "stylesheet";
    link_element.type = "text/css";
    s.parentNode.insertBefore(link_element, s);
})();

(function ($) {
    //Back to Top
    $(".back2top").hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $(".back2top").fadeIn(200)
        } else {
            $(".back2top").fadeOut(200)
        }
    });
    $(".back2top").click(function () {
        return $("html,body").animate({ scrollTop: 0 }, 400);
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
                $('html, body').animate({ scrollTop: $('#comments').offset().top - 30 }, 500);
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
