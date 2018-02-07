@extends('layouts.layout')

@section('title','相關活動')

@section('content')
<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">相關活動</div>
</section>
<div class="container">
    <h2 class="sec-header">
        <i class="fa fa-motorcycle" aria-hidden="true"></i>
        <span>相關活動</span>
    </h2>
    在熱鬧的梅竹賽開始之前，多樣的賽前活動也是不容錯過，趕快把這些活動記到行事曆上吧！

    @foreach($events as $event)
        <div class="event-layer">
            <div class="event-left">
                {{ \Carbon\Carbon::parse( $event[0]->date )->format('m/d')}}
            </div>
            
            <div class="event-right">
                @foreach($event as $data)
                <div class="event-info">
                    @switch($data->tag)
                        @case('交大索票活動')
                            <span class="event-tag event-nctu">交大索票</span>
                            @break
                        @case('清大索票活動')
                            <span class="event-tag event-nthu">清大索票</span>
                            @break
                        @case('交大賽前活動')
                            <span class="event-tag event-nctu">交大活動</span>
                            @break
                        @case('清大賽前活動')
                            <span class="event-tag event-nthu">清大活動</span>
                            @break
                        @case('兩校賽前活動')
                            <span class="event-tag event-both">兩校活動</span>
                            @break
                        @case('賽事相關活動')
                            <span class="event-tag event-games">賽事活動</span>
                            @break
                    @endswitch
                    <div>
                        <div class="event-title">
                            @if('交大索票活動' === $data->tag || '清大索票活動' === $data->tag)
                                <a href="/tickets">
                                    {{ $data->title }}
                                </a>
                            @elseif($data->link!=NULL)
                                <a href="{{ $data->link }}" target="_blank">
                                    {{ $data->title }}
                                </a>
                            @else
                                {{ $data->title }}
                            @endif
                        </div>
                        <div class="event-detail">
                            <span>
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}
                            </span>
                            <span>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                {{ $data->location }} 
                            </span>
                            <span>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                {{ $data->group }}    
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
    @endforeach

</div>
@endsection
