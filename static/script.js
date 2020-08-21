var obj = {};
/**
 * ViewImage.min.js 1.3.2
 * https://tokinx.github.io/ViewImage/
 */
(function(a){a.extend({viewImage:function(c){var b=a.extend({target:".view-image img",exclude:"",delay:300},c);a(b.exclude).attr("view-image",!1);a(b.target).off().on("click",function(e){var f=e.currentTarget.src,d=e.currentTarget.href,c=".vi-"+Math.random().toString(36).substr(2);if(!a(this).attr("view-image")&&!a(this).is(b.exclude)&&(f||d&&d.match(/.+\.(jpg|jpeg|webp|gif|png)/gi)))return a("body").append("<style class='view-image-css'>.view-img{position:fixed;background:#fff;background:rgba(255,255,255,.92);width:100%;height:100%;top:0;left:0;text-align:center;padding:2%;z-index:999;cursor: zoom-out}.view-img img,.view-img span{max-width:100%;max-height:100%;position:relative;top:50%;transform: translateY(-50%);}.view-img img{animation:view-img-show .8s -0.1s ease-in-out}.view-img span{height:2em;color:#AAB2BD;overflow:hidden;position:absolute;top:50%;left:0;right:0;width:120px;text-align:center;margin:-1em auto;}.view-img span:after{content:'';position:absolute;bottom:0;left:0;transform: translateX(-100%);width:100%;height:2px;background:#3274ff;animation:view-img-load .8s -0.1s ease-in-out infinite;}@keyframes view-img-load{0%{transform: translateX(-100%);}100%{transform: translateX(100%);}}@keyframes view-img-show{0%{opacity:0;}100%{opacity:1;}}</style><div class='view-img'><span>loading...</span></div>"),setTimeout(function(){var b=new Image;b.src=f||d;b.onload=function(){a(".view-img").html('<img src="'+b.src+'" alt="ViewImage">')};a(".view-img").off().on("click",function(){a(".view-image-css").remove();a(this).remove()});a(c).html()},b.delay),!1})}})})(jQuery);

/*
 * lately.min.js 2.0.0
 * fix reload
 https://tokinx.github.io/lately/
*/
var $jscomp=$jscomp||{};$jscomp.scope={};$jscomp.arrayIteratorImpl=function(a){var d=0;return function(){return d<a.length?{done:!1,value:a[d++]}:{done:!0}}};$jscomp.arrayIterator=function(a){return{next:$jscomp.arrayIteratorImpl(a)}};$jscomp.makeIterator=function(a){var d="undefined"!=typeof Symbol&&Symbol.iterator&&a[Symbol.iterator];return d?d.call(a):$jscomp.arrayIterator(a)};
(function(a,d){var m=function(a){var d=a.target||".time",e=a.lang||{second:"\u79d2",minute:"\u5206\u949f",hour:"\u5c0f\u65f6",day:"\u5929",month:"\u4e2a\u6708",year:"\u5e74",ago:"\u524d",error:"NaN"};for(var a=$jscomp.makeIterator(document.querySelectorAll(d)),c=a.next();!c.done;c=a.next()){c=c.value;var b=c.dateTime;var f=c.title,g=c.innerHTML;if(!b||isNaN(new Date(b=b.replace(/(.*)[a-z](.*)\+(.*)/gi,"$1 $2").replace(/-/g,"/"))))if(f&&!isNaN(new Date(f=
    f.replace(/-/g,"/"))))b=f;else if(g&&!isNaN(new Date(g=g.replace(/-/g,"/"))))b=g;else break;c.title=b;b=new Date(b);b=((new Date).getTime()-b.getTime())/1E3;f=b/60;g=f/60;var k=g/24,l=k/30,h=l/12;c.innerHTML=(1<=h?Math.floor(h)+e.year:1<=l?Math.floor(l)+e.month:1<=k?Math.floor(k)+e.day:1<=g?Math.floor(g)+e.hour:1<=f?Math.floor(f)+e.minute:1<=b?Math.floor(b)+e.second:e.error)+e.ago}};var h=function(){return this||(0,eval)("this")}();"Lately"in h||(h.Lately=m)})();

(function ($) {
    $(window).bind("scroll", function () {
        if ($(this).scrollTop() > 200) {
            $(".back2top").show();

            if (!$(".infos").hasClass('fixed')) {
                $(".infos").addClass('fixed');
                $(".infos .fixed-title").html($('h1.fullname').html());
                $(".infos .fixed-menus").html($('nav.header_nav').html());
            }
        } else {
            $(".back2top").hide();

            if ($(".infos").hasClass('fixed')) {
                $(".infos").removeClass('fixed');
            }
        }
        obj.scroll_top = $(this).scrollTop();
    });
    $(document).on('click', '.setting_tool a', function (e) {
        if ($(this).is('.back2top')) {
            return $("html,body").animate({scrollTop: 0}, 400);
        } else {
            obj.st = $('.setting_tool');
            if ($(this).is('.sosearch') && !obj.st.is('.search')) {
                obj.st.addClass('search');
            } else if ($(this).is('.socolor') && !obj.st.is('.colors')) {
                obj.st.addClass('colors');
            } else {
                obj.st.removeClass('search');
                obj.st.removeClass('colors');
            }
        }
    });
    $(document).on('click', '.setting_tool .c ul li', function (e) {
        obj.lis = $(this);
        if (obj.lis.is('.sepia')) {
            localStorage.adams_color_style = "sepia";
        } else if (obj.lis.is('.night')) {
            localStorage.adams_color_style = "night";
        } else if (obj.lis.is('.serif')) {
            localStorage.adams_font_style = "serif";
        } else {
            obj.lis.is('.undefined') ? localStorage.removeItem('adams_color_style') : localStorage.removeItem('adams_font_style');
        }
        $("body").removeClass().addClass(localStorage.adams_color_style || "").addClass(localStorage.adams_font_style || "");
    });

    $(document).on('click', '.comment-navigation a', function (e) {
        e.preventDefault();
        if (history.pushState) {
            history.pushState(null, this.title, this.href);
        }
        $.ajax({
            type: "GET",
            url: this.href,
            beforeSend: function () {
                $('html, body').animate({scrollTop: $('#comments').offset().top - 80}, 0);
                $('.comment-navigation').remove();
                $('.comment-list').remove();
            },
            dataType: "html",
            success: function (out) {
                let result = $(out).find('.comment-list');
                let nextlink = $(out).find('.comment-navigation');
                $('#comments').after(result);
                $('.comment-list').after(nextlink);
                $.adamsOverload();
            }
        });
    });

})(jQuery);
