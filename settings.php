<?php
include('config.php');
logincheck();
/**
 * Created by Tyfix 2015
 */
$message = [];

$setting = Setting::first();


if (isset($_POST['submit'])) {

    $setting->ffmpeg_path = $_POST['ffmpeg_path'];
    $setting->ffprobe_path = $_POST['ffprobe_path'];
    $setting->webport = $_POST['webport'];
    $setting->webip = $_POST['webip'];
    $setting->hlsfolder = $_POST['hlsfolder'];

    $message['type'] = "success";
    $message['message'] = "Setting saved";
    $setting->save();
    redirect("settings.php", 1000);

}
echo $template->view()->make('manage_settings')
    ->with('setting',  $setting)
    ->with('message', $message)
    ->render();
?>