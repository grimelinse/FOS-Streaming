<?php
if(isset($_SERVER['SERVER_ADDR'])) {
    if( $_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR'] ){
        die('access is not permitted');
    }
}
include('config.php');

$setting = Setting::first();
$streams = Stream::where('pid', '!=', 0)->where('running', '=', 1)->get();

foreach($streams as $stream) {
    if (!checkPid($stream->pid)) {

        $checkstreamurl = shell_exec('/usr/bin/timeout 15s '.$setting->ffprobe_path.' -analyzeduration 10000000 -probesize 9000000 -i "'.$stream->streamurl.'" -v  quiet -print_format json -show_streams 2>&1');
        $streaminfo = (array) json_decode($checkstreamurl);
        if(count($streaminfo) > 0) {

            $pid = shell_exec(getTranscode($stream->id));

            $stream->pid = $pid;
            $stream->running = 1;
            $stream->status = 1;

            foreach((array)$streaminfo->streams as $info ) {
                if($info->codec_type == 'video') {
                    $stream->video_codec_name = $info->codec_long_name;
                }
                else if($info->codec_type == 'audio') {
                    $stream->audio_codec_name = $info->codec_long_name;
                }
            }
        } else {
            $stream->running = 1;
            $stream->status = 2;

            //need to make recursive

            ////streamurl 2 checker
            if($stream->streamurl2) {
                $checkstreamurl = shell_exec('/usr/bin/timeout 15s '.$setting->ffprobe_path.' -analyzeduration 10000000 -probesize 9000000 -i "'.$stream->streamurl2.'" -v  quiet -print_format json -show_streams 2>&1');
                $streaminfo = (array) json_decode($checkstreamurl);

                if(count($streaminfo) > 0) {

                    $pid = shell_exec(getTranscode($stream->id));

                    $stream->pid = $pid;
                    $stream->running = 1;
                    $stream->status = 1;

                    foreach((array)$streaminfo->streams as $info ) {
                        if($info->codec_type == 'video') {
                            $stream->video_codec_name = $info->codec_long_name;
                        }
                        else if($info->codec_type == 'audio') {
                            $stream->audio_codec_name = $info->codec_long_name;
                        }
                    }
                } else {
                    $stream->running = 1;
                    $stream->status = 2;

                    //streamurl 3 checker
                    if($stream->streamurl3) {
                        $checkstreamurl = shell_exec('/usr/bin/timeout 15s ' . $setting->ffprobe_path . ' -analyzeduration 10000000 -probesize 9000000 -i "' . $stream->streamurl3 . '" -v  quiet -print_format json -show_streams 2>&1');
                        $streaminfo = (array)json_decode($checkstreamurl);

                        if (count($streaminfo) > 0) {

                            $pid = shell_exec(getTranscode($stream->id));

                            $stream->pid = $pid;
                            $stream->running = 1;
                            $stream->status = 1;

                            foreach ((array)$streaminfo->streams as $info) {
                                if ($info->codec_type == 'video') {
                                    $stream->video_codec_name = $info->codec_long_name;
                                } else if ($info->codec_type == 'audio') {
                                    $stream->audio_codec_name = $info->codec_long_name;
                                }
                            }
                        } else {
                            $stream->running = 1;
                            $stream->status = 2;
                        }
                    }
                }
            }

        }
        $stream->save();
    }
}
