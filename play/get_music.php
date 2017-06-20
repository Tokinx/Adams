<?php
    if(!empty($_GET['id'])){
        header('Content-Type: application/json;charset=UTF-8');
        $searchUrl = 'https://music.163.com/api/playlist/detail?id='.$_GET['id'];
        $file = $_GET['id'] . ".json";
        $uri = "cache/" . $file;
        if (file_exists($uri)) {
            $fo = fopen($uri, "r+");
            $ti = filemtime($uri);
            if(date("Ymd",$ti) != date("Ymd")){
                unlink($uri);
                $str = str_replace("http://p","https://p",file_get_contents($searchUrl));
                $str = str_replace("http://m","https://p",$str);
                fwrite($fo, $str);
                echo $str;
            } else {
                echo fread($fo, filesize($uri));
            }
        } else {
            $str = str_replace("http://p","https://p",file_get_contents($searchUrl));
            $str = str_replace("http://m","https://p",$str);
            $fo = fopen($uri, "w+");
            fwrite($fo, $str);
            echo $str;
        }
        fclose($fo);
    } else if(!empty($_GET['song'])){
        header('Content-Type: application/json;charset=UTF-8');
        $searchUrl = 'https://music.163.com/api/song/detail/?id='.$_GET['song'].'&ids=['.$_GET['song'].']';
        $str = str_replace("http://p","https://p",file_get_contents($searchUrl));
        $str = str_replace("http://m","https://p",$str);
        echo $str;
    } else if(!empty($_GET['lrc'])){
        header('Content-Type: text/plain;charset=UTF-8');
        $lrcUrl = 'https://music.163.com/api/song/lyric?os=pc&id='.$_GET['lrc'].'&lv=-1';
        $file = $_GET['lrc'] . ".lrc";
        $uri = "cache/lrc/" . $file;
        if (!file_exists($uri)) {
            $str = file_get_contents($lrcUrl);
            $str = json_decode($str,true);
            if(!empty($str['lrc']['lyric'])){
                $fo = fopen($uri, "w");
                fwrite($fo, $str['lrc']['lyric']);
                echo $str['lrc']['lyric'];
            }
        } else {
            $fo = fopen($uri, "r");
            echo fread($fo, filesize($uri));
        }
        fclose($fo);
    } else if(!empty($_GET['down'])){
        header("Location: http://119.28.71.113/?down=" . $_GET['down']); 
        exit();
        header('Content-Type: audio/mpeg;charset=UTF-8');
        $str = file_get_contents($_GET['down']);
        echo $str;
    } else {
        echo "null";
    }
