<?php
include('config.php');
logincheck();

$message = [];
$title = "Playlist importer";
$stream = new Stream;
$categories = Category::all();
$transcodes = Transcode::all();


if (isset($_POST['submit'])) {

    if (empty($_POST['category'])) {
        $message['type'] = "error";
        $message['message'] = "Select one category";
    } else {

        $lines = preg_split('~[\r\n]+~', $_POST['import']);
        foreach($lines as $key => $line){
            if(empty($line) or ctype_space($line)) continue;

            if (substr($line, 0, 1) === '#') {
                $splitline = explode(',', $lines[$key]);

                $stream = new Stream;

                if(isset($splitline[1])) {

                    $stream->name = $splitline[1];
                    $stream->cat_id = $_POST['category'];
                    $stream->trans_id = $_POST['transcode'];

                    $stream->restream = 0;
                    if(isset($_POST['restream'])) {
                        $stream->restream = 1;
                    }

                    $stream->bitstreamfilter = 0;
                    if(isset($_POST['bitstreamfilter'])) {
                        $stream->bitstreamfilter = 1;
                    }
                    $stream->streamurl =  $lines[$key + 1];

                    if($splitline[1] != null || $lines[$key + 1] != null) {
                        $stream->save();
                    } $stream->name = $splitline[1];
                    $stream->cat_id = $_POST['category'];
                    $stream->trans_id = $_POST['transcode'];

                    $stream->restream = 0;
                    if(isset($_POST['restream'])) {
                        $stream->restream = 1;
                    }

                    $stream->bitstreamfilter = 0;
                    if(isset($_POST['bitstreamfilter'])) {
                        $stream->bitstreamfilter = 1;
                    }
                    $stream->streamurl =  $lines[$key + 1];

                    if($splitline[1] != null || $lines[$key + 1] != null) {
                        $stream->save();
                    }
                }



                $message['type'] = "success";
                $message['message'] = "Streams created";

            }
        }
    }
}

echo $template->view()->make('stream_importer')
    ->with('stream',  $stream)
    ->with('categories',  $categories)
    ->with('transcodes',  $transcodes)
    ->with('message', $message)
    ->with('title', $title)
    ->render();
