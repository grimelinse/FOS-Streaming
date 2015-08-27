@extends('main')
@section('content')
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <a href="index.html">Home</a>
        <i class="icon-angle-right"></i>
    </li>
    <li><a href="#">Manage transcodeprofile</a></li>
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
                                <label class="control-label">Profile name:</label>
                                <div class="controls">
                                    <input type="text" name="profilename" value="{{  isset($_POST['name']) ?  $_POST['name'] : $transcode->name}}" placeholder="">
                                </div>
                            </div>



                            <div class="control-group">
                                <label class="control-label">probesize:</label>
                                <div class="controls">
                                    <input type="number" name="probesize" value="{{  isset($_POST['probesize']) ?  $_POST['probesize'] : $transcode->probesize}}" placeholder="15000000">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Analyzeduration:</label>
                                <div class="controls">
                                    <input type="number" name="analyzeduration" value="{{  isset($_POST['analyzeduration']) ?  $_POST['analyzeduration'] : $transcode->analyzeduration}}" placeholder="12000000">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Video codec:</label>
                                <div class="controls">
                                    <select id="video_codec" name="video_codec" data-rel="chosen">
                                        <option value="" {{ isset($_POST['video_codec']) ?  $_POST['video_codec']  == '' : $transcode->video_codec  == '' ? "selected" : "" }}>Disable</option>
                                        <option value="h264" {{ isset($_POST['video_codec']) ?  $_POST['video_codec']  == 'h264' : $transcode->video_codec  == 'h264' ? "selected" : "" }}>H.264</option>
                                        <option value="copy" {{ isset($_POST['video_codec']) ?  $_POST['video_codec']  == 'copy' : $transcode->video_codec  == 'copy' ? "selected" : "" }}>Copy</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Audio codec:</label>
                                <div class="controls">
                                    <select id="audio_codec" name="audio_codec" data-rel="chosen">
                                        <option value="" {{ isset($_POST['audio_codec']) ?  $_POST['audio_codec']  == '' : $transcode->audio_codec  == '' ? "selected" : "" }}>Disable</option>
                                        <option value="libvo_aacenc" {{ isset($_POST['audio_codec']) ?  $_POST['audio_codec']  == 'libvo_aacenc' : $transcode->audio_codec  == 'libvo_aacenc' ? "selected" : "" }}>AAC</option>
                                        <option value="copy" {{ isset($_POST['audio_codec']) ?  $_POST['audio_codec']  == 'copy' : $transcode->audio_codec  == 'copy' ? "selected" : "" }}>Copy</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Profile:</label>
                                <div class="controls">
                                    <select id="profile" name="profile" data-rel="chosen">
                                        <option value="baseline -level 3.0" {{ isset($_POST['profile']) ?  $_POST['profile']  == 'baseline' : $transcode->profile  == 'baseline' ? "selected" : "" }}>Baseline -level 3.0</option>
                                    </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Preset:</label>
                                <div class="controls">
                                    <select id="presemt" name="preset_values" data-rel="chosen">
                                        <option value="" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == '' : $transcode->preset_values  == '' ? "selected" : "" }}>Disable</option>
                                        <option value="ultrafast" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'ultrafast' : $transcode->preset_values  == 'ultrafast' ? "selected" : "" }}>Ultrafast</option>
                                        <option value="superfast" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'superfast' : $transcode->preset_values  == 'superfast' ? "selected" : "" }}>Superfast</option>
                                        <option value="veryfast" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'veryfast' : $transcode->preset_values  == 'veryfast' ? "selected" : "" }}>Superfast</option>
                                        <option value="faster" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'faster' : $transcode->preset_values  == 'faster' ? "selected" : "" }}>Faster</option>
                                        <option value="fast" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'fast' : $transcode->preset_values  == 'fast' ? "selected" : "" }}>Fast</option>
                                        <option value="medium" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'medium' : $transcode->preset_values  == 'medium' ? "selected" : "" }}>Medium</option>
                                        <option value="slow" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'slow' : $transcode->preset_values  == 'slow' ? "selected" : "" }}>Slow</option>
                                        <option value="slower" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'slower' : $transcode->preset_values  == 'slower' ? "selected" : "" }}>Slower</option>
                                        <option value="veryslow" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'veryslow' : $transcode->preset_values  == 'veryslow' ? "selected" : "" }}>Veryslow</option>
                                        <option value="placebo" {{ isset($_POST['preset_values']) ?  $_POST['preset_values']  == 'placebo' : $transcode->preset_values  == 'placebo' ? "selected" : "" }}>Placebo</option>
                                    </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Scalling:</label>
                                <div class="controls">
                                    <select id="selectEhrror" name="scalling" data-rel="chosen">
                                        <option value="" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '' : $transcode->scale  == '' ? "selected" : "" }}>Disable</option>
                                        <option value="1920:1080" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '1920:1080' : $transcode->scale  == '1920:1080' ? "selected" : "" }}>1920x1080</option>
                                        <option value="1680:1056" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '1680:1056' : $transcode->scale  == '1680:1056' ? "selected" : "" }}>1680x1056</option>
                                        <option value="1280:720" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '1280:720' : $transcode->scale  == '1280:720' ? "selected" : "" }}>1280x720</option>
                                        <option value="1024:576" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '1024:576' : $transcode->scale  == '1024:576' ? "selected" : "" }}>1024x576</option>
                                        <option value="960:540" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '960:540' : $transcode->scale  == '960:540' ? "selected" : "" }}>960x540</option>
                                        <option value="850:480" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '850:480' : $transcode->scale  == '850:480' ? "selected" : "" }}>850x480</option>
                                        <option value="720:576" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '720:576' : $transcode->scale  == '720:576' ? "selected" : "" }}>720x576</option>
                                        <option value="720:540" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '720:540' : $transcode->scale  == '720:540' ? "selected" : "" }}>720x540</option>
                                        <option value="720:80" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '720:80' : $transcode->scale  == '720:80' ? "selected" : "" }}>720x480</option>
                                        <option value="720:404" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '720:404' : $transcode->scale  == '720:404' ? "selected" : "" }}>720x404</option>
                                        <option value="704:576" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '704:576' : $transcode->scale  == '704:576' ? "selected" : "" }}>704x576</option>
                                        <option value="640:480" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '640:480' : $transcode->scale  == '640:480' ? "selected" : "" }}>640x480</option>
                                        <option value="640:360" {{ isset($_POST['scalling']) ?  $_POST['scalling']  == '640:360' : $transcode->scale  == '640:360' ? "selected" : "" }}>640x360</option>
                                    </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Aspect ratio:</label>
                                <div class="controls">
                                    <select id="selectEhrrorf" name="aspect_ratio" data-rel="chosen">
                                        <option value="" {{ isset($_POST['aspect_ratio']) ?  $_POST['aspect_ratio']  == '' : $transcode->aspect_ratio  == '' ? "selected" : "" }}>Disable</option>
                                        <option value="16:9" {{ isset($_POST['aspect_ratio']) ?  $_POST['aspect_ratio']  == '16:9' : $transcode->aspect_ratio  == '16:9' ? "selected" : "" }}>16:9</option>
                                        <option value="4:3" {{ isset($_POST['aspect_ratio']) ?  $_POST['aspect_ratio']  == '4:3' : $transcode->aspect_ratio  == '4:3' ? "selected" : "" }}>4:3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Video bitrate:</label>
                                <div class="controls">
                                    <input type="number" name="video_bitrate" value="{{  isset($_POST['video_bitrate']) ?  $_POST['video_bitrate'] : $transcode->video_bitrate}}" placeholder="1500">
                                    <span class="help-inline">Kilobytes</span>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Audio channel:</label>
                                <div class="controls">
                                    <select id="selectError2" name="audio_channel" data-rel="chosen">
                                        <option value="" {{ isset($_POST['audio_channel']) ?  $_POST['audio_channel']  == '' : $transcode->audio_channel  == '' ? "selected" : "" }}>Disable</option>
                                        <option value="1" {{ isset($_POST['audio_channel']) ?  $_POST['audio_channel']  == '1' : $transcode->audio_channel  == '1' ? "selected" : "" }}>Mono</option>
                                        <option value="2" {{ isset($_POST['audio_channel']) ?  $_POST['audio_channel']  == '2' : $transcode->audio_channel  == '2' ? "selected" : "" }}>Stereo</option>
                                    </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Audio bitrate:</label>
                                <div class="controls">
                                    <select id="a0_aac_bitradfdte" name="audio_bitrate" data-rel="chosen">
                                        <option value="32" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '32' : $transcode->audio_bitrate  == '32' ? "selected" : "" }}>32k</option
                                        <option value="48" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '48' : $transcode->audio_bitrate  == '48' ? "selected" : "" }}>48k</option>
                                        <option value="64" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '64' : $transcode->audio_bitrate  == '64' ? "selected" : "" }}>64k</option>
                                        <option value="96" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '96' : $transcode->audio_bitrate  == '96' ? "selected" : "" }}>96k</option>
                                        <option value="128" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '128' : $transcode->audio_bitrate  == '128' ? "selected" : "" }}>128k</option>
                                        <option value="160" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '160' : $transcode->audio_bitrate  == '160' ? "selected" : "" }}>160k</option>
                                        <option value="192" {{ isset($_POST['audio_bitrate']) ?  $_POST['audio_bitrate']  == '192' : $transcode->audio_bitrate  == '192' ? "selected" : "" }}>192k</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">FPS:</label>
                                <div class="controls">
                                    <input type="number" name="fps" value="{{  isset($_POST['fps']) ?  $_POST['fps'] : $transcode->fps}}" placeholder="25">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">minrate :</label>
                                <div class="controls">
                                    <input type="number" name="minrate" value="{{  isset($_POST['minrate']) ?  $_POST['minrate'] : $transcode->minrate}}" placeholder="200">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">maxrate :</label>
                                <div class="controls">
                                    <input type="number" name="maxrate" value="{{  isset($_POST['maxrate']) ?  $_POST['maxrate'] : $transcode->maxrate}}" placeholder="2000">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">bufsize :</label>
                                <div class="controls">
                                    <input type="number" name="bufsize" value="{{  isset($_POST['bufsize']) ?  $_POST['bufsize'] : $transcode->bufsize}}" placeholder="1200">
                                </div>
                            </div>



                            <div class="control-group">
                                <label class="control-label">Audio sampling rate:</label>
                                <div class="controls">
                                    <select id="a0_aac_bitrate" name="audio_sampling_rate" data-rel="chosen">
                                        <option value="">Disable</option>
                                        <option value="32000" {{ isset($_POST['audio_sampling_rate']) ?  $_POST['audio_sampling_rate']  == '32000' : $transcode->audio_sampling_rate  == '32000' ? "selected" : "" }}>32000</option>
                                        <option value="44100" {{ isset($_POST['audio_sampling_rate']) ?  $_POST['audio_sampling_rate']  == '44100' : $transcode->audio_sampling_rate  == '44100' ? "selected" : "" }}>44100</option>
                                        <option value="48000" {{ isset($_POST['audio_sampling_rate']) ?  $_POST['audio_sampling_rate']  == '48000' : $transcode->audio_sampling_rate  == '48000' ? "selected" : "" }}>48000 </option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">crf:</label>
                                <div class="controls">
                                    <input type="number" name="crf" value="{{  isset($_POST['crf']) ?  $_POST['crf'] : $transcode->crf}}" placeholder="23">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">threads  :</label>
                                <div class="controls">
                                    <input type="number" name="threads" value="{{  isset($_POST['threads']) ?  $_POST['threads'] : $transcode->threads}}" placeholder="0">
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label">Deinterlance:</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <div class="checker" id="uniform-optionsCheckbox2"><span><input type="checkbox" name="deinterlance" id="" value="1" {{ $transcode->deinterlance ? "checked" : ""}}></span></div>
                                    </label>
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
