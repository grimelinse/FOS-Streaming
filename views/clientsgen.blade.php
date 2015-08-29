@extends('main')
@section('content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">User clients</a></li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon todo"></i><span class="break"></span>{{ $title }}</h2>
        </div>
        <div class="box-content">
                <div class="box-content">
                    <form class="form-horizontal" role="form" action="" method="post">
                        <fieldset>

                            <div class="control-group">
                                <label class="control-label">M3u8:</label>
                                <div class="controls">
                                    <input type="text" class="span12"  value="http://{{ $setting->webip }}:{{ $setting->webport }}/playlist.php?username={{ $user->username }}&password={{ $user->password }}&m3u">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">E2:</label>
                                <div class="controls">
                                    <input type="text" class="span12"  value="http://{{ $setting->webip }}:{{ $setting->webport }}/playlist.php?username={{ $user->username }}&password={{ $user->password }}&e2">
                                </div>
                            </div>


                        </fieldset>
                    </form>

                </div>


        </div>
    </div><!--/span-->

</div><!--/row-->

@stop
