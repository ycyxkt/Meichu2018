@extends('layouts.manage')

@section('title','新增紀錄')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('games.records',$game->id) }}" class="btn btn-default" role="button">< {{ $game->name }}紀錄</a>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">新增紀錄</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ url('/m/records/') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="game_id" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    所屬賽事
                </label>

                <div class="col-md-6">
                    <select id="game_id" class="form-control" name="game_id" required autofocus>
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="order" class="col-md-4 control-label">
                    <span class="label label-primary">必填</span>
                    <span class="label label-default">非負數</span>
                    順序
                </label>

                <div class="col-md-6">
                    <input id="order" type="number" class="form-control" name="order" value="{{ old('order') }}" step="any" required>
                </div>
            </div>

            <div class="form-group">
                <label for="title" class="col-md-4 control-label">
                    局/標題(表格最上層)
                </label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="nctu" class="col-md-4 control-label">
                    交大(上層)欄位
                </label>

                <div class="col-md-6">
                    <input id="nctu" type="text" class="form-control" name="nctu" value="{{ old('nctu') }}">
                </div>
            </div>

            <div class="form-group">
                <label for="nthu" class="col-md-4 control-label">
                    清大(下層)欄位
                </label>

                <div class="col-md-6">
                    <input id="nthu" type="text" class="form-control" name="nthu" value="{{ old('nthu') }}">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        新增紀錄
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection