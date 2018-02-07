@extends('layouts.manage')

@section('title','編輯消息')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('news.index') }}" class="btn btn-default" role="button">< 所有消息</a>
    </div>
    <div class="col-xs-6 text-right">
        <a href="{{ route('news.show',$news->id) }}" class="btn btn-success" role="button">查看</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">編輯消息</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/news/'.$news->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">80字內</span>
                    標題
                </label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ $news->title }}" required>
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
                    <input id="group" type="text" class="form-control" name="group" value="{{ $news->group }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="author" class="col-md-4 control-label">
                    作者
                </label>

                <div class="col-md-6">
                    <input id="author" type="text" class="form-control" name="author" value="{{ $news->author }}">
                </div>
            </div>

            <div class="form-group">
                <label for="tag" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    分類
                </label>

                <div class="col-md-6">
                    <select id="tag" class="form-control" name="tag" required> 
                        <option value="news" @if($news->tag == 'news') selected @endif>新聞</option>
                        <option value="ann_events" @if($news->tag == 'ann_events') selected @endif>活動公告</option>
                        @if(Auth::user()->group== 'committee' || Auth::user()->group == 'admin')
                        <option value="ann_games" @if($news->tag == 'ann_games') selected @endif>賽事公告</option>
                        @endif
                        <option value="other" @if($news->tag == 'other') selected @endif>其他</option>
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
                        <option value="{{ $data->game }}" @if($news->game == $data->game) selected @endif>{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if(Auth::user()->group == 'admin' || Auth::user()->group == 'committee')
            <div class="form-group">
                <label for="is_sticky" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    是否置頂
                </label>

                <div class="col-md-6"> 
                    <input id="is_sticky" type="radio" name="is_sticky" value="1" @if($news->is_sticky==true) checked @endif>是
                    <input id="is_sticky" type="radio" name="is_sticky" value="0" @if($news->is_sticky==false) checked @endif>否
                </div>
            </div>
            @endif

            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                <label for="content" class="col-md-4 control-label">
                    <span class="label label-default">600字內</span>
                    內文
                </label>

                <div class="col-md-6">
                    <textarea id="content" class="form-control" name="content" rows="8">{{ $news->content }}</textarea>
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
                    <input id="link" type="url" class="form-control" name="link" value="{{ $news->link }}">
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
                        更新資訊
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection