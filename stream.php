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

$user = User::where('username', '=', $username)->where('password', '=', $password)->where('active', '=', 1)->first();

if (!isset($_SESSION['user_id'])){ // TODO: secret key
    $token = (!$user) ? die() : uniqid();
}



if($user->exp_date != "0000-00-00") {
    if($user->exp_date <=  Carbon::today()) {
        die();
    }
}

$stream = Stream::find($id);
if (!isset($_SESSION['user_id'])) { // TODO: secret key
    (!$stream ? die() : "");
}

($stream->status != 1 ? die() : "");

ob_end_clean();
ob_start();
ignore_user_abort(true);


$user->lastconnected_ip = $ip;
$user->last_stream = $stream->id;
$user->save();


$url =  $stream->streamurl;
if($stream->checker == 2) {
    $url = $stream->streamurl2;
}
if($stream->checker == 3) {
    $url =  $stream->streamurl3;
}

if($stream->restream == false) {

    if($setting->less_secure) {
        $file = "http://".$setting->webip.":".$setting->webport."/".$setting->hlsfolder."/".$id."_.m3u8";
        header("location: $file");
        die();

    }
}

$fd = fopen($url, "r");
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
