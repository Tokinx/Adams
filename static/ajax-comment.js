(function ($) {
    $(document).ready(function(){
        $('.infos .donate,.infos .share').click(function(){
            if($(this).attr('class')=='donate'){
                $('.infos').removeClass('share-close');
                $('.infos').toggleClass('donate-close');
            } else {
                $('.infos').removeClass('donate-close');
                $('.infos').toggleClass('share-close');
                if($(this).find('img').length == 0){
                    $(this).append('<img src="' + $(this).find('a').data('qrcode') + '" /> <i>移动设备上继续阅读</i>');
                }
            }
        });
    });
    
    $(".dot-good").click(function () {
        if ($(this).hasClass('done')) {
            alert('点多了伤身体~');
            return false;
        } else {
            $(this).addClass('done');
            var id = $(this).data("id"),
                action = $(this).data('action'),
                rateHolder = $(this).children('.count');
            var ajax_data = {
                action: "dotGood",
                um_id: id,
                um_action: action
            };
            $.post(themeAdminAjax.url, ajax_data,function (data) {
                $(rateHolder).html(data);
            });
            return false;
        }
    });
    
    //Zepto & jQuery AjaxComments
    var i = 0, got = -1, len = document.getElementsByTagName('script').length;
    while (i <= len && got == -1) {
        var js_url = document.getElementsByTagName('script')[i].src,
            got = js_url.indexOf('script.js');
        i++;
    }
    var wp_url = js_url.substr(0, js_url.indexOf('wp-content')),
        txt1 = '<div id="loading">COMMITING...</div>',
        txt2 = '<div id="error">#</div>',
        num = 1,
        comm_array = [];
    comm_array.push('');

    jQuery(document).ready(function ($) {
        $comments = $('#comments-title'); // Comment sum ID
        $cancel = $('#cancel-comment-reply-link');
        cancel_text = $cancel.text();
        $submit = $('#commentform #submit');
        //$submit.attr('disabled', false);
        $('#comment').after(txt1 + txt2);
        $('#loading').hide();
        $('#error').hide();

        /** submit */
        $('#commentform').submit(function () {
            $('#loading').show();
            //$submit.attr('disabled', true);

            /** ajax */
            $.ajax({
                url: themeAdminAjax.url,
                data: $(this).serialize() + '&action=comment-submission',
                type: $(this).attr('method'),

                error: function (request) {
                    $('#loading').hide();
                    $('#error').show().html(request.responseText);
                    setTimeout(function () {
                        //$submit.attr('disabled', false);
                        $('#error').hide();
                    }, 3000);
                },
                success: function (data) {
                    $('#loading').hide();
                    comm_array.push($('#comment').val());
                    $('textarea').each(function () {
                        this.value = ''
                    });
                    var t = addComment, cancel = t.I('cancel-comment-reply-link'), temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId), post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value;

                    // show comment
                    new_htm = '" id="new_comm_' + num + '"></';
                    new_htm = (parent == '0') ? ('\n<ol style="clear:both;" class="commentlist' + new_htm + 'ol>') : ('\n<ul class="children' + new_htm + 'ul>');
                    $('#respond').before(new_htm);
                    $('#new_comm_' + num).hide().append(data);
                    $('#new_comm_' + num).show();
                    countdown();
                    num++;
                    cancel.style.display = 'none';
                    cancel.onclick = null;
                    t.I('comment_parent').value = '0';
                    if (temp && respond) {
                        temp.parentNode.insertBefore(respond, temp);
                        temp.parentNode.removeChild(temp)
                    }
                }
            }); // end Ajax
            return false;
        }); // end submit

        /** comment-reply.dev.js */
        addComment = {
            moveForm: function (commId, parentId, respondId, postId, num) {
                var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');
                num ? (
                    t.I('comment').value = comm_array[num],
                    $new_sucs = $('#success_' + num), $new_sucs.hide(),
                    $new_comm = $('#new_comm_' + num), $new_comm.hide()
                ) : $cancel.text(cancel_text);

                t.respondId = respondId;
                postId = postId || false;

                if (!t.I('wp-temp-form-div')) {
                    div = document.createElement('div');
                    div.id = 'wp-temp-form-div';
                    div.style.display = 'none';
                    respond.parentNode.insertBefore(div, respond)
                }

                !comm ? (
                    temp = t.I('wp-temp-form-div'),
                    t.I('comment_parent').value = '0',
                    temp.parentNode.insertBefore(respond, temp),
                    temp.parentNode.removeChild(temp)
                ) : comm.parentNode.insertBefore(respond, comm.nextSibling);

                scrollTop: $('#respond').offset().top;

                if (post && postId) post.value = postId;
                parent.value = parentId;
                cancel.style.display = '';

                cancel.onclick = function () {
                    var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

                    t.I('comment_parent').value = '0';
                    if (temp && respond) {
                        temp.parentNode.insertBefore(respond, temp);
                        temp.parentNode.removeChild(temp);
                    }
                    this.style.display = 'none';
                    this.onclick = null;
                    return false;
                };

                try {
                    t.I('comment').focus();
                }
                catch (e) {
                }

                return false;
            },

            I: function (e) {
                return document.getElementById(e);
            }
        }; // end addComment

        var wait = 15, submit_val = $submit.val();

        function countdown() {
            if (wait > 0) {
                $submit.val(wait);
                wait--;
                setTimeout(countdown, 1000);
            } else {
                $submit.val(submit_val);
                //$submit.val(submit_val).attr('disabled', false);
                wait = 15;
            }
        }
    });// end
})(jQuery);