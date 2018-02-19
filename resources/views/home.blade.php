@extends('layouts.layout')

@section('title','首頁')

@section('content')
<section class="intro">
    <div class="intro-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <img src="{{ asset('images/fox.png') }}" class="intro-fox">
    <img src="{{ asset('images/panda.png') }}" class="intro-panda">
    <div class="intro-brand">
        <a href="/"><img src="data:image/png;base64,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" alt="戊戌梅竹"></a>
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
                    <div class="gameboard-background"  style="background-image:url({{ $data->photosmall }});"></div>
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
                                <span class="news-tag news-news">
                                @if($data->is_sticky == '1')
                                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                                @endif
                                新聞</span>
                            @break
                            @case('ann_events')
                                <span class="news-tag news-events">
                                @if($data->is_sticky == '1')
                                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                                @endif
                                活動公告</span>
                            @break
                            @case('ann_games')
                                <span class="news-tag news-games">
                                @if($data->is_sticky == '1')
                                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                                @endif
                                賽事公告</span>
                            @break
                            @case('other')
                                <span class="news-tag news-other">
                                @if($data->is_sticky == '1')
                                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                                @endif
                                其他</span>
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
            <a class="news-more" href="/news">查看更多最新消息 >></a>

        </section>
        
        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                <span>宣傳影片</span>
            </h2>
            <div class="broadcast-frame" id="video-cf">
                <img src="{{ asset('images/video-image.jpg') }}" width="100%">
            </div>
        </section>
    </div>

    <section>
        <h2 class="sec-header">
            <i class="fa fa-th" aria-hidden="true"></i>
            <span>所有賽事</span>
        </h2>
        <div class="gameinfo-layer">
            @foreach([
                $games['2018-03-02'], $games['2018-03-03'], $games['2018-03-04']
            ] as $game)

            <div class="gameinfo-flex">
                <div class="game-date">{{ \Carbon\Carbon::parse( $game[0]->date )->format('m/d')}}</div>
                @foreach($game as $data)
                <a class="gameinfo @if($data->status=='nthuwin') nthu @elseif($data->status=='nctuwin') nctu @elseif($data->status=='draw') draw @elseif($data->status=='stop') stop @endif" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ $data->photosmall }}); @if($data->game=='football-general' || $data->game=='football-open') background-position:top;@endif"></div>
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
                        @elseif($data->status=='finish')
                            <div class="gameinfo-score">已結束</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->is_vr360=='1')
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
            @endforeach

        </div>
    </section>

</div>
@endsection

@section('custom_script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#video-cf").click(function(e){
            $("#video-cf").html('<iframe src="https://www.youtube.com/embed/dtfqXifRYUs?rel=0&amp;showinfo=0&autoplay=1" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>');
            console.log('success');
        }); 
    });
</script>
@endsection
