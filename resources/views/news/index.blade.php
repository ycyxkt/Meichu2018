@extends('layouts.layout')

@section('title','最新消息')

@section('content')
<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">最新消息</div>
</section>
<div class="container">
<section>
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
                    @case('link')
                        <span class="news-tag news-other">
                        @if($data->is_sticky == '1')
                            <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                        @endif
                        連結</span>
                    @break
                    @case('other')
                        <span class="news-tag news-other">
                        @if($data->is_sticky == '1')
                            <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                        @endif
                        其他</span>
                    @break
                @endswitch
                @if($data->tag != 'news' && $data->tag != 'link')
                    <a href="{{ url('news/'.$data->id) }}" class="newstitle">
                    {{ $data->title }}</a>
                @elseif($data->link != NULL)
                    <a href="{{ $data->link }}" class="newstitle" target="_BLANK">
                        {{ $data->title }}</a>
                @else
                    <span class="newstitle">{{ $data->title }}</span>
                @endif
                
                <span class="news-right">
                    {{ $data->group }}
                </span>
            </li>
        @endforeach
    </ul>

    @if($news->nextPageUrl()!=NULL || $news->previousPageUrl()!=NULL)
    <div class="pagination-nav infoblock">
        <div class="pagination-nav-prev">
            @if($news->previousPageUrl()!=NULL)
            <a href="{{ $news->previousPageUrl() }}">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                上一頁
            </a>
            @endif
        </div>

        <div class="pagination-nav-index"></div>
        
        <div class="pagination-nav-next">
            @if($news->nextPageUrl()!=NULL)
            <a href="{{ $news->nextPageUrl() }}">
                下一頁
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
            @endif
        </div>
    
    </div>
    @endif

</section>
</div>
@endsection
