<?php
include('config.php');
logincheck();

if(!isset($_GET['id'])) {
    die();
}

$id = $_GET['id'];
$user = User::find($id);
$setting = Setting::first();

if(isset($_GET['e2'])) {
    unlink('/tmp/userbouquet.favourites.tv');
    file_put_contents('/tmp/userbouquet.favourites.tv',"#NAME FOS-Streaming \r\n", FILE_APPEND);

    foreach($user->categories as $category) {
        foreach($category->streams as $stream) {
            if($stream->running == 1) {
                file_put_contents('/tmp/userbouquet.favourites.tv',"#SERVICE 1:0:1:0:0:0:0:0:0:0:http%3A//".$setting->webip."%3A".$setting->webport."/".$user->username."/".$user->password."/".$stream->id ."\r\n", FILE_APPEND);
                file_put_contents('/tmp/userbouquet.favourites.tv',"#DESCRIPTION " . $stream->name ."\r\n", FILE_APPEND);
            }
        }
    }
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="userbouquet.favourites.tv"');
    readfile("/tmp/userbouquet.favourites.tv");
}

if(isset($_GET['m3u'])) {
    unlink('/tmp/tv_user.m3u');
    file_put_contents('/tmp/tv_user.m3u',"", FILE_APPEND);
    foreach($user->categories as $category) {
        foreach($category->streams as $stream) {
            if($stream->running == 1) {
                file_put_contents('/tmp/tv_user.m3u', "#EXTINF:0," . $stream->name . "\r\n", FILE_APPEND);
                file_put_contents('/tmp/tv_user.m3u', "http://" . $setting->webip . ":" . $setting->webport . "/" . $user->username . "/" . $user->password . "/" . $stream->id . "\r\n", FILE_APPEND);
            }
        }
    }

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="tv_user.m3u"');
    readfile("/tmp/tv_user.m3u");
}


if(isset($_GET['tv'])) {
    unlink('/tmp/Channels.txt');
    file_put_contents('/tmp/tv_user.m3u',"", FILE_APPEND);
    foreach($user->categories as $category) {
        foreach($category->streams as $stream) {
            if($stream->running == 1) {
                file_put_contents('/tmp/Channels.txt',"ext,$stream->name,http://".$setting->webip.":".$setting->webport."/".$user->username."/".$user->password."/".$stream->name."\r\n", FILE_APPEND);
            }
        }
    }

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="Channels.txt"');
    readfile("/tmp/Channels.txt");

}