@extends('layouts.manage')

@section('title','新增隊伍')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row">
                <div class="col-xs-6">
                    <a href="{{ route('teams.index') }}" class="btn btn-default" role="button">< 所有隊伍</a>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">新增隊伍</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/m/teams/') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">隊伍中文名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name_en" class="col-md-4 control-label">隊伍英文名</label>

                            <div class="col-md-6">
                                <input id="name_en" type="text" class="form-control" name="name_en">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">所屬學校</label>

                            <div class="col-md-6">
                                <select id="school" class="form-control" name="school" required>
                                    @if(Auth::user()->school == 'NCTU')
                                    <option value="NCTU" selected>國立交通大學</option>
                                    <option value="NTHU" disabled>國立清華大學</option>
                                    @elseif(Auth::user()->school == 'NTHU')
                                    <option value="NTHU" selected>國立清華大學</option>
                                    <option value="NCTU" disabled>國立交通大學</option>
                                    @else
                                    <option value="NTHU">國立清華大學</option>
                                    <option value="NCTU">國立交通大學</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">所屬比賽</label>

                            <div class="col-md-6">
                                <select id="game" class="form-control" name="game" required>
                                    @foreach($games as $data)    
                                    <option value="{{ $data->game }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
                            <label for="introduction" class="col-md-4 control-label">簡介</label>

                            <div class="col-md-6">
                                <textarea id="introduction" class="form-control" name="introduction"></textarea>
                                @if ($errors->has('introduction'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('introduction') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link_website') ? ' has-error' : '' }}">
                            <label for="link_website" class="col-md-4 control-label">官網網址</label>

                            <div class="col-md-6">
                                <input id="link_website" type="text" class="form-control" name="link_website">
                                @if ($errors->has('link_website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('link_facebook') ? ' has-error' : '' }}">
                            <label for="link_facebook" class="col-md-4 control-label">facebook粉絲頁網址</label>

                            <div class="col-md-6">
                                <input id="link_facebook" type="text" class="form-control" name="link_facebook">
                                @if ($errors->has('link_facebook'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_facebook') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('link_instagram') ? ' has-error' : '' }}">
                            <label for="link_instagram" class="col-md-4 control-label">instagram網址</label>

                            <div class="col-md-6">
                                <input id="link_instagram" type="text" class="form-control" name="link_instagram">
                                @if ($errors->has('link_instagram'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_instagram') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('file_logo') ? ' has-error' : '' }}">
                            <label for="file_logo" class="col-md-4 control-label">隊伍Logo</label>

                            <div class="col-md-6">
                                <input id="file_logo" type="file" class="form-control" name="file_logo">
                                @if ($errors->has('file_logo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file_logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('file_photo') ? ' has-error' : '' }}">
                            <label for="file_photo" class="col-md-4 control-label">隊伍照片</label>

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
                                    新增隊伍
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection