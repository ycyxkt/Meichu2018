@extends('layouts.manage')

@section('title','賽事管理')

@section('content')
<table class="table table-striped table-hover table-responsive">
    <thead>
        <th>賽名</th>
        <th>時間</th> 
        <th>地點</th>
        <th>狀態</th>
        <th></th>
        <th></th>
    </thead>
    @foreach($games as $data)
    <tr>
        <th>{{ $data->name }}</th>
        <th>{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</th> 
        <th>{{ $data->location }}</th>
        @switch($data->status)
            @case('notyet')
                <th class="color_notyet">尚未開始</th>
                @break
            @case('prepare')
                <th class="color_prepare">準備中</th>
                @break
            @case('inprogress')
                <th class="color_inprogress">進行中</th>
                @break
            @case('nthuwin')
                <th class="color_nthu">清大勝</th>
                @break
            @case('nctuwin')
                <th class="color_nctu">交大勝</th>
                @break
            @case('draw')
                <th class="color_draw">平手</th>
                @break
            @case('break')
                <th class="color_break">暫停中</th>
                @break
            @case('stop')
                <th class="color_stop">因故停賽</th>
                @break
            @case('finish')
                <th class="color_finish">已結束</th>
                @break
            @default
                <th class="color_other">{{ $data->status }}</th>
                @break
        @endswitch
        <th>
            <a href="{{ url('games/'.$data->game) }}" class="btn btn-success" role="button">查看</a>
        </th>
        <th>
            <a href="{{ route('games.edit', $data->id) }}" class="btn btn-primary" role="button">編輯</a>
        </th>
    </tr>
    @endforeach
</table>
@endsection
