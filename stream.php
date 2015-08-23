<?php
    include ("config.php");
    set_time_limit(0);
    error_reporting(0);

    $ip = $_SERVER['REMOTE_ADDR'];
    $username=$_GET['username'];
    $password=$_GET['password'];
    $str=$_GET['stream'];
    $setting = Setting::first();
    if (empty($_GET['username']) || empty($_GET['password'])) {
        $error = "Username or Password is invalid";
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        header('Status: 404 Not Found');
        die();
    }

    $user = User::where('username', '=', $username)->where('password', '=', $password)->where('active', '=', 1)->first();
    $token = (!$user) ? die() : uniqid();

    $stream = Stream::where('name', '=', $str)->where('status', '=', 1)->first();
    (!$stream ? die() : "");

    ob_end_clean();
    ob_start();
    ignore_user_abort(true);

    $file = $stream->streamurl;

//    header('Content-Type: application/octet-stream');
//    header('Connection: close');
//    header("Cache-Control: no-cache, must-revalidate");

    if($stream->restream == false) {
        $readfilepad = strip_tags($str);
        header('Content-Length: ' . filesize(".$setting->hlsfolder." . "/".$readfilepad));
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Cache-Control: no-store, no-cache,must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0",false);
        header("Pragma: no-cache");
        header('Content-type:application/force-download');
        header('Content-Disposition: attachment; filename='.basename($readfilepad));
        header('Content-Length: ' . filesize(".$setting->hlsfolder." . "/".$readfilepad));
        header('Content-Type: '.mime_content_type(".$setting->hlsfolder." . "/".$readfilepad));


        if (strpos($_GET['file'],".ts")>1) header("Content-type: video/MP2T");
        if (strpos($_GET['file'],"_.m3u8")>1) header("Content-type: application/x-mpegURL");
        @readfile(".$setting->hlsfolder." . "/".$readfilepad);
    }

    $fd = fopen($file, "r");
    while(!feof($fd)) {
        echo fread($fd, 1024 * 5);
        ob_flush();
        flush();
        if (connection_aborted()){
            break;
        }
    }
    fclose ($fd);
    exit();
    die();
