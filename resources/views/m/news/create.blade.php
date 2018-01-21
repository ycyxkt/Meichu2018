@extends('layouts.manage')

@section('title','新增消息')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('news.index') }}" class="btn btn-default" role="button">< 所有消息</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">新增消息</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/news/') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">20字內</span>
                    標題
                </label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="group" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    組織
                </label>

                <div class="col-md-6">
                    @switch(Auth::user()->group)
                        @case('committee')
                            <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '梅竹賽籌備委員會' }}" required>
                            @break
                        @case('cheer')
                            @if(Auth::user()->school == 'NCTU')
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '交大梅竹後援會' }}" required>
                            @elseif(Auth::user()->school == 'NTHU')
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '清大梅竹工作會' }}" required>
                            @endif
                            @break
                        @case('media')
                            @if(Auth::user()->school == 'NCTU')
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '交大喀報' }}" required>
                            @elseif(Auth::user()->school == 'NTHU')
                                <input id="group" type="text" class="form-control" name="group" value="{{ old('group')!=NULL ? old('group') : '清華電台' }}" required>
                            @endif
                            @break
                        @case('admin')
                            <input id="group" type="text" class="form-control" name="group" value="{{ old('group') }}" required>
                            @break
                    @endswitch
                </div>
            </div>

            <div class="form-group">
                <label for="author" class="col-md-4 control-label">
                    作者
                </label>

                <div class="col-md-6">
                    <input id="author" type="text" class="form-control" name="author" value="{{ old('author') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="tag" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    分類
                </label>

                <div class="col-md-6">
                    <select id="tag" class="form-control" name="tag" required> 
                        <option value="news">新聞</option>
                        <option value="ann_events">活動公告</option>
                        @if(Auth::user()->group== 'committee' || Auth::user()->group == 'admin')
                            <option value="ann_games">
                                賽事公告
                            </option>
                        @endif
                        <option value="other">其他</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="game" class="col-md-4 control-label">
                    所屬賽事
                </label>

                <div class="col-md-6">
                    <select id="game" class="form-control" name="game">
                        <option value=""></option>
                        @foreach($games as $data)    
                        <option value="{{ $data->game }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                <label for="content" class="col-md-4 control-label">
                    <span class="label label-default">300字內</span>
                    內文
                </label>

                <div class="col-md-6">
                    <textarea id="content" class="form-control" name="content" rows="8">{{ old('content') }}</textarea>
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                <label for="link" class="col-md-4 control-label">
                    <span class="label label-default">網址</span>
                    新聞連結
                </label>

                <div class="col-md-6">
                    <input id="link" type="url" class="form-control" name="link" value="{{ old('link') }}">
                    @if ($errors->has('link'))
                        <span class="help-block">
                            <strong>{{ $errors->first('link') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        新增消息
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection