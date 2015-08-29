@extends('main')
@section('content')

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Streams</a></li>
    </ul>
    @if(count($streams) > 0)
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon todo"></i><span class="break"></span>{{ $title }}</h2>
                </div>
                <div class="box-content">
                    <button class="btn btn-small btn-danger">Masa delete</button>
                    </br> </br>
                    @if($message)
                        <div class="alert alert-{{ $message['type'] }}">
                            {{ $message['message'] }}
                        </div>
                    @endif

                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th></th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Video</th>
                            <th>Audio</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($streams as $key => $stream)

                            <tr>
                                <td class="center"> {{ $key+1 }}</td>
                                <td class="center"><input type="checkbox" name="mselect[]" value="{{ $stream->id }}"></td>
                                <td>{{ $stream->name }}</td>
                                <td class="center"><span class="label label-{{ $stream->status_label['label'] }}">{{ $stream->status_label['text'] }}</span></td>
                                <td class="center">{{ $stream->category ? $stream->category->name : '' }} </td>
                                <td>{{ $stream->video_codec_name }}</td>
                                <td>{{ $stream->audio_codec_name }}</td>
                                <td class="center">
                                    @if($stream->status == 1)
                                        <a class="btn btn-important" title="STOP STREAM" href="streams.php?stop={{ $stream->id }}"><i class="halflings-icon white stop"></i></a>
                                    @elseif ($stream->status != 1)
                                        <a class="btn btn-success" title="START STREAM" href="streams.php?start={{ $stream->id }}"><i class="halflings-icon white play"></i></a>
                                    @endif

                                    <a class="btn btn-info" href="manage_stream.php?id={{ $stream->id }}" title="Edit">
                                        <i class="halflings-icon white edit"></i>
                                    </a>
                                    <a class="btn btn-success" title="SHOW STREAM" onclick="window.open('play.php?id={{ $stream->id }}', 'play','status,width=400,height=328'); return false" href="#">
                                        <i class="halflings-icon white zoom-in"></i>
                                    </a>

                                    <a class="btn btn-danger" href="streams.php?delete={{ $stream->id }}" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    @else
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">×</button>
            No streams found
        </div>
    @endif
@stop