@extends('layouts.manage')

@section('title','編輯賽事')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('games.index') }}" class="btn btn-default" role="button">< 所有賽事</a>
    </div>
    <div class="col-xs-6 text-right">
    <a href="{{ url('games/'.$game->game) }}" class="btn btn-success" role="button">查看前台頁面</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">編輯賽事</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/games/'.$game->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <h2 class="text-center">
                {{ $game->name }} {{ $game->game }}
            </h2>

            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="date" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">3/2 - 3/4 間</span>
                    日期
                </label>

                <div class="col-md-6">
                    <input id="date" type="date" class="form-control" name="date" value="{{ $game->date }}" required>
                    @if ($errors->has('date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="time" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    時間
                </label>

                <div class="col-md-6">
                    <input id="time" type="time" class="form-control" name="time" value="{{ $game->time }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    狀態
                </label>

                <div class="col-md-6">
                    <select id="status" class="form-control" name="status" required>
                        <option value="notyet" @if($game->status == 'notyet') selected @endif>尚未開始</option>
                        <option value="prepare" @if($game->status == 'prepare') selected @endif>準備中</option>
                        <option value="inprogress" @if($game->status == 'inprogress') selected @endif>進行中</option>
                        <option value="nthuwin" @if($game->status == 'nthuwin') selected @endif>清大勝</option>
                        <option value="nctuwin" @if($game->status == 'nctuwin') selected @endif>交大勝</option>
                        <option value="draw" @if($game->status == 'draw') selected @endif>平手</option>
                        <option value="break" @if($game->status == 'break') selected @endif>暫停中</option>
                        <option value="stop" @if($game->status == 'stop') selected @endif>因故停賽</option>
                    </select>
                </div>
            </div>

            <div class="form-group{{ $errors->has('score_nthu') ? ' has-error' : '' }}">
                <label for="score_nthu" class="col-md-4 control-label">
                    <span class="label label-default">數字</span>
                    清大比分
                </label>

                <div class="col-md-6">
                    <input id="score_nthu" type="number" class="form-control" name="score_nthu" value="{{ $game->score_nthu }}" step="any">
                    @if ($errors->has('score_nthu'))
                        <span class="help-block">
                            <strong>{{ $errors->first('score_nthu') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('score_nctu') ? ' has-error' : '' }}">
                <label for="score_nctu" class="col-md-4 control-label">
                    <span class="label label-default">數字</span>
                    交大比分
                </label>

                <div class="col-md-6">
                    <input id="score_nctu" type="number" class="form-control" name="score_nctu" value="{{ $game->score_nctu }}" step="any">
                    @if ($errors->has('score_nctu'))
                        <span class="help-block">
                            <strong>{{ $errors->first('score_nctu') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('score_draw') ? ' has-error' : '' }}">
                <label for="score_draw" class="col-md-4 control-label">
                    <span class="label label-default">數字</span>
                    平手比分
                </label>

                <div class="col-md-6">
                    <input id="score_draw" type="number" class="form-control" name="score_draw" value="{{ $game->score_draw }}" step="any">
                    @if ($errors->has('score_draw'))
                        <span class="help-block">
                            <strong>{{ $errors->first('score_draw') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="location" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    地點
                </label>

                <div class="col-md-6">
                    <input id="location" type="text" class="form-control" name="location" value="{{ $game->location }}" required>
                </div>
            </div>
            <div class="form-group{{ $errors->has('location_url') ? ' has-error' : '' }}">
                <label for="location_url" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">網址</span>
                    地點URL
                </label>

                <div class="col-md-6">
                    <input id="location_url" type="url" class="form-control" name="location_url" value="{{ $game->location_url }}" required>
                    @if ($errors->has('location_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location_url') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="info_entry" class="col-md-4 control-label">
                    <span class="label label-default">換行即自動列點</span>
                    入場須知
                </label>

                <div class="col-md-6">
                    <textarea id="info_entry" class="form-control" name="info_entry" rows="8">{{ $game->info_entry }}
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="info_rule" class="col-md-4 control-label">
                    @if($game->type=='notgame')活動流程
                    @else簡易規則
                    @endif
                </label>

                <div class="col-md-6">
                    <textarea id="info_rule" class="form-control" name="info_rule" rows="6">{{ $game->info_rule }}
                    </textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="is_ticket" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    是否發票
                </label>

                <div class="col-md-6"> 
                    <input id="is_ticket" type="radio" name="is_ticket" value="1" @if($game->is_ticket==true) checked @endif>是
                    <input id="is_ticket" type="radio" name="is_ticket" value="0" @if($game->is_ticket==false) checked @endif>否
                </div>
            </div>
            <div class="form-group">
                <label for="is_broadcast" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    是否轉播
                </label>

                <div class="col-md-6">
                    <input id="is_broadcast" type="radio" name="is_broadcast" value="1" @if($game->is_broadcast==true) checked @endif>是
                    <input id="is_broadcast" type="radio" name="is_broadcast" value="0" @if($game->is_broadcast==false) checked @endif>否
                </div>
            </div>

            <div class="form-group{{ $errors->has('broadcast_url') ? ' has-error' : '' }}">
                <label for="broadcast_url" class="col-md-4 control-label">
                    <span class="label label-default">youtube網址</span>
                    轉播網址
                </label>

                <div class="col-md-6">
                    <input id="broadcast_url" type="url" class="form-control" name="broadcast_url" value="{{ $game->broadcast_url }}">
                    @if ($errors->has('broadcast_url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('broadcast_url') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="broadcast_org" class="col-md-4 control-label">
                    轉播資訊
                </label>

                <div class="col-md-6">
                    <textarea id="broadcast_org" class="form-control" name="broadcast_org" rows="3">{{ $game->broadcast_org }}
                    </textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="broadcast_anchor" class="col-md-4 control-label">
                    主播球評資訊
                </label>

                <div class="col-md-6">
                    <textarea id="broadcast_anchor" class="form-control" name="broadcast_anchor" rows="3">{{ $game->broadcast_anchor }}
                    </textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">賽事目前照片</label>

                <div class="col-md-6 form-control-static">
                    @if($game->photo != NULL)
                        <img src="{{ $game->photo }}" width="400px">
                    @else
                        目前無照片
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('file_photo') ? ' has-error' : '' }}">
                <label for="file_photo" class="col-md-4 control-label">
                    <span class="label label-default">圖像格式</span>
                    <span class="label label-default">不大於5MB</span>
                    更換賽事照片
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

        
@if (!$game->teams->isEmpty())
<div class="panel panel-primary">
    <div class="panel-heading">賽事相關隊伍</div>

    <div class="panel-body">
        @foreach($game->teams as $team)
        <a href="{{ route('teams.show',$team->id) }}" class="btn btn-default" role="button">
            @switch($team->school)
                @case('NTHU')國立清華大學@break
                @case('NCTU')國立交通大學@break
                @default@break
            @endswitch{{ $team->name }}
        </a>
        @endforeach
    </div>
</div>
@endif

@if (!$game->news->isEmpty())
<div class="panel panel-primary">
    <div class="panel-heading">賽事相關新聞</div>

    <div class="panel-body">
        @foreach($game->news as $news)
        <a href="{{ route('news.show',$news->id) }}" class="btn btn-default" role="button">
        {{ $news->title }}
        </a>
        @endforeach
    </div>
</div>
@endif
@endsection