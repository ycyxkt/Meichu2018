@extends('layouts.layout')

@section('title',$game->name)

@section('content')
<section class="gameboard">
    <div class="gameboard-background" style="background-image:url({{ asset('images/'.$game->photo) }});"></div>
    <div class="container">
        <div class="gameboard-title">
            <div class="game-name">{{ $game->name }}</div>
            <div class="game-info">
                <div class="game-time">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                    {{ \Carbon\Carbon::parse( $game->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $game->time )->format('H:i')}}
                </div>
                <a class="game-place" href="{{ $game->location_url }}" target="_blank">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    {{ $game->location }}
                </a>
            </div>
        </div>
        
        <div class="gameboard-content">
            <div class="team">
                <div class="team-logo">
                    @if($team_nctu==NULL || $team_nctu->logo==NULL)
                    <img src="{{ asset('images/team-logo-nctu.png') }}">
                    @else
                    <img src="{{ asset('images/'.$team_nctu->logo) }}">
                    @endif
                </div>
                <div>
                    交大@if($game->type!='notgame' && $team_nctu!=NULL)<span class="team-name">{{ $team_nctu->name }}</span>
                    @endif
                </div>
            </div>

            @if($game->score_nctu!=NULL && $game->type!='notgame')
            <div class="score">{{$game->score_nctu}}</div>
            @endif

            <div class="status">
                <div class="status-info">
                    @if($game->status== 'notyet' || $game->status== 'prepare' || $game->status== 'inprogress') 
                        @if($game->is_broadcast=='1')
                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                            提供轉播服務
                        @endif
                    @endif
                </div>
                <div class="status-title">
                    @switch($game->status)
                        @case('notyet')尚未開始
                            @break
                        @case('prepare')即將開始
                            @break
                        @case('inprogress')進行中
                            @break
                        @case('nthuwin')
                            <span class="nthu">清大勝</span>
                            @break
                        @case('nctuwin')
                            <span class="nctu">交大勝</span>
                            @break
                        @case('draw')
                            <span class="draw">平手</span>
                            @break
                        @case('break')暫停中
                            @break
                        @case('stop')
                            <span class="stop">因故停賽</span>
                            @break
                    @endswitch
                </div>
                <div class="status-info">
                    @if($game->status== 'notyet' || $game->status== 'prepare')
                        預計於{{ \Carbon\Carbon::parse( $game->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $game->time )->format('H:i')}}開始
                    @endif
                </div>
                @if($game->score_draw!=NULL && $game->type!='notgame')
                <div class="status-draw">平手 : {{$game->score_draw}}</div>
                @endif
            </div>

            @if($game->score_nthu!=NULL && $game->type!='notgame')
            <div class="score">{{$game->score_nthu}}</div>
            @endif

            <div class="team">
                <div class="team-logo">
                    @if($team_nthu==NULL || $team_nthu->logo==NULL)
                    <img src="{{ asset('images/team-logo-nthu.png') }}">
                    @else
                    <img src="{{ asset('images/'.$team_nthu->logo) }}">
                    @endif
                </div>
                <div>
                    清大@if($game->type!='notgame' && $team_nthu!=NULL)<span class="team-name">{{ $team_nthu->name }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
    
<div class="container">
    <div class="flex-layer">
        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                <span>入場須知</span>
            </h2>
            <ul style="margin-top:0;">
                @if($game->is_ticket=='1')
                    <li>本賽事需憑票入場，<a href="/tickets">點此了解索票方式</a></li>
                @endif
                @foreach($info_entry as $line)
                    <li>{{$line}}</li>
                @endforeach
            </ul>
        </section>
        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-info" aria-hidden="true"></i>
                @if($game->type!='notgame')
                <span>賽事規則</span>
                @else
                <span>活動流程</span>
                @endif
            </h2>
            <div>
                {!! nl2br(e($game->info_rule)) !!}
            </div>
        </section>
    </div>

    <section>
        <h2 class="sec-header">
            <i class="fa fa-users" aria-hidden="true"></i>
            <span>隊伍介紹</span>
        </h2>
        <div class="flex-layer">
            @foreach($game->teams as $team)
            <div class="flex-50 card-block infoblock">
                @if($team->photo!=NULL)       
                <div class="card-image">
                    <img src="{{ $team->photo }}">
                </div>
                @endif
                <div class="card-inner">
                    <div class="card-header">
                    @switch($team->school)
                        @case('NTHU')國立清華大學@break
                        @case('NCTU')國立交通大學@break
                        @default@break
                    @endswitch{{ $team->name }}
                    </div>
                    <div class="card-subtitle">
                        @if($team->name_en!=NULL)
                            @switch($team->school)
                                @case('NTHU'){{ $team->name_en }}, NTHU @break
                                @case('NCTU'){{ $team->name_en }}, NCTU @break
                                @default{{ $team->name_en }} @break
                            @endswitch
                        @endif
                    </div>
                    <div class="card-info">
                                
                    {!! nl2br(e($team->introduction)) !!}
                </div>
                </div>
                @if ($team->link_website!=NULL || $team->link_facebook!=NULL || $team->link_instagram!=NULL)
                <div class="card-link">
                    @if ($team->link_facebook!=NULL)
                    <a href="{{ $team->link_facebook }}" target="_blank">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i>Facebook
                    </a>
                    @endif
                    @if ($team->link_instagram!=NULL)
                    <a href="{{ $team->link_instagram }}" target="_blank">
                        <i class="fa fa-instagram" aria-hidden="true"></i>Instagram
                    </a>
                    @endif
                    @if ($team->link_website!=NULL)
                    <a href="{{ $team->link_website }}" target="_blank">
                        <i class="fa fa-globe" aria-hidden="true"></i>官網
                    </a>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </section>


    
    <section>
        <h2 class="sec-header">
            <i class="fa fa-video-camera" aria-hidden="true"></i>
            <span>轉播資訊</span>
        </h2>
        @if($game->is_broadcast=='1')
        <div class="broadcast-frame">
            <iframe src="{{ $game->broadcast_url }}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
        </div>
        <div class="broadcast-info">
            <div class="broadcast-group">
                {!! nl2br(e($game->broadcast_org)) !!}
            </div>
            <div class="broadcast-anchor">
                {!! nl2br(e($game->broadcast_anchor)) !!}
            </div>
        </div>
        @else
            本場賽事不提供轉播服務，歡迎至現場為選手加油！
        @endif
    </section>

    
    @if(!$game->news->isEmpty())
    <section>
        <h2 class="sec-header">
            <i class="fa fa-camera" aria-hidden="true"></i>
            <span>媒體報導</span>
        </h2>
        <div class="flex-layer">
            @foreach($game->news as $news)
                <a class="card-block card-news" href="{{ $news->link }}" target="_blank">
                    <div class="card-inner">
                        <div class="card-header">{{ $news->title }}</div>
                        <div class="card-subtitle">
                        {{ $news->group }} / {{ $news->author }}
                        </div>
                        <div class="card-info">
                        {{ $news->content }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection