@extends('layouts.layout')

@section('title','相關活動')

@section('content')
<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">相關活動</div>
</section>
<div class="container">
    <section>
        <h2 class="sec-header">
            <i class="fa fa-motorcycle" aria-hidden="true"></i>
            <span>相關活動</span>
        </h2>
        在熱鬧的梅竹賽開始之前，多樣的賽前活動也是不容錯過，趕快把這些活動記到行事曆上吧！
    </section>

    <div class="flex-layer">
        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-motorcycle" aria-hidden="true"></i>
                <span>清華大學 NTHU</span>
            </h2>

            @foreach($events_nthu as $data)
            <a class="gameinfo eventinfo"
                @if($data->link != NULL)
                href="{{ $data->link }}" target="_blank"
                @endif>
            
                <div class="game-name">
                    {{ $data->title }}
                </div>
                <div class="gameinfo-info @switch($data->tag)
                        @case('交大賽前活動')event-nctu
                            @break
                        @case('清大賽前活動')event-nthu
                            @break
                        @case('兩校賽前活動')event-both
                            @break
                        @case('賽事相關活動')event-games
                            @break
                    @endswitch">
                    <div class="event-group">{{ $data->group }}</div>
                    <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                    <div>{{ $data->location }}</div>
                        
                </div>
            </a>
            @endforeach
        </section>

        <section class="flex-50">
            <h2 class="sec-header">
                <i class="fa fa-motorcycle" aria-hidden="true"></i>
                <span>交通大學 NCTU</span>
            </h2>

            @foreach($events_nctu as $data)
            <a class="gameinfo eventinfo" 
                @if($data->link != NULL)
                href="{{ $data->link }}" target="_blank"
                @endif>
            
                <div class="game-name">
                    {{ $data->title }}
                </div>
                <div class="gameinfo-info @switch($data->tag)
                        @case('交大賽前活動')event-nctu
                            @break
                        @case('清大賽前活動')event-nthu
                            @break
                        @case('兩校賽前活動')event-both
                            @break
                        @case('賽事相關活動')event-games
                            @break
                    @endswitch">
                    <div class="event-group">{{ $data->group }}</div>
                    <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                    <div>{{ $data->location }}</div>
                        
                </div>
            </a>
            @endforeach
        </section>
            
    </div>
</div>
@endsection
