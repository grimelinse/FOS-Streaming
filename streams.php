<?php
include('config.php');
logincheck();
/**
 * Created by Tyfix 2015
 */
$message = [];
$title = "All Streams";


if (isset($_GET['start'])){
    start_stream($_GET['start']);
    $message['type'] = "success";
    $message['message'] = "stream started";
} else if (isset($_GET['stop'])) {
    stop_stream($_GET['stop']);
    $message['type'] = "success";
    $message['message'] = "stream stopped";
}

if(isset($_GET['delete'])) {
    $stream = Stream::find($_GET['delete']);
    $stream->delete();

    $message['type'] = "success";
    $message['message'] = "Stream deleted";
}

if (isset($_GET['running']) &&  $_GET['running']  == 1) {
    $title = "Running Streams";
    $stream = Stream::where('status', '=', 1)->get();

}
else if (isset($_GET['running']) &&  $_GET['running']  == 2) {
    $title = "Stopped Streams";
    $stream = Stream::where('status', '=', 2)->get();
} else {
    $stream = Stream::all();
}

echo $template->view()->make('streams')
    ->with('streams',  $stream)
    ->with('message', $message)
    ->with('title', $title)
    ->render();
?>