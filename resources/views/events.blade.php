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

        <div class="flex-layer">
        @foreach($events as $data)
            <div class="flex-50 card-block card-event @switch($data->tag)
                            @case('交大賽前活動')event-nctu
                                @break
                            @case('清大賽前活動')event-nthu
                                @break
                            @case('兩校賽前活動')event-both
                                @break
                            @case('賽事相關活動')event-games
                                @break
                        @endswitch">
                <div class="card-inner">
                        <a class="card-header" href="{{ $data->link }}" target="_blank">
                            {{ $data->title }}
                        </a>
                    <div class="card-subtitle">
                        {{ $data->group }}
                    </div>
                    <div>
                        時間 / {{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}
                    </div>
                    <div>
                        地點 / {{ $data->location }} 
                    </div>
                </div>
            </div>
        @endforeach
        </div>

    </section>
</div>
@endsection
