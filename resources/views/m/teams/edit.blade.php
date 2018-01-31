@extends('layouts.manage')

@section('title','編輯隊伍')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('teams.index') }}" class="btn btn-default" role="button">< 所有隊伍</a>
    </div>
    <div class="col-xs-6 text-right">
        <a href="{{ route('teams.show',$team->id) }}" class="btn btn-success" role="button">查看</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">編輯隊伍</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/teams/'.$team->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="school" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    學校
                </label>

                <div class="col-md-6">
                    <select id="school" class="form-control" name="school" required>
                        @if(Auth::user()->school == 'NCTU')
                        <option value="NCTU" @if($team->school == 'NCTU') selected @endif>國立交通大學</option>
                        <option value="NTHU" disabled>國立清華大學</option>
                        <option value="other" @if($team->school == 'other') selected @endif>其他</option>
                        @elseif(Auth::user()->school == 'NTHU')
                        <option value="NTHU" @if($team->school == 'NTHU') selected @endif>國立清華大學</option>
                        <option value="NCTU" disabled>國立交通大學</option>
                        <option value="other" @if($team->school == 'other') selected @endif>其他</option>
                        @else
                        <option value="NTHU" @if($team->school == 'NTHU') selected @endif>國立清華大學</option>
                        <option value="NCTU" @if($team->school == 'NCTU') selected @endif>國立交通大學</option>
                        <option value="other" @if($team->school == 'other') selected @endif>其他</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">不用校名</span>
                    隊伍中文名
                </label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $team->name }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="name_en" class="col-md-4 control-label">
                    <span class="label label-default">不用校名</span>
                    隊伍英文名
                </label>

                <div class="col-md-6">
                    <input id="name_en" type="text" class="form-control" name="name_en" value="{{ $team->name_en }}">
                </div>
            </div>

            <div class="form-group">
                <label for="game" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    所屬賽事
                </label>

                <div class="col-md-6">
                    <select id="game" class="form-control" name="game" required>
                        @foreach($games as $data)    
                        <option value="{{ $data->game }}" @if($team->game == $data->game) selected @endif>{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
                <label for="introduction" class="col-md-4 control-label">
                    <span class="label label-default">120字內</span>
                    簡介
                </label>

                <div class="col-md-6">
                    <textarea id="introduction" class="form-control" name="introduction" rows="6">{{ $team->introduction }}</textarea>
                    @if ($errors->has('introduction'))
                        <span class="help-block">
                            <strong>{{ $errors->first('introduction') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('link_website') ? ' has-error' : '' }}">
                <label for="link_website" class="col-md-4 control-label">
                    <span class="label label-default">網址</span>
                    官網網址
                </label>

                <div class="col-md-6">
                    <input id="link_website" type="url" class="form-control" name="link_website" value="{{ $team->link_website }}">
                    @if ($errors->has('link_website'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link_website') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('link_facebook') ? ' has-error' : '' }}">
                <label for="link_facebook" class="col-md-4 control-label">
                    <span class="label label-default">網址</span>
                    Facebook粉絲頁網址
                </label>

                <div class="col-md-6">
                    <input id="link_facebook" type="url" class="form-control" name="link_facebook" value="{{ $team->link_facebook }}">
                    @if ($errors->has('link_facebook'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link_facebook') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('link_instagram') ? ' has-error' : '' }}">
                <label for="link_instagram" class="col-md-4 control-label">
                    <span class="label label-default">網址</span>
                    Instagram帳號網址
                </label>

                <div class="col-md-6">
                    <input id="link_instagram" type="url" class="form-control" name="link_instagram" value="{{ $team->link_instagram }}">
                    @if ($errors->has('link_instagram'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link_instagram') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!--<div class="form-group">
                <label class="col-md-4 control-label">隊伍目前Logo</label>

                <div class="col-md-6 form-control-static">
                    @if($team->logo != NULL)
                        <img src="{{ asset('images/'.$team->logo) }}" width="200px">
                    @else
                        目前無Logo
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('file_logo') ? ' has-error' : '' }}">
                <label for="file_logo" class="col-md-4 control-label">
                    <span class="label label-default">圖像格式</span>
                    <span class="label label-default">不大於5MB</span>
                    更換隊伍Logo
                </label>

                <div class="col-md-6">
                    <input id="file_logo" type="file" class="form-control" name="file_logo">
                    @if ($errors->has('file_logo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file_logo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>-->

            <div class="form-group">
                <label class="col-md-4 control-label">隊伍目前照片</label>

                <div class="col-md-6 form-control-static">
                    @if($team->photo != NULL)
                        <img src="{{ $team->photo }}" width="400px">
                    @else
                        目前無照片
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('file_photo') ? ' has-error' : '' }}">
                <label for="file_photo" class="col-md-4 control-label">
                    <span class="label label-default">圖像格式</span>
                    <span class="label label-default">不大於5MB</span>
                    更換隊伍照片
                </label>

                <div class="col-md-6">
                    <input id="file_photo" type="file" class="form-control" name="file_photo">
                    @if ($errors->has('file_photo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file_photo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        更新資訊
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection