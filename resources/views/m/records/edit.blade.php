@extends('layouts.manage')

@section('title','編輯紀錄')

@section('content')
<div class="row">
    <div class="col-xs-6">
        
    </div>
    <div class="col-xs-6 text-right">
        <a href="{{ route('games.records',$record->game_id) }}" class="btn btn-success" role="button">查看{{ $record->game()->first()->name }}紀錄</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">編輯紀錄</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/records/'.$record->id) }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="game_id" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    所屬賽事
                </label>

                <div class="col-md-6 form-control-static">
                    {{ $record->game()->first()->name }}
                </div>
            </div>

            <div class="form-group">
                <label for="order" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">正數</span>
                    順序
                </label>

                <div class="col-md-6">
                    <input id="order" type="number" class="form-control" name="order" value="{{ $record->order }}" step="1" required>
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="col-md-4 control-label">
                    局/標題列
                </label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ $record->title }}">
                </div>
            </div>

            <div class="form-group">
                <label for="nctu" class="col-md-4 control-label">
                    交大分數
                </label>

                <div class="col-md-6">
                    <input id="nctu" type="text" class="form-control" name="nctu" value="{{ $record->nctu }}">
                </div>
            </div>

            <div class="form-group">
                <label for="nthu" class="col-md-4 control-label">
                    清大分數
                </label>

                <div class="col-md-6">
                    <input id="nthu" type="text" class="form-control" name="nthu" value="{{ $record->nthu }}">
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