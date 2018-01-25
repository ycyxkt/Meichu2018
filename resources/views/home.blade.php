@extends('layouts.layout')

@section('title','首頁')

@section('content')
<section class="intro">
    <div class="intro-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <img src="{{ asset('images/fox.png') }}" class="intro-fox">
    <img src="{{ asset('images/panda.png') }}" class="intro-panda">
    <div class="intro-brand">
        <a href="/index"><img src="{{ asset('images/brand-logo.png') }}" alt="戊戌梅竹"></a>
    </div>
</section>
<div class="container">
    @if(!$games_top->isEmpty())
    <section>
        <h2 class="sec-header">
            <i class="fa fa-play-circle" aria-hidden="true"></i>
            <span>進行中 / 即將進行賽事</span>
        </h2>
        <div class="gameinfo-layer">
            @foreach($games_top as $data)
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

    <div class="flex-layer">
        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                <span>最新消息</span>
            </h2>
            <ul class="news">
                @if($news->isEmpty())
                    暫無最新消息。
                @endif
                @foreach($news as $data)
                    <li>
                        {{ \Carbon\Carbon::parse( $data->created_at )->format('m/d')}}
                        @switch($data->tag)
                            @case('news')
                                <span class="news-tag news-news">新聞</span>
                            @break
                            @case('ann_events')
                                <span class="news-tag news-events">活動公告</span>
                            @break
                            @case('ann_games')
                                <span class="news-tag news-games">賽事公告</span>
                            @break
                            @case('other')
                                <span class="news-tag news-other">其他</span>
                            @break
                        @endswitch
                        @if($data->tag != 'news')
                            <a href="{{ url('news/'.$data->id) }}" class="newstitle">
                            {{ $data->title }}</a>
                        @elseif($data->link != NULL)
                            <a href="{{ $data->link }}" class="newstitle" target="_BLANK">
                                {{ $data->title }}</a>
                        @else
                            <span class="newstitle">{{ $data->title }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>


        </section>
        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-video-camera" aria-hidden="true"></i>
                <span>宣傳影片</span>
            </h2>
            <div class="broadcast-frame">
                <iframe src="https://www.youtube.com/embed/fzuy63eCUKc?rel=0&amp;showinfo=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
            </div>
        </section>
    </div>

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
