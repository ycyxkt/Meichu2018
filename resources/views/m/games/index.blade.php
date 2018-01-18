@extends('layouts.manage')

@section('title','賽事管理')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped">
                <thead>
                    <th>賽名</th>
                    <th>時間</th> 
                    <th>地點</th>
                    <th>狀態</th>
                    <th></th>
                    <th></th>
                </thead>
                @foreach($games as $game)
                <tr>
                    <th>{{ $game->name }}</th>
                    <th>{{ \Carbon\Carbon::parse( $game->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $game->time )->format('H:i')}}</th> 
                    <th>{{ $game->location }}</th>
                    <th>
                        @switch($game->status)
                            @case('notyet')
                                <span style='color:#232323'>尚未開始</span>
                                @break
                            @case('prepare')
                                <span style='color:#232323'>準備中</span>
                                @break
                            @case('inprogress')
                                <span style='color:#232323'>進行中</span>
                                @break
                            @case('nthuwin')
                                <span style='color:#232323'>清大勝</span>
                                @break
                            @case('nctuwin')
                                <span style='color:#232323'>交大勝</span>
                                @break
                            @case('draw')
                                <span style='color:#232323'>平手</span>
                                @break
                            @case('break')
                                <span style='color:#232323'>暫停中</span>
                                @break
                            @case('stop')
                                <span style='color:#232323'>因故停賽</span>
                                @break
                            @default
                                <span style='color:#232323'>狀態錯誤</span>
                        @endswitch
                    </th>
                    <th>
                        <a href="{{ url('games/'.$game->game) }}" class="btn btn-success" role="button">查看</a>
                    </th>
                    <th>
                        <a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning" role="button">編輯</a>
                    </th>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
