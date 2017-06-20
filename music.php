<?php
/*
Template Name: 网易云歌单播放器
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/play/player.css?2"/>
</head>
<body class="load">
<div class="wrapper">
    <div id="bg" class="bg" style="background-image: url('<?php bloginfo('template_url'); ?>/play/song.png');"></div>
    <div id="play">
        <div class="play-board">
            <div class="header cover title">
                <img class="disk-cover" src="<?php bloginfo('template_url'); ?>/play/song.png"/>
                
                <div id="tools">
                    <div class="share"></div>
                    <div class="down"></div>
                </div>
                
                <div class="title">
                    <div class="song" id="songName"></div>
                    <div class="artist lyric" id="artist"></div>
                </div>
            </div>
            
            <div class="footer">
                <audio id="player"></audio>
                <div class="process" id="process">
                    <span id="currentTime">00:00</span>
                    <div class="process-bar">
                        <div class="rdy"></div>
                        <div class="cur">
                            <span id="processBtn" class="process-btn c-btn"></span>
                        </div>
                    </div>
                    <span id="totalTime">00:00</span>
                </div>
                
                <div class="control" id="controls">
                    <span class="c-btn loop-btn" onclick="ctx.loop()"></span>
                    <span class="pre c-btn" onclick="ctx.prev()"></span>
                    <span class="play c-btn" onclick="ctx.play()"></span>
                    <span class="pause c-btn" onclick="ctx.pause()" style="display: none"></span>
                    <span class="next c-btn" onclick="ctx.next()"></span>
                    <span class="c-btn list-btn" onclick="ctx.showPlayList()"></span>
                </div>
            </div>
        </div>
        <div class="play-list" id="playList">
            <div class="list-title">PlayList [<span id="playListCount">0</span>]</div>
            <ul class="list-content" id="listContent">
            </ul>
        </div>
    </div>
</div>
<?php
$playSong = empty($_GET['song']) ? "" : $_GET['song'];
if (empty($_GET['list']) && empty($_GET['song']) && have_posts()){
    while (have_posts()) {
        the_post();
        $cont = trim(get_the_content());
        preg_match_all('/\d+/is',$cont,$list);
        $playList = $list[0];
        if(count($playList) <= 0){
            $playList[0] = "";
        }
    };
} else {
    $playList[0] = $_GET['list'];
};?>
<script>
    var myPlay = "<?php bloginfo('template_url'); ?>/play/";
    var myList = "<?php echo $playList[0];?>";
    var mySong = "<?php echo rawurlencode($playSong);?>";
</script>
<script src="<?php bloginfo('template_url'); ?>/play/player.js?2"></script>

<div class="loading">
    <i></i>
    <i></i>
    <i></i>
    <i></i>
    <i></i>
</div>
</body>
</html>