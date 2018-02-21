@extends('layouts.manage')

@section('title','紀錄管理')

@section('content')
<div class="row">
    <div class="col-xs-6">
        <a href="{{ route('games.index') }}" class="btn btn-default" role="button">< 所有賽事</a>
    </div>
    <div class="col-xs-6 text-right">
        <a href="{{ route('records.create',$game->id) }}" class="btn btn-info" role="button">新增紀錄</a>
    </div>
</div>
<h2 class="text-center">{{ $game->name }} 紀錄</h2>
@if($records->isEmpty())
    <div class="text-center">目前沒有紀錄</div>
@else
<table class="table table-striped table-bordered table-condensed table-responsive">

    <tr>
        <th>順序</th>
        @foreach($records as $data)
        <th>{{ $data->order }}</th>
        @endforeach
    </tr>

    <tr>
        <th>標題列</th>
        @foreach($records as $data)
        <th>{{ $data->title }}</th>
        @endforeach
    </tr>

    @if('0' == $game->is_home)
    <tr>
        <th>清大</th>
        @foreach($records as $data)
        <th>{{ $data->nthu }}</th>
        @endforeach
    </tr>
    @endif
    
    <tr>
        <th>交大</th>
        @foreach($records as $data)
        <th>{{ $data->nctu }}</th>
        @endforeach
    </tr>

    @if('1' == $game->is_home)
    <tr>
        <th>清大</th>
        @foreach($records as $data)
        <th>{{ $data->nthu }}</th>
        @endforeach
    </tr>
    @endif

    <tr>
        <th></th>
        @foreach($records as $data)
        <th>
            <a href="{{ route('records.edit', $data->id) }}" class="btn btn-warning" role="button">編輯</a>
        </th>
        @endforeach
    </tr>
    <tr>
        <th></th>
        @foreach($records as $data)
        <th>
        {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['records.destroy', $data->id]
                ]) !!}
                {!! Form::submit('刪除', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </th>
        </th>
        @endforeach
    </tr>
</table>
@endif
@endsection
