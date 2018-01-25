@extends('layouts.layout')

@section('title','賽事戰況')

@section('content')
<section class="gameboard">
    <div class="gameboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="container">
        <div class="gameboard-title">
            <div class="game-name">正式賽點數</div>
        </div>
        <div class="gameboard-content">
            <div class="team">
                <div class="team-logo">
                    <img src="{{ asset('images/team-logo-nctu.png') }}">
                </div>
                <div>
                    交大
                </div>
            </div>

            <div class="score">{{$score_nctu}}</div>

            <div class="status">
                <div class="status-title">
                    @if($status=='交大勝')
                        <span class="nctu">{{ $status }}</span>
                    @elseif($status=='清大勝')
                        <span class="nthu">{{ $status }}</span>
                    @elseif($status=='平手')
                        <span class="draw">{{ $status }}</span>
                    @elseif($status=='因故停賽')
                        <span class="stop">{{ $status }}</span>
                    @else
                        <span>{{ $status }}</span>
                    @endif
                </div>
                @if($score_draw!=0)
                    <div class="status-draw">平手 : {{ $score_draw }}</div>
                @endif
            </div>

            <div class="score">{{ $score_nthu }}</div>

            <div class="team">
                <div class="team-logo">
                    <img src="{{ asset('images/team-logo-nthu.png') }}">
                </div>
                <div>
                    清大
                </div>
            </div>
        </div>
    </div>
</section>
    
<div class="container">
    
    @if(!$games_inprogress->isEmpty())
    <section>
        <h2 class="sec-header">
            <i class="fa fa-play-circle" aria-hidden="true"></i>
            <span>進行中賽事</span>
        </h2>
        <div class="gameinfo-layer">
            @foreach($games_inprogress as $data)
                
            <div class="gameinfo-flex">
                <a class="gameinfo" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ asset('images/'.$data->photo) }});"></div>
                    @if($data->status=='inprogress')
                        <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                        <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->game=='men-basketball' || $data->game=='women-basketball')
                                    <i class="fa fa-eercast" aria-hidden="true"></i>
                                    VR 360
                                    @endif
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(!$games_prepare->isEmpty())
    <section>
        <h2 class="sec-header">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            <span>即將舉行</span>
        </h2>
        <div class="gameinfo-layer">
            @foreach($games_prepare as $data)
                
            <div class="gameinfo-flex">
                <a class="gameinfo" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ asset('images/'.$data->photo) }});"></div>
                    @if($data->status=='inprogress')
                        <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                        <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->game=='men-basketball' || $data->game=='women-basketball')
                                    <i class="fa fa-eercast" aria-hidden="true"></i>
                                    VR 360
                                    @endif
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <section>
        <h2 class="sec-header">
            <i class="fa fa-th" aria-hidden="true"></i>
            <span>所有賽事</span>
        </h2>
        <div class="gameinfo-layer">
            <div class="gameinfo-flex">
                <div class="game-date">03/02 （五）</div>
                @foreach($games_day1 as $data)
                <a class="gameinfo @if($data->status=='nthuwin') nthu @elseif($data->status=='nctuwin') nctu @elseif($data->status=='draw') draw @elseif($data->status=='stop') stop @endif" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ asset('images/'.$data->photo) }});"></div>
                    @if($data->status=='inprogress')
                    <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                    <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            <div class="gameinfo-flex">
                <div class="game-date">03/03 （六）</div>
                
                @foreach($games_day2 as $data)
                <a class="gameinfo" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ asset('images/'.$data->photo) }});"></div>
                    @if($data->status=='inprogress')
                        <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                        <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->game=='men-basketball' || $data->game=='women-basketball')
                                    <i class="fa fa-eercast" aria-hidden="true"></i>
                                    VR 360
                                    @endif
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            <div class="gameinfo-flex">
                <div class="game-date">03/04 （日）</div>
                
                @foreach($games_day3 as $data)
                <a class="gameinfo" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ asset('images/'.$data->photo) }});"></div>
                    @if($data->status=='inprogress')
                        <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                        <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>


</div>
@endsection