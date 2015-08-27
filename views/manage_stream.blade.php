@extends('main')
@section('content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Manage admin</a></li>
</ul>

@if(count($categories) > 0)
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
                                    <input type="text" name="name" value="{{  isset($_POST['name']) ?  $_POST['name'] : $stream->name}}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Streamurl:</label>
                                <div class="controls">
                                    <input type="text" name="streamurl" value="{{  isset($_POST['streamurl']) ?  $_POST['streamurl'] : $stream->streamurl}}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Restream:</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <div class="checker" id="uniform-optionsCheckbox2"><span><input type="checkbox" name="restream" id="" value="1" {{ $stream->restream ? "checked" : ""}}></span></div>
                                    </label>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Bit stream filter:</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <div class="checker" id="uniform-optionsCheckbox2"><span><input type="checkbox" name="bitstreamfilter" id="" value="1" {{ $stream->bitstreamfilter ? "checked" : ""}}></span></div>
                                    </label>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Category</label>
                                <div class="controls">
                                    <select name="category" id="selectError3" data-rel="chosen">
                                        <option value='{{ $stream->category ? $stream->category->id : "" }}'>{{ $stream->category ? $stream->category->name : "Select" }}</option>
                                        @foreach($categories as $category)
                                            <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Transcode profile</label>
                                <div class="controls">
                                    <select name="transcode" id="transcode" data-rel="chosen">
                                        <option value='0'>No transcode</option>
                                        @foreach($transcodes as $trans)
                                            <option value='{{ $trans->id }}' {{ $stream->trans_id  == $trans->id ? "selected" : "" }}>{{ $trans->name }}</option>
                                        @endforeach
                                    </select>
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

@else
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Error!</strong> You need to create an category!
    </div>

@endif
@stop
