@extends('main')
@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Admins</a></li>
    </ul>

    @if(count($transcodes) > 0)
        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon todo"></i><span class="break"></span>Categories</h2>
                </div>
                <div class="box-content">
                    @if($message)
                        <div class="alert alert-{{ $message['type'] }}">
                            {{ $message['message'] }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transcodes as $key => $trans)
                            <tr>
                                <td class="center">{{ $key+1 }}</td>
                                <td>{{ $trans->name }}</td>
                                <td class="center">

                                    <a class="btn btn-info" href="manage_transcode.php?id={{ $trans->id }}" title="Edit">
                                        <i class="halflings-icon white edit"></i>
                                    </a>

                                    <a class="btn btn-danger" href="transcodes.php?delete={{ $trans->id }}" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="halflings-icon white trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">×</button>
            No transcodes found
        </div>
    @endif
@stop
