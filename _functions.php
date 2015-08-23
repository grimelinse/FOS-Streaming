<?php
/**
 * Created by Tyfix 2015
 */
function redirect($url, $time) {
    echo "<script>
                window.setTimeout(function(){
                    window.location.href = '" . $url ."';
                }, " . $time .");
            </script>";
}

if (isset($_GET['logout'])) {
    session_destroy();
}

function logincheck() {
    if (!isset($_SESSION['login_user'])){
        header("location: index.php");
    }
}

function stop_stream($id)
{
    $stream = Stream::find($id);
    $setting = Setting::first();

    shell_exec("kill -9 " . $stream->pid);
    shell_exec("/bin/rm -r /usr/local/nginx/html/" . $setting->hlsfolder . "/" . $stream->name . "*");

    $stream->pid = "";
    $stream->running = 0;
    $stream->status = 0;
    $stream->action = 0;

    $stream->save();
}


function checkPid($pid) {
    exec("ps $pid", $output, $result);
    return count($output) >= 2 ? true : false;
}


function start_stream($id)
{
    $stream = Stream::find($id);
    $setting = Setting::first();

    $checkstreamurl = shell_exec('/usr/bin/timeout 15s '.$setting->ffprobe_path.' -analyzeduration 10000000 -probesize 9000000 -i '.$stream->streamurl.' -v  quiet -print_format json -show_streams 2>&1');
    $streaminfo = (array) json_decode($checkstreamurl);

    if(count($streaminfo) > 0) {

        $pid = shell_exec($setting->ffmpeg_path . ' -probesize 15000000 -analyzeduration 9000000 -user_agent "FOS-Streaming" -i '.$stream->streamurl.' -c copy -c:a libvo_aacenc -b:a 128k  -hls_flags delete_segments -hls_time 10 -hls_base_url http://'.$setting->webip.':'.$setting->webport.'/'.$setting->hlsfolder.'/ -hls_list_size 8 /usr/local/nginx/html/' . $setting->hlsfolder . '/'.$stream->name.'_.m3u8  > /dev/null 2>/dev/null & echo $! ');

        $stream->pid = $pid;
        $stream->running = 1;
        $stream->status = 1;

        foreach((array)$streaminfo->streams as $info ) {
            if($info->codec_type == 'video') {
                $stream->video_codec_name = $info->codec_long_name;
            } else if($info->codec_type == 'audio') {
                $stream->audio_codec_name = $info->codec_long_name;
            }
        }
    } else {
        $stream->running = 0;
        $stream->status = 2;
    }

    $stream->save();
}