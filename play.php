<?php
include('config.php');
logincheck();

$setting = Setting::first();
$stream = Stream::find($_GET['id']);
$streamurl =$setting->hlsfolder . "/" . $stream->id ."_.m3u8";
echo $template->view()->make('play')
    ->with('streamurl', $streamurl)
    ->render();