<?php
/**
 * Created by Tyfix 2015
 */
include('config.php');
logincheck();
$message = [];

if(isset($_GET['delete'])) {
    $trans = Transcode::find($_GET['delete']);
    $trans->delete();

    $message['type'] = "success";
    $message['message'] = "Admin deleted";
}

$transcodes = Transcode::all();

echo $template->view()->make('transcodes')->with('transcodes',  $transcodes)->with('message', $message)->render();
