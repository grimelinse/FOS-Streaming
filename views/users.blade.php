@extends('main')
@section('content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Users</a></li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon todo"></i><span class="break"></span>Users</h2>
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
                    <th>Name</th>
                    <th>Password</th>
                    <th>Category</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td class="center">{{ $key+1 }}</td>
                        <td>{{ $user->username }}</td>
                        <td class="center">{{ $user->password }}</td>
                        <td class="center">{{ $user->category_names }}</td>
                        <td class="center">
                            <a href="getfile.php?m3u=true&id={{ $user->id }}" title="GET M3U"><span class="label label-success">M3U</span></a>
                            {{--<a href="getfile.php?e2=true&id={{ $user->id }}" title="GET E2"><span class="label label-success">E2</span></a>--}}
                            <a href="getfile.php?tv=true&id={{ $user->id }}" title="GET TV"><span class="label label-success">TV</span></a>
                        </td>
                        <td class="center">

                            <a class="btn btn-info" href="manage_user.php?id={{ $user->id }}" title="Edit">
                                <i class="halflings-icon white edit"></i>
                            </a>

                            <a class="btn btn-danger" href="users.php?delete={{ $user->id }}" title="Delete" onclick="return confirm('Are you sure?')">
                                <i class="halflings-icon white trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div><!--/row-->
@stop