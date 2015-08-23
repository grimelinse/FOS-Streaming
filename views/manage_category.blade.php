@extends('main')
@section('content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Category</a></li>
</ul>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon todo"></i><span class="break"></span>{{ $title }}</h2>
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
                                <label class="control-label">Name:</label>
                                <div class="controls">
                                    <input type="text" name="name" value="{{  isset($_POST['name']) ?  $_POST['name'] : $category->name}}">
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
