var _let = [];
/**
 * ViewImage.js
 * https://tokinx.github.io/view-image
 */
!function (a) { a.extend({ viewImage: function (b) { var c = a.extend({ target: ".view-image img", exclude: "", delay: 300 }, b); a(c.exclude).attr("view-image", !1), a(c.target).click(function () { var b = a(this).attr("src"), d = a(this).attr("href"), e = "", f = "<style class='view-image-css'>.view-img{position:fixed;background:#fff;background:rgba(255,255,255,.92);width:100%;height:100%;top:0;left:0;text-align:center;padding:2%;z-index:999;cursor: zoom-out}.view-img img,.view-img span{max-width:100%;max-height:100%;position:relative;top:50%;transform: translateY(-50%);}.view-img img{animation:view-img-show .8s -0.1s ease-in-out}.view-img span{height:2em;color:#AAB2BD;overflow:hidden;position:absolute;top:50%;left:0;right:0;width:120px;text-align:center;margin:-1em auto;}.view-img span:after{content:'';position:absolute;bottom:0;left:0;transform: translateX(-100%);width:100%;height:2px;background:#3274ff;animation:view-img-load .8s -0.1s ease-in-out infinite;}@keyframes view-img-load{0%{transform: translateX(-100%);}100%{transform: translateX(100%);}}@keyframes view-img-show{0%{opacity:0;}100%{opacity:1;}}</style>"; return a(this).attr("view-image") || a(this).attr("rel") ? void 0 : (e = b ? b : d, a("body").append(f + "<div class='view-img'><span>loading...</span></div>"), setTimeout(function () { var b = new Image; b.src = e, b.onload = function () { a(".view-img").html("<img src=" + this.src + ">") }, a(".view-img").click(function () { a(".view-image-css").remove(), a(this).remove() }) }, c.delay), !1) }) } }) }(jQuery);

/**
 * lately.min.js v1.0.8
 * https://tokinx.github.io/lately/
 */
(function (a) { a.extend({ lately: function (e) { function l(a) { a = new Date(a); a = ((new Date).getTime() - a.getTime()) / 1E3 / 60; var b = a / 60, d = b / 24, e = d / 30, f = e / 12, g = Math.floor; return (1 <= f ? g(f) + c.lang.year : 1 <= e ? g(e) + c.lang.month : 1 <= d ? g(d) + c.lang.day : 1 <= b ? g(b) + c.lang.hour : 1 <= a ? g(a) + c.lang.minute : 0 <= a ? c.lang.second : c.lang.error) + c.lang.ago } var c = a.extend({ target: ".time", lang: { second: "\u51e0\u79d2", minute: "\u5206\u949f", hour: "\u5c0f\u65f6", day: "\u5929", month: "\u4e2a\u6708", year: "\u5e74", ago: "\u524d", error: "NaN" } }, e); e = a(c.target); for (var k = 0; k < e.length; k++) { var d = a(e[k]), b = ""; if (a(d).is(":visible")) { b = a(d).attr("datetime"); var f = a(d).attr("title"), h = a(d).html(); if (!b || isNaN(new Date(b = b.replace(/(.*)[a-z](.*)\+(.*)/gi, "$1 $2").replace(/-/g, "/")))) if (f && !isNaN(new Date(f = f.replace(/-/g, "/")))) b = f; else if (h && !isNaN(new Date(h = h.replace(/-/g, "/")))) b = h; else break; a(d).html(l(b)) } } } }) })(jQuery);

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
        _let.scroll_top = $(this).scrollTop();
    });
    $(document).on('click', '.setting_tool a', function (e) {
        if ($(this).is('.back2top')) {
            return $("html,body").animate({ scrollTop: 0 }, 400);
        } else {
            _let.st = $('.setting_tool');
            if ($(this).is('.sosearch') && !_let.st.is('.search')) {
                _let.st.addClass('search');
            } else if ($(this).is('.socolor') && !_let.st.is('.colors')) {
                _let.st.addClass('colors');
            } else {
                _let.st.removeClass('search');
                _let.st.removeClass('colors');
            }
        }
    });
    $(document).on('click', '.setting_tool .c ul li', function (e) {
        _let.lis = $(this);
        if (_let.lis.is('.sepia')) {
            localStorage.adams_color_style = "sepia";
        } else if (_let.lis.is('.night')) {
            localStorage.adams_color_style = "night";
        } else if (_let.lis.is('.serif')) {
            localStorage.adams_font_style = "serif";
        } else {
            _let.lis.is('.undefined') ? localStorage.removeItem('adams_color_style') : localStorage.removeItem('adams_font_style');
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
                $('html, body').animate({ scrollTop: $('#comments').offset().top - 80 }, 0);
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
