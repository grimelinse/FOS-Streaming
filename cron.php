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

        $checkstreamurl = shell_exec('/usr/bin/timeout 15s '.$setting->ffprobe_path.' -analyzeduration 10000000 -probesize 9000000 -i '.$stream->streamurl.' -v  quiet -print_format json -show_streams 2>&1');
        $streaminfo = (array) json_decode($checkstreamurl);
        if(count($streaminfo) > 0) {

            $pid = shell_exec($setting->ffmpeg_path . ' -probesize 15000000 -analyzeduration 9000000 -user_agent "FOS-Streaming" -i '.$stream->streamurl.' -c copy -c:a libvo_aacenc -b:a 128k  -hls_flags delete_segments -hls_time 10 -hls_base_url http://'.$setting->webip.':'.$setting->webport.'/'.$setting->hlsfolder.'/ -hls_list_size 8 /usr/local/nginx/html/' . $setting->hlsfolder . '/'.$stream->name.'_.m3u8  > /dev/null 2>/dev/null & echo $! ');

            $stream->pid = $pid;
            $stream->running = 1;
            $stream->status = 1;

            foreach($streaminfo->streams as $info ) {
                if($info->codec_type == 'video') {
                    $stream->video_codec_name = $info->codec_long_name;
                }
                else if($info->codec_type == 'audio') {
                    $stream->audio_codec_name = $info->codec_long_name;
                }
            }
        } else {
            $stream->running = 0;
            $stream->status = 2;
        }

        $stream->save();
    }
}
?>
