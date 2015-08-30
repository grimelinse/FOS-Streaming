<?php
    include ("config.php");
    use Carbon\Carbon;
    set_time_limit(0);
    error_reporting(0);

    $ip = $_SERVER['REMOTE_ADDR'];
    $username=$_GET['username'];
    $password=$_GET['password'];
    $id=$_GET['stream'];
    $setting = Setting::first();

    if (empty($_GET['username']) || empty($_GET['password'])) {
        $error = "Username or Password is invalid";
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        header('Status: 404 Not Found');
        die();
    }

    $user = User::where('username', '=', $username)->where('password', '=', $password)->where('active', '=', 1);
    if (!isset($_SESSION['user_id'])){ // TODO: secret key
        $token = (!$user) ? die() : uniqid();
    }

    if($user->exp_date >=  Carbon::yesterday()) {
        die();
    }

    $stream = Stream::find($id)->where('status', '=', 1);
    if (!isset($_SESSION['user_id'])) { // TODO: secret key
        (!$stream ? die() : "");
    }
    ob_end_clean();
    ob_start();
    ignore_user_abort(true);


    $user->lastconnected_ip = $ip;
    $user->save();

    $file = $stream->streamurl;

    if($stream->restream == false) {

        if($setting->less_secure) {
            $file = "http://".$setting->webip.":".$setting->webport."/".$setting->hlsfolder."/".$id."_.m3u8";
            header("location: $file");
            die();

        } else {
            $readfilepad = strip_tags($id);
            $fileloc = $setting->hlsfolder . "/".$readfilepad;
            header('Content-Length: ' . filesize($fileloc));
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("Cache-Control: no-store, no-cache,must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0",false);
            header("Pragma: no-cache");
            header('Content-type:application/force-download');
            header('Content-Disposition: attachment; filename='.basename($readfilepad));
            header('Content-Length: ' . filesize($fileloc));
            header('Content-Type: '.mime_content_type($fileloc));
            @readfile($fileloc);
        }
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
