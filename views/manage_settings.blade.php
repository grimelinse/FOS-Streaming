@extends('main')
@section('content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Settings</a></li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon todo"></i><span class="break"></span>Edit settings</h2>
        </div>
        <div class="box-content">
            @if($message)
            <div class="alert alert-{{ $message['type'] }}">
               {{ $message['message'] }}
            </div>
        @endif
                <div class="box-content">
                    <form class="form-horizontal" role="form" action="" method="post">
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label">Path to ffmpeg:</label>
                                <div class="controls">
                                    <input type="text" name="ffmpeg_path" value="{{  isset($_POST['ffmpeg_path']) ?  $_POST['ffmpeg_path'] : $setting->ffmpeg_path}}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Path to ffprobe:</label>
                                <div class="controls">
                                    <input type="text" name="ffprobe_path" value="{{  isset($_POST['ffprobe_path']) ?  $_POST['ffprobe_path'] : $setting->ffprobe_path}}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Web ip:</label>
                                <div class="controls">
                                    <input type="text" name="webip" value="{{  isset($_POST['webip']) ?  $_POST['webip'] : $setting->webip}}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Web port:</label>
                                <div class="controls">
                                    <input type="text" name="webport" value="{{  isset($_POST['webport']) ?  $_POST['webport'] : $setting->webport}}">
                                    <span class="label label-important">Important: restart nginx manualy ( killall -9 nginx && /usr/local/nginx/sbin/nginx )</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">HLS folder:</label>
                                <div class="controls">
                                    <input type="text" name="hlsfolder" value="{{  isset($_POST['hlsfolder']) ?  $_POST['hlsfolder'] : $setting->hlsfolder}}">
                                    <span class="label label-important">Important: cannot be changed (BUG) hl</span>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                            </div>
                        </fieldset>
                    </form>

                </div>


        </div>
    </div><!--/span-->

</div><!--/row-->
@stop
