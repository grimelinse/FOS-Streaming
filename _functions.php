<?php
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
    if (!isset($_SESSION['user_id'])){
        header("location: index.php");
    }
}


function stop_stream($id)
{
    $stream = Stream::find($id);
    $setting = Setting::first();

    shell_exec("kill -9 " . $stream->pid);
    shell_exec("/bin/rm -r /usr/local/nginx/html/" . $setting->hlsfolder . "/" . $stream->id . "*");

    $stream->pid = "";
    $stream->running = 0;
    $stream->status = 0;

    $stream->save();
}

function checkPid($pid) {
    exec("ps $pid", $output, $result);
    return count($output) >= 2 ? true : false;
}

function getTranscode($id) {
    $stream = Stream::find($id);
    $setting = Setting::first();

    $trans = $stream->transcode;

    $ffmpeg = $setting->ffmpeg_path;

    $endofffmpeg = "";
    $endofffmpeg .=  $stream->bitstreamfilter ? ' -bsf h264_mp4toannexb' : '';
    $endofffmpeg .= ' -hls_flags delete_segments -hls_time 10 -hls_base_url http://'.$setting->webip.':'.$setting->webport.'/'.$setting->hlsfolder.'/';
    $endofffmpeg .= ' -hls_list_size 8 /usr/local/nginx/html/' . $setting->hlsfolder . '/'.$stream->id.'_.m3u8  > /dev/null 2>/dev/null & echo $! ';

    if($trans) {

        $ffmpeg .= ' -y';
        $ffmpeg .= ' -probesize ' . ($trans->probesize ? $trans->probesize : '15000000');
        $ffmpeg .= ' -analyzeduration ' . ($trans->analyzeduration ? $trans->analyzeduration : '12000000');
        $ffmpeg .= ' -i '.'"' . "$stream->streamurl" . '"' ;
        $ffmpeg .= ' -user_agent "FOS-Streaming"';
        $ffmpeg .= ' -strict -2 -dn ';
        $ffmpeg .= $trans->scale ? ' -vf scale=' . ($trans->scale ? $trans->scale : '') : '';
        $ffmpeg .= $trans->audio_codec ? ' -acodec ' . $trans->audio_codec : ''; '';
        $ffmpeg .= $trans->video_codec ? ' -vcodec ' . $trans->video_codec : '';
        $ffmpeg .= $trans->profile ? ' -profile:v ' .  $trans->profile : '';
        $ffmpeg .= $trans->preset ? ' -preset ' .  $trans->preset_values : '';
        $ffmpeg .= $trans->video_bitrate ? ' -b:v ' . $trans->video_bitrate . 'k' : '';
        $ffmpeg .= $trans->audio_bitrate ? ' -b:a ' . $trans->audio_bitrate . 'k' : '';
        $ffmpeg .= $trans->fps ? ' -r ' . $trans->fps : '';
        $ffmpeg .= $trans->minrate ? ' -minrate ' . $trans->minrate . 'k' : '';
        $ffmpeg .= $trans->maxrate ? ' -maxrate ' . $trans->maxrate . 'k' : '';
        $ffmpeg .= $trans->bufsize ? ' -bufsize ' .$trans->bufsize . 'k' : '';
        $ffmpeg .= $trans->aspect_ratio ? ' -aspect ' . $trans->aspect_ratio : '';
        $ffmpeg .= $trans->audio_sampling_rate ? ' -ar ' . $trans->audio_sampling_rate : '';
        $ffmpeg .= $trans->crf ? ' -crf ' . $trans->crf : '';
        $ffmpeg .= $trans->audio_channel ? ' -ac ' . $trans->audio_channel : '';
        $ffmpeg .= $stream->bitstreamfilter ? ' -bsf h264_mp4toannexb' : '';
        $ffmpeg .= $trans->threads ? ' -threads ' . $trans->threads : '';
        $ffmpeg .= $trans->deinterlance ? ' -vf yadif ' . $trans->deinterlance : '';

        $ffmpeg .= $endofffmpeg;
        return $ffmpeg;
    }

    $ffmpeg .= ' -probesize 15000000 -analyzeduration 9000000 -user_agent "FOS-Streaming" -i "'.$stream->streamurl.'"';
    $ffmpeg .= ' -c copy -c:a libvo_aacenc -b:a 128k';
    $ffmpeg .= $endofffmpeg;

    return $ffmpeg;
}

function start_stream($id)
{
    $stream = Stream::find($id);
    $setting = Setting::first();

    $checkstreamurl = shell_exec('/usr/bin/timeout 15s '.$setting->ffprobe_path.' -analyzeduration 10000000 -probesize 9000000 -i "'.$stream->streamurl.'" -v  quiet -print_format json -show_streams 2>&1');
    $streaminfo = (array) json_decode($checkstreamurl);

    if(count($streaminfo) > 0) {

        if(!$stream->restream) {
            $pid = shell_exec(getTranscode($stream->id));
            $stream->pid = $pid;
        }

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


function generatEginxConfPort($port) {
    ob_start();
    echo 'user  root;
    worker_processes  auto;

    error_log  logs/error.log debug;

    events {
        worker_connections  1024;
    }

    http {
        include       mime.types;
        default_type  application/octet-stream;

        sendfile        on;
        keepalive_timeout  65;

        server {
            listen '.$port.';
                    root /usr/local/nginx/html/;
                    index index.php index.html index.htm;
                    server_tokens off;
                    chunked_transfer_encoding off;
                    rewrite  ^/(.*)/(.*)/(.*)$ /stream.php?username=$1&password=$2&stream=$3 break;

     location ~ \.php$ {
            try_files $uri =404;
                            fastcgi_index index.php;
                            fastcgi_pass unix:/var/run/php5-fpm.sock;
                            include fastcgi_params;
                            fastcgi_keep_conn on;
                            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                            fastcgi_param SCRIPT_NAME $fastcgi_script_name;
                    }

            error_page   500 502 503 504  /50x.html;
            location = /50x.html {
                root   html;
            }
        }
    }

    rtmp {
        server {
            listen 1935;
            ping 30s;
            notify_method get;

            application rtmp {
                live on;
            }

        }
    }';
    $file ='/usr/local/nginx/conf/nginx.conf';
    $current = ob_get_clean();
    file_put_contents($file, $current);
}