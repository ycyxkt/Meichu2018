@extends('layouts.layout')

@section('title',$news->title)

@section('content')
<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">最新消息</div>
</section>
<div class="container">
    <section>
        <div class="infoblock">
            <div class="news-title">{{ $news->title }}</div>
            <div class="news-info">
                @switch($news->tag)
                    @case('news')
                        <span class="news-tag news-news"><i class="fa fa-tag" aria-hidden="true"></i>
                        新聞</span>
                        @break
                    @case('ann_events')
                        <span class="news-tag news-events"><i class="fa fa-tag" aria-hidden="true"></i>
                        活動公告</span>
                    @break
                    @case('ann_games')
                        <span class="news-tag news-games"><i class="fa fa-tag" aria-hidden="true"></i>
                        賽事公告</span>
                    @break
                    @case('other')
                        <span class="news-tag news-other"><i class="fa fa-tag" aria-hidden="true"></i>
                        其他</span>
                    @break
                @endswitch
            </div>
            <div class="news-info">
                <span class="news-tag news-other"><i class="fa fa-calendar-o" aria-hidden="true"></i>
                {{ \Carbon\Carbon::parse( $news->created_at )->format('m/d')}}</span>
                </div>
                <div class="news-info">
                <span class="news-tag news-other"><i class="fa fa-users" aria-hidden="true"></i>
                {{ $news->group }}{{ $news->author!=NULL ? ' / '.$news->author : ''}}</span>
            </div>
            <div class="news-content">
                {!! nl2br(e($news->content)) !!}
            </div>
            
            <div class="news-link">
            @if($news->link != NULL)
                <a href="{{ $news->link }}" target="_BLANK">相關連結</a>
            @endif
            </div>
        </div>
        <div class="news-nav infoblock">
            <div class="news-nav-prev">
                @if($news_prev!=NULL)
                <a href="{{ url('news/'.$news_prev->id) }}">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    前一篇<br/>
                    <span class="news-nav-hidden">{{ $news_prev->title }}</span>
                </a>
                @endif
            </div>
            
            <div class="news-nav-index">
                <a href="/news">
                    <i class="fa fa-th" aria-hidden="true"></i>
                    所有消息
                </a>
            </div>
            <div class="news-nav-next">
                @if($news_next!=NULL)
                <a href="{{ url('news/'.$news_next->id) }}">
                    後一篇
                    <i class="fa fa-chevron-right" aria-hidden="true"></i><br/>
                    <span class="news-nav-hidden">{{ $news_next->title }}</span>
                </a>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
