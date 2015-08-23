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

    header('Content-Type: application/octet-stream');
    header('Connection: close');
    header("Cache-Control: no-cache, must-revalidate");

    if($stream->restream == false) {
        $file = "http://".$setting->webip.":".$setting->webport."/".$setting->hlsfolder."/".$str."_.m3u8";
        header("location: $file");
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