@extends('layout.base')

@section('title')
<title>Twitter's Collage Creator </title>
@stop

@section('main')
<div class="row">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3">
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Collage generator</div>            </div>

            <div style="padding-top:30px" class="panel-body" >
                <form id="loginform" class="form-horizontal" method='post' action='/'>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="User name"  value="{{ Input::old('name')}}" >
                    </div>  
                     @if($errors->first('name'))
                     <label for='height' class='error' style='color: red'>{{ $errors->first('name')}}</label><br/>
                    @endif
                    <label>Choose dimension:</label>
                    <div class="input-group">
                        <label class="radio-inline">
                            <input type="radio"  name="dimension"  checked value="pixel"> By pixel
                        </label>
                        <label class="radio-inline">
                            <input type="radio"  name="dimension"  value="avatar" @if(Input::old('dimension') === 'avatar') checked @endif> By count avatars
                        </label>                      

                    </div>
                    <div style="margin-top: 25px" class="form-group">
                        <label for="width" class="col-sm-2 control-label">Width</label>
                        <div class="col-sm-10">
                            <input type="number" name='width' class="form-control" id="width" placeholder="Width"  value="{{ Input::old('width')}}">
                        </div>
                    </div>
                     @if($errors->first('width'))
                     <label for='width' class='error'  style='color: red'>{{ $errors->first('width')}}</label>
                    @endif
                    <div class="form-group">
                        <label for="height" class="col-sm-2 control-label">Height</label>
                        <div class="col-sm-10">
                            <input type="number" name='height' class="form-control" id="height" placeholder="Height" value='{{ Input::old('height')}}'>
                        </div>
                    </div>   
                    @if($errors->first('height'))
                     <label for='height' class='error'  style='color: red'>{{ $errors->first('height')}}</label>
                    @endif
                    <div style="margin-top:10px" class="form-group">

                        <div class="col-sm-12 controls">
                            <input id="btn-login" class="btn btn-success" type='submit' value='Generate'>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop