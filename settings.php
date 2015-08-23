<?php
include('config.php');
logincheck();
//TODO:: N
$message = [];

$setting = Setting::first();


if (isset($_POST['submit'])) {

    $port = false;
    $setting->ffmpeg_path = $_POST['ffmpeg_path'];
    $setting->ffprobe_path = $_POST['ffprobe_path'];

    if($setting->webport != $_POST['webport']) {

        $setting->webport = $_POST['webport'];
        if(is_null($_POST['webport'])) {
            $setting->webport = 8000;
        }
        generatEginxConfPort($_POST['webport']);
        $port = true;
    }

    $setting->webip = $_POST['webip'];
    //$setting->hlsfolder = $_POST['hlsfolder'];

    $message['type'] = "success";
    $message['message'] = "Setting saved";
    $setting->save();

    if($port) {
        die("Restart nginx and go to the following url: http://". $_SERVER['SERVER_ADDR'] . ":" . $_POST['webport'] . "/settings.php");
    } else {
        redirect("settings.php", 1000);
    }


}
echo $template->view()->make('manage_settings')
    ->with('setting',  $setting)
    ->with('message', $message)
    ->render();
