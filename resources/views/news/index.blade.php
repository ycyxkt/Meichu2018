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
                
                <span class="news-right">
                    {{ $data->group }}
                </span>
            </li>
        @endforeach
    </ul>
</section>
</div>
@endsection
