@extends('layouts.layout')

@section('title','票務')

@section('content')
<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">票務</div>
</section>
<section style="text-align: center; font-size: 1.2rem; font-weight: bold;">
    恭喜國立清華大學拿下戊戌梅竹總錦標，若您對戊戌梅竹有任何建議，歡迎填寫<a href="https://www.surveycake.com/s/YOOOK" targer="_BLANK">賽後問卷</a>，謝謝！
</section>
<div class="container">
    <div class="infoblock">
        除@foreach($games_is_ticket as $data)<a href="{{ url('games/'.$data->game) }}">{{ $data->name }}</a>@if(!$loop->last)、@endif @endforeach
        <strong>需憑票（賽前免費索票）入場</strong>外，<br/>
        其餘賽事皆為<strong>免門票入場</strong>，惟詳細入場時間與規則請見各賽事頁面！<br/>
        請注意，<strong>持某校之票券只能從該校一般觀眾入口進入其座位區，恕無法更換至另一校座位區。</strong><br/>
        詳細票券使用規則請參閱票券背面。
    </div>
    <div class="flex-layer">
        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-ticket" aria-hidden="true"></i>
                <span>清華大學 NTHU</span>
            </h2>
            @isset($tickets['清大索票活動'])
                @foreach($tickets['清大索票活動'] as $data)
                <div class="ticketinfo">
                    <div class="ticketinfo-left">
                        {{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}
                    </div>
                    <div class="ticketinfo-right">
                        <div class="title">
                            {{ $data->title }}
                        </div>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        {{ $data->location }}
                    </div>
                </div>
                @endforeach
            @endisset
            <div class="infoblock">
                <h4 class="infoblock-title">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    清大索票規則
                </h4>
                <ol class="infoblock-content">
                    @foreach($text['ticket_nthu'][0]->content_list as $line)
                        <li>{{$line}}</li>
                    @endforeach
                </ol>
            </div>
        </section>
        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-ticket" aria-hidden="true"></i>
                <span>交通大學 NCTU</span>
            </h2>
            @isset($tickets['交大索票活動'])
                @foreach($tickets['交大索票活動'] as $data)
                <div class="ticketinfo">
                    <div class="ticketinfo-left">
                        {{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}
                    </div>
                    <div class="ticketinfo-right">
                        <div class="title">
                            {{ $data->title }}
                        </div>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        {{ $data->location }}
                    </div>
                </div>
                @endforeach
            @endisset
            <div class="infoblock">
                <h4 class="infoblock-title">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    交大索票規則
                </h4>
                <ol class="infoblock-content">
                    @foreach($text['ticket_nctu'][0]->content_list as $line)
                        <li>{{$line}}</li>
                    @endforeach
                </ol>
            </div>
        </section>
    </div>
</div>
@endsection
